<?php
// vérification de connexion et de rôle
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}





    if ($_SESSION['role'] != 'admin') {
        header("Location: ../employee/employee_dashboard.php"); 
        exit();
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
<?php include("../assets/admin-header.php");?>
    <p>admin dashboard</p>
    <form action="deconnexion.php">
        <input type="submit" value="se déconnecter">
    </form>
</body>
</html>