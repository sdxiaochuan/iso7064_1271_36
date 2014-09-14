iso7064_1271_36
===============

Usage:

1. Return two check characters directly for the given string.

$string = "8CEcc112vc";
ISO7064_1271_36::compute($string);


2. Return protected codes for the given string

$iso = new ISO7064_1271_36();
$string = $iso->valid("8CEcc112vc");


3. Verify the give string

$iso = new ISO7064_1271_36();
$string = $iso->verify("8CEcc112vcpm");