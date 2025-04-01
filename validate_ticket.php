<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['code'])) {
    $scanned_code = $_GET['code'];

    $stmt = $conn->prepare("SELECT id, is_used FROM tickets WHERE ticket_code = ?");
    $stmt->bind_param("s", $scanned_code);
    $stmt->execute();
    $result = $stmt->get_result();
    $ticket = $result->fetch_assoc();

    if (!$ticket) {
        echo "Invalid ticket!";
    } elseif ($ticket['is_used']) {
        echo "This ticket has already been used!";
    } else {
        $updateStmt = $conn->prepare("UPDATE tickets SET is_used = 1 WHERE id = ?");
        $updateStmt->bind_param("i", $ticket['id']);
        $updateStmt->execute();
        echo "Ticket validated. Enjoy the concert!";
    }
}
?>
