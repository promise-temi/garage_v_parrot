<?php
require_once "../includes/db.php"; // Ajustez le chemin si nécessaire

$stmt = $pdo->query("SELECT id, make, model, year, mileage, price, description, image FROM vehicles");
$vehicles = $stmt->fetchAll();
?>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $commentaire = $_POST['commentaire'];
    $stmt = $pdo->prepare("INSERT INTO commentaires (nom, prenom, commentaire) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $commentaire])) {
        echo "Commentaire envoyé";
        header("Location: vehicles.php"); exit;
    } else {
        echo "Erreur";
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules d'occasion</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <link rel="stylesheet" href="../style/vehicles-style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("../assets/header.php"); ?>

    <section class="section-header">
        <h1>Nos Véhicules d'occasion</h1>
    </section>

    <!-- Form for filters -->
    <form id="filterForm" class="text-center my-4">
        <div>
            <label for="filterType">Choisir un filtre :</label>
            <select id="filterType" onchange="toggleFilters()">
                <option value="">Pas de filtre</option>
                <option value="price">Prix</option>
                <option value="mileage">Kilométrage</option>
                <option value="year">Année</option>
            </select>
        </div>
        <div id="priceOptions" class="filterOptions" style="display:none;">
            <select id="priceSort">
                <option value="price_asc">Moins cher au plus cher</option>
                <option value="price_desc">Plus cher au moins cher</option>
            </select>
        </div>
        <div id="mileageOptions" class="filterOptions" style="display:none;">
            <select id="mileageSort">
                <option value="mileage_asc">Le moins kilométré au plus kilométré</option>
                <option value="mileage_desc">Le plus kilométré au moins kilométré</option>
            </select>
        </div>
        <div id="yearOptions" class="filterOptions" style="display:none;">
            <select id="yearSort">
                <option value="year_asc">Le plus ancien au plus récent</option>
                <option value="year_desc">Le plus récent au plus ancien</option>
            </select>
        </div>
        <button type="button" onclick="filterVehicles()">Filtrer</button>
    </form>

    <section class="vehicules">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <div class="col-md-4 d-flex align-items-stretch">
                            <a href="page_details.php?id=<?= htmlspecialchars($vehicle['id']) ?>" class="card mb-4 box-shadow w-100">
                                <img class="card-img-top" src="<?= '../' . htmlspecialchars($vehicle['image']); ?>" alt="Image du véhicule">
                                <div class="card-body">
                                    <h2><?= htmlspecialchars($vehicle['make']); ?></h2>
                                    <p>Modèle : <?= htmlspecialchars($vehicle['model']); ?></p>
                                    <p>Année : <?= htmlspecialchars($vehicle['year']); ?></p>
                                    <p>Kilométrage : <?= htmlspecialchars($vehicle['mileage']); ?> km</p>
                                    <p>Prix : <?= htmlspecialchars($vehicle['price']); ?> €</p>
                                    <p>Description : <?= htmlspecialchars($vehicle['description']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
















    <script>
        function toggleFilters() {
    var filterType = document.getElementById('filterType').value;
    var filterOptions = document.getElementsByClassName('filterOptions');

    for (var i = 0; i < filterOptions.length; i++) {
        filterOptions[i].style.display = 'none';
    }

    if (filterType) {
        document.getElementById(filterType + 'Options').style.display = 'block';
    }
}
function filterVehicles() {
    var filterType = document.getElementById('filterType').value;
    var sortValue = document.getElementById(filterType + 'Sort') ? document.getElementById(filterType + 'Sort').value : '';

    fetch('../includes/filter_vehicles.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `filterType=${filterType}&sortValue=${sortValue}`
    })
    .then(response => response.json())
    .then(data => {
        var container = document.querySelector('.container.vehicules .row');
        container.innerHTML = ''; // Clear previous results
        
        data.forEach(vehicle => {
            const vehicleCard = document.createElement('div');
            vehicleCard.className = 'col-md-4';
            vehicleCard.innerHTML = `
                <a href="page_details.php?id=${vehicle.id}">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../${vehicle.image}" alt="Image du véhicule" style="height:400px; object-fit:cover;">
                        <div class="card-body">
                            <h2>${vehicle.make} ${vehicle.model} (${vehicle.year})</h2>
                            <p>Model : ${vehicle.model} km</p>
                            <p>Année : ${vehicle.year} km</p>
                            <p>Kilométrage : ${vehicle.mileage} km</p>
                            <p>Prix : ${vehicle.price} €</p>
                            <p>Description : ${vehicle.description}</p>
                        </div>
                    </div>
                </a>
            `;
            container.appendChild(vehicleCard);
        });
    })
    .catch(error => {
        console.error('Erreur:', error);
    });
}






    </script>
        <?php include("../assets/footer.php");?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>










<!-- 


require_once "../includes/db.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $role = 'admin';

    
    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    if ($stmt->execute([$email, $password, $role])) {
        echo "admin ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'admin.";
    }
} 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un Employé</title>
</head>
<body>
    <h2>Ajouter un nouvel employé</h2>
    <form action="vehicles.php" method="post">
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <button type="submit">Ajouter l'employé</button>
        </div>
    </form>
</body>
</html> -->

