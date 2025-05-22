<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

// Récupérer tous les niveaux disponibles
$cours = new Cours($bdd);
$niveaux = $cours->getNiveaux(); // Récupérer les niveaux
?>

<div class="accueilTT">
<form class="formlogInsc" method="POST" action="controller/eleveController.php">
<div class="titlelogInsc">Bienvenue !<br><span>Inscrivez-vous pour continuer</span></div>
  <input class="inputlogInsc" name="nom" placeholder="Nom" type="text" required>
  <input class="inputlogInsc" name="prenom" placeholder="Prenom" type="text" required>
  <input class="inputlogInsc" name="email" placeholder="Email" type="email" required>
  <input class="inputlogInsc" name="mdp" placeholder="Mot De Passe" type="password" requires>
  <!-- Liste déroulante pour le niveau -->
  <select class="inputlogInscNiv" name="niveau" required>
    <option value="" disabled selected>Choisissez un niveau</option>
    <?php foreach ($niveaux as $niveau) : ?>
      <option value="<?php echo htmlspecialchars($niveau['ID_Niveau']); ?>">
        <?php echo htmlspecialchars($niveau['Niveau']); ?>
      </option>
    <?php endforeach; ?>
  </select>
  <input type="hidden" name="eleve" value="ajouter">
  <button type="submit" class="button-confirmlogInsc">Inscription</button>
</form>
</div>
<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php');

?>

<style>.accueilTT {
    display: flex;
    justify-content: center;
}

.formlogInsc {
  margin-top: 50px;
  height: 400px;
  width: 300px;
  --input-focus: #2d8cf0;
  --font-color: #323232;
  --font-color-sub: #666;
  --bg-color: #fff;
  --main-color: #323232;
  padding: 20px;
  background: lightgrey;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  justify-content: center;
  gap: 20px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  box-shadow: 4px 4px var(--main-color);
}

.titlelogInsc {
  color: var(--font-color);
  font-weight: 900;
  font-size: 20px;
  margin-bottom: 25px;
}

.titlelogInsc a {
text-decoration: none;
color: var(--font-color);
font-weight: 900;
font-size: 15px;
margin-bottom: 10px;
}

.titlelogInsc a:hover {
color: blue;
}


.titlelogInsc span {
  color: var(--font-color-sub);
  font-weight: 600;
  font-size: 17px;
}

.inputlogInsc {
  width: 250px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 15px;
  font-weight: 600;
  color: var(--font-color);
  padding: 5px 10px;
  outline: none;
}

.inputlogInsc::placeholder {
  color: var(--font-color-sub);
  opacity: 0.8;
}

.inputlogInsc:focus {
  border: 2px solid var(--input-focus);
}

.button-confirmlogInsc:active {
  box-shadow: 0px 0px var(--main-color);
  transform: translate(3px, 3px);
}

.button-confirmlogInsc {
  margin: 50px auto 0 auto;
  width: 120px;
  height: 40px;
  border-radius: 5px;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  box-shadow: 4px 4px var(--main-color);
  font-size: 17px;
  font-weight: 600;
  color: var(--font-color);
  cursor: pointer;
}


</style>