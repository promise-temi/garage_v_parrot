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
    









if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = 'employee';

    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $password, $role])) {
        echo "Compte employé créé avec succès.";
    } else {
        echo "Erreur lors de la création du compte.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
    font-family: 'Roboto Condensed', sans-serif;
    background-color: #f0f0f0;
    
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

label {
    font-weight: bold;
    display: block;
    margin-top: 20px;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    form {
        margin: 20px;
    }
}

    </style>
</head>

<body>
<?php include("../assets/admin-header.php");?>
    <form action="" method="POST">
    <label for="email">email de l'employé</label>
    <input type="text" name="email">
    <label for="password">mot de passe de l'employée</label>
    <input type="password" name="password">
    <input type="submit">
</form>
</body>
</html>

