/**
 * PHP Protocol Buffer Generator Plugin for protoc
 * By Andrew Brampton (c) 2010
 *
 * TODO
 *  Support the packed option
 *  Lots of optimisations
 *  Extensions
 *  Services
 *  Packages
 *  Better validation (add code to check setted values are valid)
 *  option optimize_for = CODE_SIZE/SPEED;
 */
#include "strutil.h" // TODO This header is from the offical protobuf source, but it is not normally installed

#include <map>
#include <string>
#include <algorithm>

#include <cstdio> // for sprintf

#include <google/protobuf/descriptor.h>
#include <google/protobuf/wire_format.h>
#include <google/protobuf/wire_format_lite.h>
#include <google/protobuf/wire_format_lite_inl.h>


#include <google/protobuf/compiler/plugin.h>
#include <google/protobuf/compiler/code_generator.h>

#include <google/protobuf/io/printer.h>
#include <google/protobuf/io/zero_copy_stream.h>

#include "php_options.pb.h"

using namespace google::protobuf;
using namespace google::protobuf::compiler;
using namespace google::protobuf::internal;

class PHPCodeGenerator : public CodeGenerator {
	private:

		void PrintMessage   (io::Printer &printer, const Descriptor & message) const;
		void PrintMessages  (io::Printer &printer, const FileDescriptor & file) const;

		void PrintEnum      (io::Printer &printer, const EnumDescriptor & e) const;
		void PrintEnums     (io::Printer &printer, const FileDescriptor & file) const;

		void PrintService   (io::Printer &printer, const ServiceDescriptor & service) const;
		void PrintServices  (io::Printer &printer, const FileDescriptor & file) const;

		string DefaultValueAsString(const FieldDescriptor & field, bool quote_string_type) const;

		// Print the read() method
		void PrintMessageRead(io::Printer &printer, const Descriptor & message, vector<const FieldDescriptor *> & required_fields, const FieldDescriptor * parentField) const;

		// Print the write() method
		void PrintMessageWrite(io::Printer &printer, const Descriptor & message, const FieldDescriptor * parentField) const;

		// Print the size() method
		void PrintMessageSize(io::Printer &printer, const Descriptor & message) const;

		// Maps names into PHP names
		template <class DescriptorType>
		string ClassName(const DescriptorType & descriptor) const;

		string VariableName(const FieldDescriptor & field) const;

	public:

		PHPCodeGenerator();
		~PHPCodeGenerator();

		bool Generate(const FileDescriptor* file, const string& parameter, OutputDirectory* output_directory, string* error) const;

};

PHPCodeGenerator::PHPCodeGenerator() {}
PHPCodeGenerator::~PHPCodeGenerator() {}

string UnderscoresToCamelCaseImpl(const string& input, bool cap_next_letter) {
  string result;
  // Note:  I distrust ctype.h due to locales.
  for (int i = 0; i < input.size(); i++) {
    if ('a' <= input[i] && input[i] <= 'z') {
      if (cap_next_letter) {
        result += input[i] + ('A' - 'a');
      } else {
        result += input[i];
      }
      cap_next_letter = false;
    } else if ('A' <= input[i] && input[i] <= 'Z') {
      if (i == 0 && !cap_next_letter) {
        // Force first letter to lower-case unless explicitly told to
        // capitalize it.
        result += input[i] + ('a' - 'A');
      } else {
        // Capital letters after the first are left as-is.
        result += input[i];
      }
      cap_next_letter = false;
    } else if ('0' <= input[i] && input[i] <= '9') {
      result += input[i];
      cap_next_letter = true;
    } else {
      cap_next_letter = true;
    }
  }
  return result;
}

string UnderscoresToCamelCase(const FieldDescriptor & field) {
  return UnderscoresToCamelCaseImpl(field.name(), false);
}

string UnderscoresToCapitalizedCamelCase(const FieldDescriptor & field) {
  return UnderscoresToCamelCaseImpl(field.name(), true);
}

string LowerString(const string & s) {
  string newS (s);
  LowerString(&newS);
  return newS;
}

string UpperString(const string & s) {
  string newS (s);
  UpperString(&newS);
  return newS;
}

// Maps a Message full_name into a PHP name
template <class DescriptorType>
string PHPCodeGenerator::ClassName(const DescriptorType & descriptor) const {
	string name (descriptor.full_name());
	replace(name.begin(), name.end(), '.', '_');
	return name;
}

