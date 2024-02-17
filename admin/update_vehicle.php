<?php
require_once '../includes/db.php';


session_start();



if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}




    if ($_SESSION['role'] != 'admin') {
        header("Location: ../employee/employee_dashboard.php"); 
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $description = $_POST['description'];



    $stmt = $pdo->prepare("UPDATE vehicles SET make = ?, model = ?, year = ?, price = ?, description = ? WHERE id = ?");
    $stmt->execute([$make, $model, $year, $price, $description, $id]);

    echo "Véhicule mis à jour avec succès.";
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="admin_dashboard.php">retour au dashbord -></a>
</body>
</html>
