<?php
require_once "../includes/db.php"; // Ajustez le chemin d'accès selon votre structure

$stmt = $pdo->query("SELECT name, description FROM services");
$services = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/header.css">
    <link rel="stylesheet" href="../style/footer.css">
    <!-- <link rel="stylesheet" href="../style/services-style.css"> -->
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Condensed' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    font-size: 2.5rem; /* 40px */
    text-shadow: 2px 2px 4px #000;
}

body {
    font-family: 'Open Sans';
    background-color: #f8f9fa;
    color: #212529;
}

.services-section {
    
    padding: 60px 0;
}

.service-card {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: transform .3s, box-shadow .3s;
    height: 300px;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(0,0,0,.1);
}

.service-title {
    color: #0056b3;
    margin-bottom: 15px;
}

.container {
    max-width: 1140px;
    margin: auto;
}

.text-center {
    text-align: center;
}

.mb-4 {
    margin-bottom: 1.5rem;
}

.py-5 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col-md-4 {
    width: 33.33333%;
    padding-right: 15px;
    padding-left: 15px;
    margin-bottom: 30px;
}

.shadow-sm {
    box-shadow: 0 1px 2px rgba(0,0,0,.05);
}

.p-3 {
    padding: 1rem;
}

    </style>
    
</head>
<?php include("../assets/header.php");?>
<body>
<section class="section-header">
        <h1>Découvrez Nos Services</h1>
    </section>
    
    <section class="section-heade py-5">
        
    <section class="services-section ">
    <div class="container">
        
        <div class="row">
            <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="service-card p-3 shadow-sm">
                    <h3 class="service-title"><?php echo htmlspecialchars($service['name']); ?></h3>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    </section>
    <div class="white-space">
        
    </div>


    <?php include("../assets/footer.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>