string PHPCodeGenerator::VariableName(const FieldDescriptor & field) const {
	return UnderscoresToCamelCase(field) + '_';
}

string PHPCodeGenerator::DefaultValueAsString(const FieldDescriptor & field, bool quote_string_type) const {
  switch (field.cpp_type()) {
    case FieldDescriptor::CPPTYPE_INT32:
      return SimpleItoa(field.default_value_int32());

    case FieldDescriptor::CPPTYPE_INT64:
      return SimpleItoa(field.default_value_int64());

    case FieldDescriptor::CPPTYPE_UINT32:
      return SimpleItoa(field.default_value_uint32());

    case FieldDescriptor::CPPTYPE_UINT64:
      return SimpleItoa(field.default_value_uint64());

    case FieldDescriptor::CPPTYPE_FLOAT:
      return SimpleFtoa(field.default_value_float());

    case FieldDescriptor::CPPTYPE_DOUBLE:
      return SimpleDtoa(field.default_value_double());

    case FieldDescriptor::CPPTYPE_BOOL:
      return field.default_value_bool() ? "true" : "false";

    case FieldDescriptor::CPPTYPE_STRING:
      if (quote_string_type)
        return "\"" + CEscape(field.default_value_string()) + "\"";

      if (field.type() == FieldDescriptor::TYPE_BYTES)
        return CEscape(field.default_value_string());

      return field.default_value_string();

    case FieldDescriptor::CPPTYPE_ENUM:
      return ClassName(*field.enum_type()) + "::" + field.default_value_enum()->name();

    case FieldDescriptor::CPPTYPE_MESSAGE:
      return "null";

  }
  return "";
}

