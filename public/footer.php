<?php
require_once 'db.php'; // Assurez-vous que le chemin est correct

$stmt = $pdo->query("SELECT day, open_time, close_time FROM opening_hours ORDER BY FIELD(day, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')");
$hours = $stmt->fetchAll();

foreach ($hours as $hour) {
    echo htmlspecialchars($hour['day']) . ": " . date('H:i', strtotime($hour['open_time'])) . " - " . date('H:i', strtotime($hour['close_time'])) . "<br>";
}
?>
