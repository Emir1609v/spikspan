<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('config.php');

require 'vendor/autoload.php'; 
require 'config.php'; 

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buyer_email = $_POST['email'];
    $ticket_code = bin2hex(random_bytes(10)); 
    $qr_hash = password_hash($ticket_code, PASSWORD_BCRYPT); 

    $stmt = $conn->prepare("INSERT INTO tickets (buyer_email, ticket_code, qr_hash) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $buyer_email, $ticket_code, $qr_hash);
    $stmt->execute();
    $stmt->close();

    $qrCode = Builder::create()
    ->writer(new PngWriter())
    ->data($ticket_code)
    ->encoding(new Encoding('UTF-8'))
    ->size(300)
    ->margin(10)
    ->backgroundColor(new Color(255, 255, 255))
    ->build();

// Save the QR code as a PNG file
$qrPath = "qrcodes/" . $ticket_code . ".png";
$qrCode->saveToFile($qrPath);

    // Send Email with QR Code
    $subject = "Your Concert Ticket";
    $body = "Here is your ticket. Show this QR code at the entrance.";
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $mail_body = "<p>$body</p><img src='cid:qrcode' />";
    $boundary = md5(time());
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

    $message = "--$boundary\r\n";
    $message .= "Content-Type: text/html; charset=UTF-8\r\n";
    $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $message .= $mail_body . "\r\n";
    $message .= "--$boundary\r\n";
    $message .= "Content-Type: image/png; name=\"ticket.png\"\r\n";
    $message .= "Content-Disposition: inline; filename=\"ticket.png\"\r\n";
    $message .= "Content-ID: <qrcode>\r\n";
    $message .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $message .= chunk_split(base64_encode(file_get_contents($qrPath))) . "\r\n";
    $message .= "--$boundary--";

    mail($buyer_email, $subject, $message, $headers);

    echo "Ticket purchased! Check your email for the QR code.";
}
?>
