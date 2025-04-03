<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $province = $_POST['province'];

    // CSV-bestand openen om gegevens op te slaan
    $file = fopen("data.csv", "a");

    // Omschrijven naar CSV
    fputcsv($file, [$name, $email, $age, $province]);

    fclose($file);

    echo "Gegevens succesvol verzonden!";
}
?>
