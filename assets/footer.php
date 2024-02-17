<?php 


//horaires d'ouvertures

$stmt = $pdo->query("SELECT day, open_time, close_time FROM opening_hours ORDER BY FIELD(day, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche')");
$hours = $stmt->fetchAll();

//Recuperation commentaires
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $commentaire = $_POST['commentaire'];
    $stmt = $pdo->prepare("INSERT INTO commentaires (nom, prenom, commentaire) VALUES (?, ?, ?)");
    if ($stmt->execute([$nom, $prenom, $commentaire])) {
        echo "Commentaire envoyé";
        
    } else {
        echo "Erreur";
    }
}
?>
<footer>
    <div class="footer">
        <div class="footer-horraires col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h3 class="text-uppercase fw-bold mb-4">Horaires d’ouverture </h3>
            <?php foreach ($hours as $hour) {
            echo '<p class="horraire">' .htmlspecialchars($hour['day']) . ": " . date('H:i', strtotime($hour['open_time'])) . " - " . date('H:i', strtotime($hour['close_time'])) . '</p>' ;
            }
?>
         
        </div>
        <div class="footer-avis col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h3 class="text-uppercase fw-bold mb-4">laisser un avis</h3>
            <form style="display:flex; flex-direction:column;" method="post">
                <label for="">nom</label>
                <input type="text" name="nom">
                <label for="">prenom</label>
                <input type="text" name="prenom">
                <label for="">votre avis</label>
                <textarea name="commentaire" id=""></textarea>
                <input type="submit">
            </form>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> 8 avenue des Champs</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            contact@garage_v_parrot.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 0X XX XX XX XX</p>
          <p><i class="fas fa-print me-3"></i> + 0X XX XX XX XX</p>
        </div>
    </div>
    
</footer>