void PHPCodeGenerator::PrintMessageRead(io::Printer &printer, const Descriptor & message, vector<const FieldDescriptor *> & required_fields, const FieldDescriptor * parentField) const {

	// Parse the file options
	const PHPFileOptions & options ( message.file()->options().GetExtension(php) );
	bool skip_unknown = options.skip_unknown();
	const char * pb_namespace = options.namespace_().empty() ? "" : "\\";

	// Read
	printer.Print(
		"\n"
		"function read($fp, &$limit = PHP_INT_MAX) {\n"
	);
	printer.Indent();

	printer.Print("while(!feof($fp) && $limit > 0) {\n");
	printer.Indent();

	printer.Print(
		"$tag = `ns`Protobuf::read_varint($fp, $limit);\n"
		"if ($tag === false) break;\n"
		"$wire  = $tag & 0x07;\n"
		"$field = $tag >> 3;\n"
		"//var_dump(\"`name`: Found $field type \" . `ns`Protobuf::get_wiretype($wire) . \" $limit bytes left\");\n"
		"switch($field) {\n",
		"name", ClassName(message),
		"ns", pb_namespace
	);
	printer.Indent();

	// If we are a group message, we need to add a end group case
	if (parentField && parentField->type() == FieldDescriptor::TYPE_GROUP) {
		printer.Print("case `index`:\n", "index", SimpleItoa(parentField->number()) );
		printer.Print( "  ASSERT('$wire == 4');\n"
					   "  break 2;\n");
	}

	for (int i = 0; i < message.field_count(); ++i) {
		const FieldDescriptor &field ( *message.field(i) );

		string var ( VariableName(field) );
		if (field.is_repeated())
			var += "[]";
		if (field.is_packable())
			throw "Error we do not yet support packed values";
		if (field.is_required())
			required_fields.push_back( &field );

		string commands;

		switch (field.type()) {
			case FieldDescriptor::TYPE_DOUBLE: // double, exactly eight bytes on the wire
				commands = "ASSERT('$wire == 1');\n"
						   "$tmp = `ns`Protobuf::read_double($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_double returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=8;";
				break;

			case FieldDescriptor::TYPE_FLOAT: // float, exactly four bytes on the wire.
				commands = "ASSERT('$wire == 5');\n"
						   "$tmp = `ns`Protobuf::read_float($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_float returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=4;";
				break;

			case FieldDescriptor::TYPE_INT64:  // int64, varint on the wire.
			case FieldDescriptor::TYPE_UINT64: // uint64, varint on the wire.
			case FieldDescriptor::TYPE_INT32:  // int32, varint on the wire.
			case FieldDescriptor::TYPE_UINT32: // uint32, varint on the wire
			case FieldDescriptor::TYPE_ENUM:   // Enum, varint on the wire
				commands = "ASSERT('$wire == 0');\n"
						   "$tmp = `ns`Protobuf::read_varint($fp, $limit);\n"
				           "if ($tmp === false)\n"
				           "  throw new Exception('Protobuf::read_varint returned false');\n"
				           "$this->`var` = $tmp;\n";
				break;

			case FieldDescriptor::TYPE_FIXED64: // uint64, exactly eight bytes on the wire.
				commands = "ASSERT('$wire == 1');\n"
						   "$tmp = `ns`Protobuf::read_uint64($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_unint64 returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=8;";
				break;

			case FieldDescriptor::TYPE_SFIXED64: // int64, exactly eight bytes on the wire
				commands = "ASSERT('$wire == 1');\n"
						   "$tmp = `ns`Protobuf::read_int64($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_int64 returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=8;";
				break;

			case FieldDescriptor::TYPE_FIXED32: // uint32, exactly four bytes on the wire.
				commands = "ASSERT('$wire == 5');\n"
						   "$tmp = `ns`Protobuf::read_uint32($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_uint32 returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=4;";
				break;

			case FieldDescriptor::TYPE_SFIXED32: // int32, exactly four bytes on the wire
				commands = "ASSERT('$wire == 5');\n"
						   "$tmp = `ns`Protobuf::read_int32($fp);\n"
						   "if ($tmp === false)\n"
						   "  throw new Exception('Protobuf::read_int32 returned false');\n"
						   "this->`var` = $tmp\n;"
						   "$limit-=4;";
				break;

			case FieldDescriptor::TYPE_BOOL: // bool, varint on the wire.
				commands = "ASSERT('$wire == 0');\n"
						   "$tmp = `ns`Protobuf::read_varint($fp, $limit);\n"
				           "if ($tmp === false)\n"
				           "  throw new Exception('Protobuf::read_varint returned false');\n"
				           "$this->`var` = $tmp > 0 ? true : false;";
				break;

			case FieldDescriptor::TYPE_STRING:  // UTF-8 text.
			case FieldDescriptor::TYPE_BYTES:   // Arbitrary byte array.
				commands = "ASSERT('$wire == 2');\n"
						   "$len = `ns`Protobuf::read_varint($fp, $limit);\n"
				           "if ($len === false)\n"
				           "  throw new Exception('Protobuf::read_varint returned false');\n"
				           "if ($len > 0)\n"
						   "  $tmp = fread($fp, $len);\n"
				           "else\n"
				           "  $tmp = '';\n"
				           "if ($tmp === false)\n"
				           "  throw new Exception(\"fread($len) returned false\");\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=$len;";
				break;

			case FieldDescriptor::TYPE_GROUP: {// Tag-delimited message.  Deprecated.
				const Descriptor & d( *field.message_type() );
				commands = "ASSERT('$wire == 3');\n"
						   "$this->`var` = new " + ClassName(d) + "($fp, $limit);";
				break;
			}

			case FieldDescriptor::TYPE_MESSAGE: {// Length-delimited message.
				const Descriptor & d( *field.message_type() );
				commands = "ASSERT('$wire == 2');\n"
						   "$len = `ns`Protobuf::read_varint($fp, $limit);\n"
				           "if ($len === false)\n"
				           "  throw new Exception('Protobuf::read_varint returned false');\n"
						   "$limit-=$len;\n"
						   "$this->`var` = new " + ClassName(d) + "($fp, $len);\n"
						   "ASSERT('$len == 0');";
				break;
			}

			case FieldDescriptor::TYPE_SINT32:   // int32, ZigZag-encoded varint on the wire
				commands = "ASSERT('$wire == 5');\n"
						   "$tmp = `ns`Protobuf::read_zint32($fp);\n"
				           "if ($tmp === false)\n"
				           "  throw new Exception('Protobuf::read_zint32 returned false');\n"
						   "$this->`var` = $tmp;\n"
						   "$limit-=4;";
				break;

			case FieldDescriptor::TYPE_SINT64:   // int64, ZigZag-encoded varint on the wire
				commands = "ASSERT('$wire == 1');\n"
				           "$tmp = `ns`Protobuf::read_zint64($fp);\n"
				           "if ($tmp === false)\n"
				           "  throw new Exception('Protobuf::read_zint64 returned false');\n"
				           "$this->`var` = $tmp;\n"
				           "$limit-=8;";
				break;

			default:
				throw "Error: Unsupported type";// TODO use the proper exception
		}

		printer.Print("case `index`:\n", "index", SimpleItoa(field.number()) );

		printer.Indent();
		printer.Print(commands.c_str(), "var", var, "ns", pb_namespace);
		printer.Print("\nbreak;\n");
		printer.Outdent();
	}

	if (skip_unknown) {
		printer.Print(
			"default:\n"
			"  $limit -= `ns`Protobuf::skip_field($fp, $wire);\n",
			"name", ClassName(message),
			"ns", pb_namespace
		);
	} else {
		printer.Print(
			"default:\n"
			"  $this->_unknown[$field . '-' . `ns`Protobuf::get_wiretype($wire)][] = `ns`Protobuf::read_field($fp, $wire, $limit);\n",
			"name", ClassName(message),
			"ns", pb_namespace
		);
	}

	printer.Outdent();
	printer.Outdent();
	printer.Print(
		"  }\n" // switch
		"}\n"   // while
	);

	printer.Outdent();
	printer.Print(
		"  if (!$this->validateRequired())\n"
		"    throw new Exception('Required fields are missing');\n"
		"}\n"
	);
}

