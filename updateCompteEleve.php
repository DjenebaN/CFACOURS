<?php
$eleveId = $_GET['ID_Eleve'];

// Inclure le modèle pour récupérer les informations de l'élève et les niveaux
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/eleveModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

// Créer un objet Eleve
$eleve = new Eleve($bdd);

// Récupérer l'élève par ID
$detailEleve = $eleve->getEleveById($eleveId);

// Récupérer tous les niveaux disponibles
$niveaux = $eleve->getAllNiveaux();
$cours = new Cours($bdd);
$niveaux = $cours->getNiveaux(); // Récupérer les niveaux
?>

<form class="form" method="POST" action="controller/eleveController.php">
  <div class="title">Modifiez vos informations</div>
  <input class="input" name="nom" placeholder="Nom" type="text" value="<?php echo htmlspecialchars($detailEleve['Nom']); ?>" required>
  <input class="input" name="prenom" placeholder="Prenom" type="text" value="<?php echo htmlspecialchars($detailEleve['Prenom']); ?>" required>
  <input class="input" name="email" placeholder="Email" type="email" value="<?php echo htmlspecialchars($detailEleve['Email']); ?>" required>
  <input class="input" name="mdp" placeholder="Mot De Passe" type="password" required>

  <!-- Liste déroulante pour le niveau -->
  <select name="niveau" required>
    <option value="" disabled selected>Choisissez un niveau</option>
    <?php foreach ($niveaux as $niveau) : ?>
      <option value="<?php echo htmlspecialchars($niveau['ID_Niveau']); ?>">
        <?php echo htmlspecialchars($niveau['Niveau']); ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input type="hidden" name="eleve" value="update">
  <input type="hidden" name="ID_Eleve" value="<?php echo htmlspecialchars($eleveId); ?>">
  <button type="submit" class="detail">Sauvegarder</button>
</form>

<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php');

?>