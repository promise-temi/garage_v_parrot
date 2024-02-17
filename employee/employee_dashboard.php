<?php
require_once '../includes/db.php'; 

session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: ../public/login.php');
    exit;
}











?>




<?php 



// Récupération des commentaires
$stmt = $pdo->query("SELECT id, nom, prenom, commentaire FROM commentaires");
$commentaires = $stmt->fetchAll();

// Suppression d'un commentaire
if(isset($_POST['supprimer'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM commentaires WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: employee_dashboard.php"); 
    exit;
}

if(isset($_POST['supprimer-review'])) {
  $id = $_POST['id'];
  $stmt = $pdo->prepare("DELETE FROM commentaires_affiches WHERE id = ?");
  $stmt->execute([$id]);
  header("Location: employee_dashboard.php"); 
  exit;
}

// Ajouter un commentaire au site
if (isset($_POST["ajouter-au-site"])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $commentaire = $_POST['commentaire'];
    
    $stmt = $pdo->prepare("INSERT INTO commentaires_affiches(nom, prenom, commentaire) VALUES(?,?,?)");
    $stmt->execute([$nom, $prenom, $commentaire]);
    header("Location: employee_dashboard.php"); 
    exit;
}

// Récupération des reviews
$stmt = $pdo->query("SELECT id, nom, prenom, commentaire FROM commentaires_affiches");
$reviews = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    
.container {
    max-width: 800px; 
}

.card {
    margin-bottom: 1rem;
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); 
}

.card-body {
    position: relative;
}

.btn {
    margin-top: 0.5rem;
}

.btn-danger {
    margin-right: 0.5rem;
}


.btn-primary, .btn-danger {
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.05);
}


.card-actions {
    text-align: right;
}

@media (max-width: 768px) {
    .btn {
        width: 100%; 
        margin-bottom: 0.5rem;
    }
}

  </style>
  </head>
  <body>
    <h1>interface employé</h1>
    <form action="deconnexion.php" method="post">
    <input type="submit" value="se deconecter">
</form>

<div class="container">
<div class="container mt-4">
    <h2>Commentaires</h2>
    <?php foreach ($commentaires as $commentaire): ?>
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($commentaire['nom']) . " " . htmlspecialchars($commentaire['prenom']); ?></h5>
        <p class="card-text"><?php echo htmlspecialchars($commentaire['commentaire']); ?></p>
        <form action="" method="post">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($commentaire['id']); ?>">
          <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
        </form>
        <form action="" method="post" class="mt-2">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($commentaire['id']); ?>">
          <input type="hidden" name="nom" value="<?php echo htmlspecialchars($commentaire['nom']); ?>">
          <input type="hidden" name="prenom" value="<?php echo htmlspecialchars($commentaire['prenom']); ?>">
          <input type="hidden" name="commentaire" value="<?php echo htmlspecialchars($commentaire['commentaire']); ?>">
          <button type="submit" name="ajouter-au-site" class="btn btn-primary">Ajouter au site</button>
        </form>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="container mt-4">
    <h2>Reviews affichées</h2>
    <?php foreach ($reviews as $commentaire): ?>
    <div class="card mb-2">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($commentaire['nom']) . " " . htmlspecialchars($commentaire['prenom']); ?></h5>
        <p class="card-text"><?php echo htmlspecialchars($commentaire['commentaire']); ?></p>
        <form action="" method="post">
          <input type="hidden" name="id" value="<?php echo htmlspecialchars($commentaire['id']); ?>">
          <button type="submit" name="supprimer-review" class="btn btn-danger">Supprimer</button>
        </form>
        
      </div>
    </div>
    <?php endforeach; ?>
  </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>