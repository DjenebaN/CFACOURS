<?php
// Inclure le modèle et initialiser la connexion à la base de données
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$ID_Professeur = $_SESSION['ID_Professeur'];

$cours = new Cours($bdd);
$niveaux = $cours->getNiveaux(); // Récupérer les niveaux
?>

<form method="POST" action="controller/coursController.php">
  <div>Publier<br><span>Vous vous engagez à honorer vos cours</span></div>
  <input name="matiere" placeholder="Matière" type="text" required>
  <input name="salle" placeholder="Salle" type="text" required>
  <input name="date" placeholder="Date" type="date" required>
  <input name="heure" placeholder="Heure" type="time" required>

  <!-- Liste déroulante pour les niveaux -->
  <select name="niveau" required>
    <option value="" disabled selected>Choisissez un niveau</option>
    <?php foreach ($niveaux as $niveau) : ?>
      <option value="<?php echo htmlspecialchars($niveau['ID_Niveau']); ?>">
        <?php echo htmlspecialchars($niveau['Niveau']); ?>
      </option>
    <?php endforeach; ?>
  </select>
  <input name="infos" placeholder="Infos" type="text" required>

  <!-- ID du professeur (champ caché) -->
  <input type="hidden" name="ID_Professeur" value="<?php echo $ID_Professeur; ?>">
  <input type="hidden" name="cours" value="ajouter">

  <!-- Bouton de soumission -->
  <button type="submit" class="detail">Poster</button>
</form>


<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php');
?>
