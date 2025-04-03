<?php
// Laad de autoloader van Composer
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// CSV-bestand inlezen
$csvFile = fopen("data.csv", "r");

// Maak een nieuw Spreadsheet-object aan
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Lees de gegevens uit het CSV-bestand en schrijf ze naar het Excel-bestand
$rowNum = 1; // Begin bij de eerste rij
while (($data = fgetcsv($csvFile)) !== FALSE) {
    // Zet de data in het Excel-bestand
    $sheet->fromArray($data, NULL, 'A' . $rowNum);
    $rowNum++;
}

// Sluit het CSV-bestand
fclose($csvFile);

// Sla het Excel-bestand op
$writer = new Xlsx($spreadsheet);
$writer->save('data.xlsx');

echo "Het Excel-bestand is succesvol aangemaakt!";
?>
