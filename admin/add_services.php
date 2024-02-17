<?php 

require_once "../includes/db.php"; // Ajustez le chemin si nécessaire


session_start();



if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}



//  vérification de connexion et de rôle

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../employee/employee_dashboard.php"); // Dashboard Employé
        exit();
    }

if(isset($_POST["ajouter-service"])){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // Insertion dans la base de données (avec le chemin de l'image)
    $stmt = $pdo->prepare("INSERT INTO services (name, description) VALUES (?, ?)");
    $stmt->execute([$name, $description]);

    echo "Véhicule ajouté avec succès.";
    header("Location: site.php"); exit;
}
}





?>

<?php
require_once "../includes/db.php"; 

if (isset($_POST["modifier-service"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données du formulaire
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        
        // Préparation de la requête de mise à jour
        $stmt = $pdo->prepare("UPDATE services SET name = ?, description = ? WHERE id = ?");
        
        // Exécution de la requête avec les valeurs
        $stmt->execute([$name, $description, $id]);

        echo "Service modifié avec succès.";
        
    }
}
?>

 
<?php
require_once "../includes/db.php"; 
$stmt = $pdo->query("SELECT * FROM services");
$services = $stmt->fetchAll();

?>
<?php
if(isset($_POST['supprimer-service'])){

    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = ?");
    $stmt->execute([$id]);

    echo "service supprimé avec succes";
    // Redirection 
    header("Location: admin_vehicles.php"); exit;
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
    <link rel="stylesheet" href="../style/style.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
    font-family: 'Open Sans', sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h1 {
    text-align: center;
    color: #333;
}

.service, form {
    background-color: #ffffff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

input[type=text], input[type=submit] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    background-color: #5cb85c;
    color: white;
    border: none;
    cursor: pointer;
}

input[type=submit]:hover {
    opacity: 0.8;
}

label {
    font-weight: bold;
}

@media (max-width: 768px) {
    .service, form {
        padding: 10px;
    }
}

    </style>
</head>
<body>
<?php include("../assets/admin-header.php");?>

<h1>Services</h1>
    <?php foreach ($services as $service): ?>
        <form action="" method="post">
        <div class="service">
            <input type="hidden" value="<?php echo htmlspecialchars($service['id']); ?>" name="id">
            <input type="text" name="name" value="<?php echo htmlspecialchars($service['name']); ?>">
            <input type="text" name="description" value="<?php echo htmlspecialchars($service['description']); ?>">
            <input type="submit" name="modifier-service">
            
        </div>
        
        
        </form>
        <form action="" method="post" style="margin-bottom: 50px;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($service['id']); ?>">
           <input type="submit" name="supprimer-service" value="supprimer" style="background-color: red;"> 
        </form>
    <?php endforeach; ?>
    
    <form action="" method="post">
        <legend>ajouter un service</legend>
        <label for="name">Nom du service</label>
        <input type="text" name="name">
        <label for="description">Description des services</label>
        <input type="text" name="description">
        <input type="submit" name="ajouter-service" >
    </form>
</body>
</html>