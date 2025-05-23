<?php
require "vendor/autoload.php"; // QR Code lib laden

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Logo\Logo;

// Verbinden met database
$mysqli = new mysqli("localhost", "root", "", "db_spikenspan");
if ($mysqli->connect_error) {
    die("Connectie mislukt: " . $mysqli->connect_error);
}

// Formulierdata ophalen
$name = $_POST['name'] ?? "Onbekend";
$email = $_POST['email'] ?? "";
$location = $_POST['location'] ?? "Onbekend";
$tickets = (int)$_POST['tickets'];
$total = $tickets * 10;

// QR-inhoud maken
$qrText = "Naam: $name\nEmail: $email\nTickets: $tickets\nPlaats: $location\nTotaal: €$total";
$filename = 'qr/' . uniqid('ticket_') . '.png';

// QR-code genereren
$qrCode = new QrCode($qrText);
$writer = new PngWriter();

// Logo toevoegen als het bestaat
$logoPath = "spikspan.png";
if (file_exists($logoPath)) {
    $logo = new Logo($logoPath, 50, 50);
    $result = $writer->write($qrCode, $logo);
} else {
    $result = $writer->write($qrCode);
}

// QR-code opslaan
$result->saveToFile($filename);

// Gegevens in database opslaan
$stmt = $mysqli->prepare("INSERT INTO tickets (name, email, location, num_tickets, total_price, qr_path) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssids", $name, $email, $location, $tickets, $total, $filename);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Bevestiging</title>
  <link rel="stylesheet" href="tickets.css">
  <style>
    .confirmation {
      background: white;
      padding: 2rem 3rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 100%;
      text-align: center;
    }

    .confirmation h2 {
      color: #28a745;
    }

    .qr-image {
      margin: 1.5rem 0;
    }

    .download-btn {
      display: inline-block;
      padding: 0.7rem 1.5rem;
      background: #007bff;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .download-btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="form-container confirmation">
    <h2>✅ Bestelling gelukt!</h2>
    <p><strong>Naam:</strong> <?php echo htmlspecialchars($name); ?></p>
    <p><strong>Aantal tickets:</strong> <?php echo $tickets; ?></p>
    <p><strong>Totaalprijs:</strong> €<?php echo number_format($total, 2, ',', '.'); ?></p>

    <div class="qr-image">
      <img src="<?php echo $filename; ?>" alt="QR-code voor je ticket" width="200">
    </div>

    <a class="download-btn" href="<?php echo $filename; ?>" download>🎟️ Download je factuur</a>
  </div>
</body>
</html>

