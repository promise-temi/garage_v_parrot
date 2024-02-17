<?php
require_once "../includes/db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Initialisation du chemin de l'image
    $imagePath = '';

    // Vérification si le fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "../uploads/";
        $allowed = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileType = $_FILES['image']['type'];
        $fileSize = $_FILES['image']['size'];

        // Vérification de l'extension et du type de fichier
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!array_key_exists($fileExt, $allowed) || !in_array($fileType, $allowed)) {
            die("Erreur : Format de fichier non valide.");
        }

        // Vérification de la taille du fichier (par ex. < 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($fileSize > $maxSize) {
            die("Erreur : Le fichier est trop volumineux.");
        }

        // Création d'un nom de fichier unique pour éviter les conflits
    $newFileName = uniqid('IMG-', true) . '.' . $fileExt;
    $destination = $uploadDir . $newFileName;

        

        // Déplacement du fichier dans le dossier de destination
        if (!move_uploaded_file($fileTmpName, $destination)) {
            die("Erreur : Le fichier n'a pas pu être téléchargé.");
        }
        $imagePath = 'uploads/' . $newFileName;
    }

    // Insertion dans la base de données (avec le chemin de l'image)
    $stmt = $pdo->prepare("INSERT INTO vehicles (make, model, year, mileage, price, description, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$make, $model, $year, $mileage, $price, $description, $imagePath]);

    echo "Véhicule ajouté avec succès.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un véhicule</title>

</head>
<body>
<?php include("../assets/admin-header.php");?>
    <h1>Ajouter un véhicule</h1>
    <form action="add_vehicle.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="make">Marque :</label>
            <input type="text" id="make" name="make" required>
        </div>
        <div>
            <label for="model">Modèle :</label>
            <input type="text" id="model" name="model" required>
        </div>
        <div>
            <label for="year">Année :</label>
            <input type="number" id="year" name="year" required>
        </div>
        <div>
            <label for="mileage">Kilométrage :</label>
            <input type="number" id="mileage" name="mileage" required>
        </div>
        <div>
            <label for="price">Prix :</label>
            <input type="text" id="price" name="price" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="image">Image :</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit">Ajouter le véhicule</button>
    </form>
</body>
</html>
