<?php
// Include the library
include '../libraries/phpqrcode/qrlib.php';

// The data to encode as a QR code
$data = "Hello, world!";

// The file path to save the QR code image
$filename = '../Images/qrcodes/qrcode.png';

// Generate the QR code image
QRcode::png($data, $filename);

// Output the QR code image to the browser
header('Content-Type: image/png');
readfile($filename);
?>