/**
 * Turns a 32 bit number into a string suitable for PHP to print out.
 * For example, 0x12345678 would turn into "\x12\x34\x56\78".
 * @param tag
 * @return
 */
string arrayToPHPString(uint8 *a, size_t len) {

	assert(a != NULL);

	const int dest_length = len * 4 + 1; // Maximum possible expansion
	scoped_array<char> dest(new char[dest_length]);

	char *p = dest.get();

	while(len > 0) {
		uint8 c = *a++;
		if ((c >= 0 && c <= 31) || c >= 127 ) {
			p += sprintf(p, "\\x%02x", c);
		} else if (c == '"'){
			*p++ = '\\';
			*p++ = c;
		} else {
			*p++ = c;
		}

		len--;
	}

	*p = '\0'; // Null terminate us

	return string(dest.get());
}

/**
 * Some notes
 * Tag    <varint fieldID wireType>
 * Field  <tag> <value>
 * Length <tag> <len> <data>
 * Group  <start tag> <field>+ <end tag>
 * Embedded Message <tag> <len> <field>+
 * Start <field>+ (You have to know what type of Message it is, and it is not length prefixed)
 *
 * The Message class should not print its own length (this should be printed by the parent Message)
 * The Group class should only print its field, the parent should print the start/end tag
 * Otherwise the Message/Group will print everything of the fields.
 */

/**
 * Prints the write() method for this Message
 * @param printer
 * @param message
 * @param parentField
 */
