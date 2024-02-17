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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Véhicules d'occasion</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <!-- <link rel="stylesheet" href="../style/vehicles-style.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

        
body, h1, h2, h3, p {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
h1, h2, h3, h4, h5, h6 {
            color: #003366;
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: bold;
        }

body {
    font-family: 'Open Sans', sans-serif;
    background-color: #f8f9fa; 
    color: #333; 
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


.vehicules .card {
    border: none;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Ombre discrète pour la profondeur */
    transition: transform 0.2s; /* Transition fluide au survol */
}

.vehicules .card:hover {
    transform: translateY(-5px); /* Effet de léger soulèvement au survol */
}

.vehicules .card-img-top {
    width: 100%;
    height: 225px; /* Ajustez selon vos besoins */
    object-fit: cover; /* Garantit que les images couvrent bien l'espace dédié */
}

.vehicules .card-body {
    padding: 15px; /* Espace interne dans la carte */
    text-align: center; /* Centre le texte */
}

.vehicules .card-text p {
    margin-bottom: 10px;
    color: #555; /* Texte légèrement plus clair */
}

/* Boutons et Inputs */
button, input[type="submit"] {
    background-color: #007bff; /* Couleur primaire de Bootstrap */
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s;
}

button:hover, input[type="submit"]:hover {
    background-color: #0056b3; /* Assombrissement du bouton au survol */
}

/* Ajustements responsifs */
@media (max-width: 768px) {
    .section-header h1 {
        font-size: 1.75rem; /* Texte plus petit sur les petits écrans */
    }
    .vehicules .card-img-top {
        height: 200px; /* Hauteur d'image ajustée pour les petits écrans */
    }
}

    </style>
</head>
<body>
<?php include("../assets/header.php");?>
    
    <section class="section-header">
        <h1>Nos Véhicules d'occasion</h1>
    </section>

    <main>
    <form id="filterForm">
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
        
        <div class="container vehicules">

          <div class="row" style="display: flex; flex-wrap:wrap;">
            <?php foreach ($vehicles as $vehicle): ?>
                <a class="col-md-4" href="page_details.php?id=<?=$idd = htmlspecialchars($vehicle['id']) ?>">
            
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo '../' . htmlspecialchars($vehicle['image']); ?>" alt="Image du véhicule" style="height:400px; object-fit:cover;">
                <div class="card-body">
                  <div class="card-text">
                    
                  
                <h2><?php echo htmlspecialchars($vehicle['make'])  ; ?></h2>
                <p>Model : <?php echo htmlspecialchars($vehicle['model']); ?> km</p>
                <p>Année : <?php echo htmlspecialchars($vehicle['year']); ?> km</p>
                <p>Kilométrage : <?php echo htmlspecialchars($vehicle['mileage']); ?> km</p>
                <p>Prix : <?php echo htmlspecialchars($vehicle['price']); ?> €</p>
                
            
            </div>
                  
                </div>
              </div>
              
            </a>
    <?php endforeach; ?>
          
        </div>
        
      </div>
    </div>
</section>

</main>














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
    var form = document.getElementById('filterForm');
    var filterType = document.getElementById('filterType').value;
    var dataToSend = `filterType=${filterType}`;

    if (filterType) {
        var sortValue = document.getElementById(filterType + 'Sort').value;
        dataToSend += `&${filterType}Sort=${sortValue}`;
    }

    fetch('../includes/filter_vehicles.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: dataToSend
    })
    .then(response => response.json())
    .then(data => {
        var container = document.querySelector('.row');
        container.innerHTML = ''; // Clear previous results
        data.forEach(vehicle => {
            let vehicleDiv = document.createElement('div');
            vehicleDiv.className = 'col-md-4';
            vehicleDiv.innerHTML = `
                <a class="" href="page_details.php?id=${vehicle.id}">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="../${vehicle.image}" alt="Image du véhicule" style="height:400px; object-fit:cover;">
                        <div class="card-body">
                            <div class="card-text">
                                <h2>${vehicle.make}</h2>
                                <p>Model : ${vehicle.model}</p>
                                <p>Année : ${vehicle.year}</p>
                                <p>Kilométrage : ${vehicle.mileage} km</p>
                                <p>Prix : ${vehicle.price} €</p>
                                <p>Description : ${vehicle.description}</p>
                            </div>
                        </div>
                    </div>
                </a>
            `;
            container.appendChild(vehicleDiv);
        });
    })
    .catch(error => console.error('Error:', error));
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

