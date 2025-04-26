<?php


use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

require 'vendor/autoload.php'; // Ensure Composer's autoload is included




function generateQRCodeWithLogo($data, $logoPath)
{
    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel' => QRCode::ECC_H,
        'scale' => 10,
        'imageBase64' => false, // We will convert to base64 manually
    ]);

    // Generate the QR code image
    $qrOutputInterface = new QRCode($options);
    $qrImage = $qrOutputInterface->render($data);

    // Load the QR code and logo images
    $qrImageResource = imagecreatefromstring($qrImage);
    $logoImageResource = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $logoPath);

    // Get dimensions
    $qrWidth = imagesx($qrImageResource);
    $qrHeight = imagesy($qrImageResource);
    $logoWidth = imagesx($logoImageResource);
    $logoHeight = imagesy($logoImageResource);

    // Calculate logo placement
    $logoQRWidth = $qrWidth / 5; // Logo will cover 1/5th of the QR code
    $scaleFactor = $logoWidth / $logoQRWidth;
    $logoQRHeight = $logoHeight / $scaleFactor;

    $xPos = ($qrWidth - $logoQRWidth) / 2;
    $yPos = ($qrHeight - $logoQRHeight) / 2;

    // Merge logo onto QR code
    imagecopyresampled(
        $qrImageResource,
        $logoImageResource,
        $xPos,
        $yPos,
        0,
        0,
        $logoQRWidth,
        $logoQRHeight,
        $logoWidth,
        $logoHeight
    );

    // Output QR code with logo to a string
    ob_start();
    imagepng($qrImageResource);
    $outputImage = ob_get_clean();

    // Convert to base64
    $base64 = base64_encode($outputImage);

    // Free memory
    imagedestroy($qrImageResource);
    imagedestroy($logoImageResource);

    return $base64;
}