void PHPCodeGenerator::PrintMessageWrite(io::Printer &printer, const Descriptor & message, const FieldDescriptor * parentField) const {

	// Parse the file options
	const PHPFileOptions & options ( message.file()->options().GetExtension(php) );
	const char * pb_namespace = options.namespace_().empty() ? "" : "\\";

	// Write
	printer.Print(
		"\n"
		"function write($fp) {\n"
	);
	printer.Indent();

	printer.Print(
		"if (!$this->validateRequired())\n"
		"  throw new Exception('Required fields are missing');\n"
	);

	for (int i = 0; i < message.field_count(); ++i) {
		const FieldDescriptor &field ( *message.field(i) );

		if (field.is_packable())
			throw "Error we do not yet support packed values";

		// Create the tag
		uint8 tag[5];
		uint8 *tmp;
		tmp = WireFormatLite::WriteTagToArray(
				field.number(),
				WireFormat::WireTypeForFieldType(field.type()),
				tag);
		int tagLen = tmp - tag;

		string commands;
		switch (field.type()) {
			case FieldDescriptor::TYPE_DOUBLE: // double, exactly eight bytes on the wire
				commands = "`ns`Protobuf::write_double($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_FLOAT: // float, exactly four bytes on the wire.
				commands = "`ns`Protobuf::write_float($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_INT64:  // int64, varint on the wire.
			case FieldDescriptor::TYPE_UINT64: // uint64, varint on the wire.
			case FieldDescriptor::TYPE_INT32:  // int32, varint on the wire.
			case FieldDescriptor::TYPE_UINT32: // uint32, varint on the wire
			case FieldDescriptor::TYPE_ENUM:   // Enum, varint on the wire
				commands = "`ns`Protobuf::write_varint($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_FIXED64: // uint64, exactly eight bytes on the wire.
				commands = "`ns`Protobuf::write_uint64($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_SFIXED64: // int64, exactly eight bytes on the wire
				commands = "`ns`Protobuf::write_int64($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_FIXED32: // uint32, exactly four bytes on the wire.
				commands = "`ns`Protobuf::write_uint32($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_SFIXED32: // int32, exactly four bytes on the wire
				commands = "`ns`Protobuf::write_int32($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_BOOL: // bool, varint on the wire.
				commands = "`ns`Protobuf::write_varint($fp, `var` ? 1 : 0);\n";
				break;

			case FieldDescriptor::TYPE_STRING:  // UTF-8 text.
			case FieldDescriptor::TYPE_BYTES:   // Arbitrary byte array.
				commands = "`ns`Protobuf::write_varint($fp, strlen(`var`));\n"
						   "fwrite($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_GROUP: {// Tag-delimited message.  Deprecated.
				// The start tag has already been printed, but also print the end tag
				uint8 endtag[5];
				tmp = WireFormatLite::WriteTagToArray(
						field.number(),
						WireFormatLite::WIRETYPE_END_GROUP,
						endtag);
				int endtagLen = tmp - endtag;
				commands = "`var`->write($fp); // group\n"
				           "fwrite($fp, \"" + arrayToPHPString(endtag, endtagLen) + "\");\n";
				break;
			}
			case FieldDescriptor::TYPE_MESSAGE: // Length-delimited message.
				commands = "`ns`Protobuf::write_varint($fp, `var`->size()); // message\n"
				           "`var`->write($fp);\n";
				break;

			case FieldDescriptor::TYPE_SINT32:   // int32, ZigZag-encoded varint on the wire
				commands = "`ns`Protobuf::write_zint32($fp, `var`);\n";
				break;

			case FieldDescriptor::TYPE_SINT64:   // int64, ZigZag-encoded varint on the wire
				commands = "`ns`Protobuf::write_zint64($fp, `var`);\n";
				break;

			default:
				throw "Error: Unsupported type";// TODO use the proper exception
		}

		if (field.is_repeated()) {
			printer.Print(
				"if (!is_null($this->`var`))\n"
				"  foreach($this->`var` as $v) {\n",
				"var", VariableName(field)
			);
			printer.Indent(); printer.Indent();
			printer.Print("fwrite($fp, \"`tag`\");\n", "tag", arrayToPHPString(tag, tagLen));
			printer.Print(commands.c_str(),
				"var", "$v",
				"ns", pb_namespace
			);
			printer.Outdent(); printer.Outdent();
			printer.Print("  }\n");

		} else {
			printer.Print(
				"if (!is_null($this->`var`)) {\n",
				"var", VariableName(field)
			);
			printer.Indent();
			printer.Print("fwrite($fp, \"`tag`\");\n", "tag", arrayToPHPString(tag, tagLen));
			printer.Print(commands.c_str(),
				"var", "$this->" + VariableName(field),
				"ns", pb_namespace
			);
			printer.Outdent();
			printer.Print("}\n");
		}
	}

	printer.Outdent();
	printer.Print("}\n");
}

