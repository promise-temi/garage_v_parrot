<?php
require_once '../includes/db.php'; 

session_start();


//vérification de connexion et de rôle

if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}




    if ($_SESSION['role'] != 'admin') {
        header("Location: ../employee/employee_dashboard.php"); 
        exit();
    }

$stmt = $pdo->query("SELECT id, make, model, year, price FROM vehicles");
$vehicles = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
    font-family: 'Roboto Condensed', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 20px;
}

.vehicules {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.vehicules div {
    background-color: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.vehicules div a {
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    margin-left: 10px;
}

.vehicules div a.modifier {
    background-color: #007bff;
    color: #fff;
}

.vehicules div a.supprimer {
    background-color: #dc3545;
    color: #fff;
}

@media (max-width: 768px) {
    .vehicules {
        grid-template-columns: 1fr;
    }
}

    </style>
</head>
<body>
<?php include("../assets/admin-header.php");?>
  <div class="vehicules">
    <?php
foreach ($vehicles as $vehicle) {
    echo "<div>{$vehicle['make']} {$vehicle['model']} ({$vehicle['year']}) - {$vehicle['price']}€";
    echo " <a href='edit_vehicle.php?id={$vehicle['id']}'>Modifier</a>";
    echo " <a href='delete_vehicle.php?id={$vehicle['id']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce véhicule ?\");'>Supprimer</a>";
    echo "</div>";
}?>
  </div>  
</body>
</html>
