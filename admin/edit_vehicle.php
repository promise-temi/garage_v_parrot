<?php
require_once "../includes/db.php";

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

$message = "";

if (isset($_GET['id']) || isset($_POST['id'])) {
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];

    $stmt = $pdo->prepare("SELECT * FROM vehicles WHERE id = ?");
    $stmt->execute([$id]);
    $vehicle = $stmt->fetch();

    if (!$vehicle) {
        die("Véhicule non trouvé.");
    }

    
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $mileage = $_POST['mileage'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $imagePath = $vehicle['image']; // Utiliser image existante par défaut

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Initialisation du chemin de l'image avec l'image existante
$imagePath = $vehicle['image'];

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Chemin du dossier où les images seront stockées
    $uploadDir = "../uploads/";
    
    // Récupération des informations sur le fichier téléchargé
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileType = $_FILES['image']['type'];

    // Définition des types de fichiers autorisés
    $allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];

    // Vérification du type de fichier
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!array_key_exists($fileExt, $allowedTypes) || !in_array($fileType, $allowedTypes)) {
        die("Erreur : Format de fichier non valide.");
    }

    // Vérification de la taille du fichier (ex. moins de 5MB)
    $maxSize = 5 * 1024 * 1024; // 5MB
    if ($fileSize > $maxSize) {
        die("Erreur : Le fichier est trop volumineux.");
    }

    // Création d'un nom de fichier unique pour éviter les conflits
    $newFileName = uniqid('IMG-', true) . '.' . $fileExt;
    $destination = $uploadDir . $newFileName;

    // Déplacement du fichier vers le dossier de destination
    if (!move_uploaded_file($fileTmpName, $destination)) {
        die("Erreur lors du téléchargement du fichier.");
    }

    // Mise à jour du chemin de l'image avec le nouveau fichier
    $imagePath = 'uploads/' . $newFileName;
}

        }

        // Initialisation de la requête SQL de base
        
        $sql = "UPDATE vehicles SET make = ?, model = ?, year = ?, mileage = ?, price = ?, description = ?";
        $params = [$make, $model, $year, $mileage, $price, $description];

        // Ajouter l'image à la requête SQL si un nouveau fichier a été téléchargé
        if ($imagePath !== $vehicle['image']) {
            $sql .= ", image = ?";
            $params[] = $imagePath;
        }

        // Finn de la requête SQL
        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $message = "Véhicule mis à jour avec succès.";
    }
} else {
    die("ID non spécifié.");
}
?>



<!DOCTYPE html>
<html>
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
    margin: 0;
    padding: 20px;
    background-color: #eaeaea;
}

h1 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

div {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type=text], input[type=number], textarea, input[type=file] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

textarea {
    height: 100px;
    resize: vertical;
}

button {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
    border-radius: 4px;
}

@media (max-width: 768px) {
    body {
        padding: 10px;
    }

    form {
        padding: 10px;
    }
}

    </style>
</head>
<body>
<?php include("../assets/admin-header.php");?>
    <h1>Modifier un véhicule</h1>
    <?php if ($message): ?>
    <p><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form action="edit_vehicle.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $vehicle['id']; ?>">
        <div>
            <label for="make">Marque :</label>
            <input type="text" id="make" name="make" value="<?php echo htmlspecialchars($vehicle['make']); ?>" required>
        </div>
        <div>
            <label for="model">Modèle :</label>
            <input type="text" id="model" name="model" value="<?php echo htmlspecialchars($vehicle['model']); ?>" required>
        </div>
        <div>
            <label for="year">Année :</label>
            <input type="number" id="year" name="year" value="<?php echo htmlspecialchars($vehicle['year']); ?>" required>
        </div>
        <div>
            <label for="mileage">Kilométrage :</label>
            <input type="number" id="mileage" name="mileage" value="<?php echo htmlspecialchars($vehicle['mileage']); ?>" required>
        </div>
        <div>
            <label for="price">Prix :</label>
            <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($vehicle['price']); ?>" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($vehicle['description']); ?></textarea>
        </div>
        <div>
    <label>Image actuelle :</label>
    <?php if (!empty($vehicle['image'])): ?>
        <img src="../<?php echo htmlspecialchars($vehicle['image']); ?>" alt="Image du véhicule" style="max-width: 200px; height: auto;">
    <?php endif; ?>
    
</div>
        <div>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">Mettre à jour le véhicule</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</body>
</html>

