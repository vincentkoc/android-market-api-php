<?php
	require('protocolbuffers.inc.php');

/*
$varint_tests  = array(
	1   => "\x01",
	2   => "\x02",
	127 => "\x7F",
	128 => "\x80\x01",
	300 => "\xAC\x02",
);

function test_varint() {
	global $varint_tests;

	$fp = fopen('php://memory', 'r+b');
	if ($fp === false)
		exit('Unable to open stream');

	foreach ($varint_tests as $i => $enc) {

		// Write the answer into the buffer
		fseek($fp, 0, SEEK_SET);
		fwrite($fp, $enc);
		fseek($fp, 0, SEEK_SET);

		$a = Protobuf::read_varint($fp);
		if ($a != $i)
			exit("Failed to decode varint($i) got $a\n");

		$len = Protobuf::write_varint($fp, $i);
		fseek($fp, 0, SEEK_SET);
		$b = fread($fp, $len);
		if ($b != $enc)
			exit("Failed to encode varint($i)\n");

		$len = Protobuf::size_varint($i);

		echo "$i len($len) OK\n";
	}
	fclose($fp);
}
test_varint();
*/

	if ($argc > 1) {
		$test = $argv[1];
		require("$test.php");

		if ($test == 'addressbook.proto') {
			$fp = fopen('test.book', 'rb');

			$m = new tutorial_AddressBook($fp);

			var_dump($m);

			fclose($fp);

		} else if ($test == 'market.proto') {
			//$fp = fopen('market2-in-1.dec', 'rb');
			$fp = fopen('market2-in-2.dec', 'rb');
			//$fp = fopen('temp', 'rb');

			$m = new Response($fp);

			echo $m;

			//$mem = fopen('php://memory', 'wb');
			$mem = fopen('temp', 'wb');
			if ($mem === false)
				exit('Unable to open output stream');

			$s = fstat($fp);
			echo 'File size: ' . $s['size'] . "\n";
			echo 'Guested size: ' . $m->size() . "\n";
			$m->write($mem);
			echo 'Write size: ' . ftell($mem) . "\n";

			fclose($mem);
			fclose($fp);
		}
	}

?>
