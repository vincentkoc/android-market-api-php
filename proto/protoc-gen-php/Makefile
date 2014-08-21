
CXX=g++
#CXX=/home/bramp/llvm/Debug/bin/clang

CXXFLAGS = -Wall -g

INCLUDES =
LFLAGS   =
LIBS     = -lprotobuf -lprotoc -pthread

SRCS = php_options.pb.cc strutil.cc protoc-gen-php.cc
OBJS = $(SRCS:.cc=.o)

MAIN = protoc-gen-php

SHELL = /bin/sh
.SUFFIXES:
.SUFFIXES: .cc .o .proto

.PHONY: all clean depend valgrind debug test Makefile

all:    $(MAIN)
$(MAIN): $(OBJS)
	$(CXX) $(CXXFLAGS) $(INCLUDES) -o $(MAIN) $(OBJS) $(LFLAGS) $(LIBS)

php_options.pb.cc php_options.pb.h: php_options.proto
	protoc php_options.proto --cpp_out=. -I. -I/usr/include -I/usr/local/include

.cc.o:
	$(CXX) $(CXXFLAGS) $(INCLUDES) -c $<  -o $@

clean:
	$(RM) *.o $(MAIN) $(GENTESTS) php_options.pb.cc php_options.pb.h

depend: $(SRCS)
	makedepend $(INCLUDES) $^

valgrind: DEBUGCMD=gdb --args
debug: all
	gdb --args protoc --php_out . --plugin=protoc-gen-php=./protoc-gen-php market.proto

valgrind: DEBUGCMD=valgrind --trace-children=yes --leak-check=full
valgrind: all test

TESTS = test.proto addressbook.proto market.proto
GENTESTS = $(TESTS:.proto=.proto.php)
%.proto.php : %.proto $(MAIN)
	$(DEBUGCMD) protoc -I. -I/usr/include --php_out . --plugin=protoc-gen-php=./protoc-gen-php $<;

test: $(GENTESTS)
	for file in $(TESTS); do \
#		echo | cat -n $${file}.php -; \
		php --syntax-check $${file}.php; \
		php test.php $${file}; \
		hd temp > temp.hd; \
	done ;