void PHPCodeGenerator::PrintMessageSize(io::Printer &printer, const Descriptor & message) const {
	// Parse the file options
	const PHPFileOptions & options ( message.file()->options().GetExtension(php) );
	const char * pb_namespace = options.namespace_().empty() ? "" : "\\";

	// Print the calc size method
	printer.Print(
		"\n"
		"public function size() {\n"
		"  $size = 0;\n"
	);
	printer.Indent();

	for (int i = 0; i < message.field_count(); ++i) {
		const FieldDescriptor &field ( *message.field(i) );

		// Calc the size of the tag needed
		int tag = WireFormat::TagSize(field.number(), field.type());

		string command;

		switch (WireFormat::WireTypeForField(&field)) {

			case WireFormatLite::WIRETYPE_VARINT:
				if (field.type() == FieldDescriptor::TYPE_BOOL) {
					tag++; // A bool will always take 1 byte
					command = "$size += `tag`;\n";
				} else {
					command = "$size += `tag` + `ns`Protobuf::size_varint(`var`);\n";
				}
				break;

			case WireFormatLite::WIRETYPE_FIXED32:
				tag += 4;
				command = "$size += `tag`;\n";
				break;

			case WireFormatLite::WIRETYPE_FIXED64:
				tag += 8;
				command = "$size += `tag`;\n";
				break;

			case WireFormatLite::WIRETYPE_LENGTH_DELIMITED:
				if (field.type() == FieldDescriptor::TYPE_MESSAGE) {
					command = "$l = `var`->size();\n";
				} else {
					command = "$l = strlen(`var`);\n";
				}

				command += "$size += `tag` + `ns`Protobuf::size_varint($l) + $l;\n";
				break;

			case WireFormatLite::WIRETYPE_START_GROUP:
			case WireFormatLite::WIRETYPE_END_GROUP:
				// WireFormat::TagSize returns the tag size * two when using groups, to account for both the start and end tag
				command += "$size += `tag` + `var`->size();\n";
				break;

			default:
				throw "Error: Unsupported wire type";// TODO use the proper exception
		}

		map<string, string> variables;
		variables["tag"] = SimpleItoa(tag);
		variables["ns"]  = pb_namespace;

		if (field.is_repeated()) {
			printer.Print(
				"if (!is_null($this->`var`))\n"
				"  foreach($this->`var` as $v) {\n",
				"var", VariableName(field)
			);
			printer.Indent(); printer.Indent();

			variables["var"] ="$v";
			printer.Print(variables, command.c_str());

			printer.Outdent(); printer.Outdent();
			printer.Print("  }\n");

		} else {
			printer.Print(
				"if (!is_null($this->`var`)) {\n",
				"var", VariableName(field)
			);
			printer.Indent();

			variables["var"] = "$this->" + VariableName(field);
			printer.Print(variables, command.c_str());

			printer.Outdent();
			printer.Print("}\n");
		}
	}
	printer.Outdent();
	printer.Print(
		"  return $size;\n"
		"}\n"
	);
}

