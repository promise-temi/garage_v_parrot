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
  
    $day = $_POST['day'];
    $open_time = $_POST['open_time'];
    $close_time = $_POST['close_time'];

   
    $stmt = $pdo->prepare("UPDATE opening_hours SET open_time = ?, close_time = ? WHERE day = ?");
    if ($stmt->execute([$open_time, $close_time, $day])) {
        echo "Horaire mis à jour avec succès.";
        
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    background-color: #f0f0f0;
    padding: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

label {
    font-weight: bold;
    display: block;
    margin-top: 10px;
}

input[type="time"] {
    width: 100%;
    padding: 8px;
    margin: 5px 0 20px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    form {
        margin-bottom: 10px;
    }
}

    </style>
</head>
<body>
<?php include("../assets/admin-header.php");?>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="lundi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="mardi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="mercredi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="jeudi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="vendredi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="samedi">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
<form action="update_hours.php" method="post">
    <input type="hidden" name="day" value="dimanche">
    <label for="open_time">Heure d'ouverture:</label>
    <input type="time" id="open_time" name="open_time" required>
    <label for="close_time">Heure de fermeture:</label>
    <input type="time" id="close_time" name="close_time" required>
    <button type="submit">Mettre à jour</button>
</form>
  
</body>
</html>



