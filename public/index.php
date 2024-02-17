<?php

require_once '../includes/db.php';

//horaires d'ouvertures

$stmt = $pdo->query("SELECT day, open_time, close_time FROM opening_hours ORDER BY FIELD(day, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')");
$hours = $stmt->fetchAll();

//commentaires validés
$stmt = $pdo->query("SELECT id, nom, prenom, commentaire FROM commentaires_affiches LIMIT 3");
$commentaires = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <!-- <link rel="stylesheet" href="../style/index-style.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>















    body {
            font-family: 'Open Sans', sans-serif;
            overflow-x: hidden;
            background-color: #FAF9F6;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #003366;
            font-family: 'Roboto Condensed', sans-serif;
            font-weight: bold;
        }

        p {
            font-size: 1rem;
            line-height: 1.5;
        }

        .section-header {
                background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url("../images/image-header-home.png") no-repeat center center;

           
            height: 400px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        

        .header-card {
            position: relative;
            bottom: -60px;
            background-color: #E1F4FF;
            padding: 20px;
            margin-right: 150px;
            width: 340px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
            border-radius: 10px;
        }

        .arguments {
            margin: 80px auto;
            max-width: 960px;
        }

        .argument {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .argument img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .argument div {
            margin-left: 50px;
        }

        .argument:nth-child(even) div {
            margin-left: 0;
            margin-right: 50px;
            text-align: right;
        }

        .argument:nth-child(even) img {
            order: 2;
        }

        .section-direc {
            background-color: #5A729E;
            padding: 80px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .section-direc div {
            background-color: #F2F2F2;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .reviews {
            padding: 50px 0;
            background-color: #fff;
            text-align: center;
        }

        .review {
            margin-top: 30px;
        }

        .review svg {
            color: #337db9;
        }

        button {
            background-image: linear-gradient(to right, #D50000, #B20000);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 15px;
            cursor: pointer;
        }

        button:hover {
            background-image: linear-gradient(to right, #910000, #910000);
        }

        @media (max-width: 768px) {
            .argument {
                flex-direction: column;
                text-align: center;
            }

            .argument div, .argument img {
                margin: 0 auto;
                margin-bottom: 20px;
            }

            .argument:nth-child(even) div {
                margin-right: auto;
            }

            .section-direc {
                padding: 40px 20px;
            }

            .header-card {
                margin: 20px auto;
                width: auto;
            }
        }
</style>
</head>
<body style="background-color: #FAF9F6;">
    <?php include("../assets/header.php");?>
    <main> 
    <section class="section-header">
        <div class="header-card">
            <h3>Horaires d’ouverture </h3>
            <?php foreach ($hours as $hour) {
    echo '<p class="horraire">' .htmlspecialchars($hour['day']) . ": " . date('H:i', strtotime($hour['open_time'])) . " - " . date('H:i', strtotime($hour['close_time'])) . '</p>' ;
}
?>
         
        </div>
    </section>
    <section class="arguments">
        <div class="argument argument1">
            <img src="../images/moteur-home.png" alt="">
            <div>
            <h3>Expertise professionnelle</h3>
            <p>Les mécaniciens de garage sont des professionnels formés et expérimentés capables de diagnostiquer avec précision et de réparer les problèmes techniques de votre véhicule, garantissant ainsi que votre voiture fonctionne de manière optimale.</p>
            </div>
        </div>
        <div class="argument argument2">
            <div>
            <h3>Inspection rigoureuse des vehicules</h3>
            <p>Les voitures d'occasion vendues par des garages réputés sont généralement soumises à une inspection approfondie et à des révisions mécaniques avant la vente, garantissant que le véhicule est en bon état de fonctionnement et sans problèmes majeurs cachés.</p>
            </div>
            <img src="../images/tire-home.png" alt="">
        </div>
    </section>
    <section class="section-direc">
        <div>
            <h2>Nos services</h2>
            <p>Contactez-nous facilement via notre formulaire en ligne pour un service rapide et personnalisé.</p>
            <button>Aller voir</button>
        </div>
        <div>
            <h2>Nos véhicules d'occasion</h2>
            <p>Sélection variée de voitures d'occasion inspectées, fiables et à des prix compétitifs pour tous les budgets.</p>
            <button>Aller voir</button>
        </div>
        <div>
            <h2>Prendre rendez vous</h2>
            <p>Contactez-nous facilement via notre formulaire en ligne pour un service rapide et personnalisé.</p>
            <button>Aller voir</button>
        </div>
    </section>

    <section class="reviews">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4">Ils nous ont fait confiance !</h3>
            </div>
        </div>
        <div class="row text-center">
        <?php foreach ($commentaires as $commentaire): ?>
            <div class="col-md-4 mb-5 mb-md-0 review">  
                <h5 class="mb-3"><?php echo htmlspecialchars($commentaire['prenom']) . " " . htmlspecialchars($commentaire['nom']); ?></h5>
                <p class="px-xl-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z"/>
                </svg>
                <?php echo htmlspecialchars($commentaire['commentaire']); ?>
                </p>
            </div>
            <?php endforeach;?>
        </div>
    </section>
</main>
    <?php include("../assets/footer.php");?>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>