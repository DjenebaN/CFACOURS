<?php
$profId = $_GET['ID_Professeur'];
?>

<form class="form" method="POST" action="controller/profController.php">
  <div class="title">Modifiez vos informations</div>
  <input class="input" name="nom" placeholder="Nom" type="text" required>
  <input class="input" name="prenom" placeholder="Prenom" type="text" required>
  <input class="input" name="email" placeholder="Email" type="email" required>
  <input class="input" name="mdp" placeholder="Mot De Passe" type="password" requires>
  <input type="hidden" name="prof" value="update">
  <input type="hidden" name="ID_Professeur" value="<?php echo htmlspecialchars($profId); ?>">
  <button type="submit" class="detail">Sauvegarder</button>
</form>

<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php');

?>