void PHPCodeGenerator::PrintMessage(io::Printer &printer, const Descriptor & message) const {
	// Parse the file options
	const PHPFileOptions & options ( message.file()->options().GetExtension(php) );
	bool skip_unknown = options.skip_unknown();
	const char * pb_namespace = options.namespace_().empty() ? "" : "\\";

	vector<const FieldDescriptor *> required_fields;

	// Print nested messages
	for (int i = 0; i < message.nested_type_count(); ++i) {
		printer.Print("\n");
		PrintMessage(printer, *message.nested_type(i));
	}

	// Print nested enum
	for (int i = 0; i < message.enum_type_count(); ++i) {
		PrintEnum(printer, *message.enum_type(i) );
	}

	// Find out if we are a nested type, if so what kind
	const FieldDescriptor * parentField = NULL;
	const char * type = "message";
	if (message.containing_type() != NULL) {
		const Descriptor & parent ( *message.containing_type() );

		// Find which field we are
		for (int i = 0; i < parent.field_count(); ++i) {
			if (parent.field(i)->message_type() == &message) {
				parentField = parent.field(i);
				break;
			}
		}
		if (parentField->type() == FieldDescriptor::TYPE_GROUP)
			type = "group";
	}

	// Start printing the message
	printer.Print("// `type` `full_name`\n",
				  "type", type,
				  "full_name", message.full_name()
	);

	printer.Print("class `name` {\n",
				  "name", ClassName(message)
	);
	printer.Indent();

	// Print fields map
	/*
	printer.Print(
		"// Array maps field indexes to members\n"
		"private static $_map = array (\n"
	);
	printer.Indent();
			for (int i = 0; i < message.field_count(); ++i) {
		const FieldDescriptor &field ( *message.field(i) );

		printer.Print("`index` => '`value`',\n",
			"index", SimpleItoa(field.number()),
			"value", VariableName(field)
		);
	}
	printer.Outdent();
	printer.Print(");\n\n");
	*/
	if (!skip_unknown)
		printer.Print("private $_unknown;\n");

	// Constructor
	printer.Print(
		"\n" // TODO maybe some kind of inhertiance would reduce all this code!
		"function __construct($in = NULL, &$limit = PHP_INT_MAX) {\n"
		"  if($in !== NULL) {\n"
		"    if (is_string($in)) {\n"
		"      $fp = fopen('php://memory', 'r+b');\n"
		"      fwrite($fp, $in);\n"
		"      rewind($fp);\n"
		"    } else if (is_resource($in)) {\n"
		"      $fp = $in;\n"
		"    } else {\n"
		"      throw new Exception('Invalid in parameter');\n"
		"    }\n"
		"    $this->read($fp, $limit);\n"
		"  }\n"
		"}\n"
	);

	// Print the read/write methods
	PrintMessageRead(printer, message, required_fields, parentField);
	PrintMessageWrite(printer, message, parentField);

	PrintMessageSize(printer, message);

	// Validate that the required fields are included
	printer.Print(
		"\n"
		"public function validateRequired() {\n"
	);
	printer.Indent();
	for (int i = 0; i < required_fields.size(); ++i) {
		printer.Print("if ($this->`name` === null) return false;\n",
			"name", VariableName(*required_fields[i])
		);
	}
	printer.Print("return true;\n");
	printer.Outdent();
	printer.Print("}\n");

	// Print a toString method
	printer.Print(
		"\n"
		"public function __toString() {\n"
		"  return ''"
	);
	printer.Indent();

	if (!skip_unknown)
		printer.Print("\n     . `ns`Protobuf::toString('unknown', $this->_unknown)", "ns", pb_namespace);

	map<string, string> variables;

	for (int i = 0; i < message.field_count(); ++i) {
		const FieldDescriptor &field ( *message.field(i) );
		variables.clear();
		variables["name"] = VariableName(field);
		variables["ns"]   = pb_namespace;

		if (field.type() == FieldDescriptor::TYPE_ENUM) {
			variables["enum"] = ClassName(*field.enum_type());
			printer.Print(variables,
				"\n     . `ns`Protobuf::toString('`name`', `enum`::toString($this->`name`))"
			);
		} else {
			printer.Print(variables,
				"\n     . `ns`Protobuf::toString('`name`', $this->`name`)"
			);
		}
	}
	printer.Print(";\n");
	printer.Outdent();
	printer.Print("}\n");

	// Print fields variables and methods
	for (int i = 0; i < message.field_count(); ++i) {
		printer.Print("\n");

		const FieldDescriptor &field ( *message.field(i) );

		map<string, string> variables;
		variables["name"]             = VariableName(field);
		variables["capitalized_name"] = UnderscoresToCapitalizedCamelCase(field);
		variables["default"]          = DefaultValueAsString(field, true);
		variables["comment"]          = field.DebugString();

		if (field.type() == FieldDescriptor::TYPE_GROUP) {
			size_t p = variables["comment"].find ('{');
			if (p != string::npos)
				variables["comment"].resize (p - 1);
		}

		// TODO Check that comment is a single line

		switch (field.type()) {
//			If its a enum we should store it as a int
//			case FieldDescriptor::TYPE_ENUM:
//				variables["type"] = field.enum_type()->name() + " ";
//				break;

			case FieldDescriptor::TYPE_MESSAGE:
			case FieldDescriptor::TYPE_GROUP:
				variables["type"] = ClassName(*field.message_type()) + " ";
				break;

			default:
				variables["type"] = "";
		}

		if (field.is_repeated()) {
			// Repeated field
			printer.Print(variables,
				"// `comment`\n"
				"private $`name` = null;\n"
				"public function clear`capitalized_name`() { $this->`name` = null; }\n"

				"public function get`capitalized_name`Count() { if ($this->`name` === null ) return 0; else return count($this->`name`); }\n"
				"public function get`capitalized_name`($index) { return $this->`name`[$index]; }\n"
				"public function get`capitalized_name`Array() { if ($this->`name` === null ) return array(); else return $this->`name`; }\n"
			);

			// TODO Change the set code to validate input depending on the variable type
			printer.Print(variables,
				"public function set`capitalized_name`($index, $value) {$this->`name`[$index] = $value;	}\n"
				"public function add`capitalized_name`($value) { $this->`name`[] = $value; }\n"
				"public function addAll`capitalized_name`(array $values) { foreach($values as $value) {$this->`name`[] = $value;} }\n"
			);

		} else {
			// Non repeated field
			printer.Print(variables,
				"// `comment`\n"
				"private $`name` = null;\n"
				"public function clear`capitalized_name`() { $this->`name` = null; }\n"
				"public function has`capitalized_name`() { return $this->`name` !== null; }\n"

				"public function get`capitalized_name`() { if($this->`name` === null) return `default`; else return $this->`name`; }\n"
			);

			// TODO Change the set code to validate input depending on the variable type
			printer.Print(variables,
				"public function set`capitalized_name`(`type`$value) { $this->`name` = $value; }\n"
			);
		}
			}

	// Class Insertion Point
	printer.Print(
		"\n"
		"// @@protoc_insertion_point(class_scope:`full_name`)\n",
		"full_name", message.full_name()
	);

	printer.Outdent();
	printer.Print("}\n\n");
}

