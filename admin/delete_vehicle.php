<?php
require_once '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM vehicles WHERE id = ?");
    $stmt->execute([$id]);

    echo "Véhicule supprimé avec succès.";
    // Redirection vers la liste des véhicules
} else {
    echo "ID de véhicule non spécifié.";
}
?>
