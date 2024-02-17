<?php
session_start();
require_once "../includes/db.php";

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    if($_SESSION['role'] == 'admin'){
   
    header('Location: ../admin/admin_dashboard.php'); // Ceci est un placeholder, ajustez selon votre logique
    exit;
}
}


$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, password, role FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
       
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role']; // Stocker le rôle dans la session

        // Rediriger l'utilisateur en fonction de son rôle
        if ($user['role'] == 'admin') {
            header('Location: ../admin/admin_dashboard.php'); 
        } else if ($user['role'] == 'employee') {
            header('Location: ../employee/employee_dashboard.php'); 
        } else {
            header('Location: login.php'); 
        }
        exit;
    } else {
        $error = 'Identifiants incorrects.';
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Connexion - Garage V. Parrot</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <style>
        h1, h2, h3, h4, h5, h6 {
            color: #003366;
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: bold;
        }
.section-header {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("../images/image-header-vehicles.png") no-repeat center center;
    background-size: cover;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.section-header h1 {
    color: #fff;
    font-size: 2.5rem; 
    text-shadow: 2px 2px 4px #000;
}

body {
    font-family: 'Open Sans';
    background-color: #f8f9fa;
    color: #212529;
}</style>
</head>
<body>
<?php include("../assets/header.php");?>
<div class="login-form">
    <?php if ($error): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <h2 class="text-center">Connexion</h2>       
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Mot de passe" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
        </div>      
    </form>
</div>
</body>
</html>
