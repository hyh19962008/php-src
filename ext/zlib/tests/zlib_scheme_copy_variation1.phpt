--TEST--
Test compress.zlib:// scheme with the copy function: compressed to uncompressed
--EXTENSIONS--
zlib
--FILE--
<?php
$inputFileName = __DIR__."/data/test.txt.gz";
$outputFileName = __FILE__.'.tmp';

$srcFile = "compress.zlib://$inputFileName";
$destFile = $outputFileName;
copy($srcFile, $destFile);

$h = gzopen($inputFileName, 'r');
$org_data = gzread($h, 4096);
gzclose($h);

// can only read uncompressed data
$h = fopen($outputFileName, 'r');
$copied_data = fread($h, 4096);
gzclose($h);

if ($org_data == $copied_data) {
   echo "OK: Copy identical\n";
}
else {
   echo "FAILED: Copy not identical";
}
unlink($outputFileName);
?>
--EXPECT--
OK: Copy identical
