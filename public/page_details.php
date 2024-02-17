

<?php 
require_once "../includes/db.php";
$iddd = $_GET['id'];

$stmt = $pdo->query("SELECT id, make, model, year, mileage, price, description, image FROM vehicles WHERE id = $iddd");
$vehicles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules d'occasion</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/details-style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("../assets/header.php");?>
<?php foreach ($vehicles as $vehicle): ?>
    <div class="product-detail-container">
        
        
        <div class="product-detail">
            <div class="product-image">
                <img src="<?php echo '../' . htmlspecialchars($vehicle['image']); ?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h1><?php echo htmlspecialchars($vehicle['make']);?></h1>
                <p class="price"><?php echo htmlspecialchars($vehicle['price']);?></p>
                <p class="description"><?php echo htmlspecialchars($vehicle['description']);?></p>
                <button type="button" class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php include("../assets/footer.php");?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