void PHPCodeGenerator::PrintEnum(io::Printer &printer, const EnumDescriptor & e) const {

	printer.Print("// enum `full_name`\n"
				  "class `name` {\n",
				  "full_name", e.full_name(),
				  "name", ClassName(e)
	);

	printer.Indent();

	// Print fields
	for (int j = 0; j < e.value_count(); ++j) {
		const EnumValueDescriptor &value ( *e.value(j) );

		printer.Print(
			"const `name` = `number`;\n",
			"name",   UpperString(value.name()),
			"number", SimpleItoa(value.number())
		);
	}

	// Print values array
	printer.Print("\npublic static $_values = array(\n");
	printer.Indent();
	for (int j = 0; j < e.value_count(); ++j) {
		const EnumValueDescriptor &value ( *e.value(j) );

		printer.Print(
			"`number` => self::`name`,\n",
			"number", SimpleItoa(value.number()),
			"name",   UpperString(value.name())
		);
	}
	printer.Outdent();
	printer.Print(");\n\n");

	// Print a toString
	printer.Print(
		"public static function toString($value) {\n"
		"  if (is_null($value)) return null;\n"
		"  if (array_key_exists($value, self::$_values))\n"
		"    return self::$_values[$value];\n"
		"  return 'UNKNOWN';\n"
		"}\n"
	);

	printer.Outdent();
	printer.Print("}\n\n");
}

void PHPCodeGenerator::PrintMessages(io::Printer &printer, const FileDescriptor & file) const {
	for (int i = 0; i < file.message_type_count(); ++i) {
		PrintMessage(printer, *file.message_type(i));
	}
}

void PHPCodeGenerator::PrintEnums(io::Printer &printer, const FileDescriptor & file) const {
	for (int i = 0; i < file.enum_type_count(); ++i) {
		PrintEnum(printer, *file.enum_type(i) );
	}
}

void PHPCodeGenerator::PrintServices(io::Printer &printer, const FileDescriptor & file) const {
	for (int i = 0; i < file.service_count(); ++i) {
		printer.Print("////\n//TODO Service\n////\n");
	}
}

bool PHPCodeGenerator::Generate(const FileDescriptor* file,
				const string& parameter,
				OutputDirectory* output_directory,
				string* error) const {

	string php_filename ( file->name() + ".php" );

	// Parse the options
	const PHPFileOptions & options ( file->options().GetExtension(php) );
	const string & namespace_ (options.namespace_());

	// Generate main file.
	scoped_ptr<io::ZeroCopyOutputStream> output(
		output_directory->Open(php_filename)
	);

	io::Printer printer(output.get(), '`');

	try {
		printer.Print(
			"<?php\n"
			"// Please include the below file before `filename`\n"
			"//require('protocolbuffers.inc.php');\n",
			"filename", php_filename.c_str()
		);

		if (!namespace_.empty()) {
			printer.Print("namespace `ns` {\n", "ns", namespace_.c_str());
			printer.Indent();
		}

		PrintMessages  (printer, *file);
		PrintEnums     (printer, *file);
		PrintServices  (printer, *file);

		if (!namespace_.empty()) {
			printer.Outdent();
			printer.Print("}");
		}

	} catch (const char *msg) {
		error->assign( msg );
		return false;
	}

	return true;
}


int main(int argc, char* argv[]) {
	PHPCodeGenerator generator;
	return PluginMain(argc, argv, &generator);
}
