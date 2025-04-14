<?php

require "vendor/autoload.php";  // Load Endroid QR Code and PHPMailer

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\ErrorCorrectionLevel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? "Unknown";
    $email = $_POST["email"] ?? "";
    $age = $_POST["age"] ?? "N/A";
    $city = $_POST["city"] ?? "Unknown";

    $qrData = "Name: $name\nEmail: $email\nAge: $age\nCity: $city";

    
    $qrCode = new QrCode($qrData);

    $writer = new PngWriter();
    
    
    $logoPath = "spikspan.png";
    if (file_exists($logoPath)) {
        $logo = new Logo($logoPath, 50, 50); 
    } else {
        $logo = null;
    }

    
    $result = $writer->write($qrCode, $logo);

   
    $qrFilePath = "qr-code.png";
    $result->saveToFile($qrFilePath);

 
    sendEmail($email, $name, $qrFilePath);

    echo "<h2>Your QR Code</h2>";
    echo "<img src='$qrFilePath' alt='QR Code'>";
    echo "<br><br>";
    echo "<a href='$qrFilePath' download>Download QR Code</a>";
}


function sendEmail($toEmail, $userName, $qrFilePath) {
    $mail = new PHPMailer(true);

    try {
       
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = '';  
        $mail->Password = ''; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        
        $mail->setFrom('', 'mailer');  
        $mail->addAddress($toEmail, $userName);  

        
        $mail->addAttachment($qrFilePath, 'qr-code.png');  

       
        $mail->isHTML(false);  
        $mail->Subject = 'Your QR Code';
        $mail->Body    = "Hello $userName,\n\nHere is your QR Code with your details.\n\nBest Regards,\nQR Code Service";
        
        
        $mail->send();
        echo "<br>Email sent successfully to $toEmail!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}





// //
// <?php

// require_once "index.php";
// require "vendor/autoload.php";

// use Endroid\QrCode\QrCode;
// use Endroid\QrCode\Writer\PngWriter;
// use Endroid\QrCode\Logo\Logo;

// $text = $_POST["text"] ?? 'Default QR Code Text'; 


// $qrCode = new QrCode($text);


// $writer = new PngWriter();

// $logoPath = "spikspan.png";
// if (file_exists($logoPath)) {
//     $logo = new Logo($logoPath, 100, 100); 
// } else {
//     $logo = null; 
// }

// $result = $writer->write($qrCode, $logo);


// $result->saveToFile("qr-code.png");


// header("Content-Type: " . $result->getMimeType());
// echo $result->getString(); //
