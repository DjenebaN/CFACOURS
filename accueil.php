
<div class="accueilTT">
<div class="accueil">
    <?php
    if (isset($_SESSION['ID_Eleve'])) {
        echo' <div class="accueiltitle">Bonjour,<br><span><p>Bienvenue sur votre espace elève</p></span></div>';
    }elseif (isset($_SESSION['ID_Professeur'])) {
        echo' <div class="accueiltitle">Bonjour,<br><span><p>Bienvenue sur votre espace professeur</p></span></div>';
    }else {
        echo' <div class="accueiltitle">Bonjour,<br><span><p>et bienvenue</p></span></div>';
    };
    ?>
    
  </div>
</div>


<style>

.accueilTT {
    display: flex;
    justify-content: center;
}
.accueil {
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

.accueiltitle p {
  color: #696969;
  font-weight: 900;
  font-size: 20px;
  margin-bottom: 25px;
}

.accueiltitle {
  color: var(--font-color);
  font-weight: 900;
  font-size: 20px;
  margin-bottom: 25px;
}
</style>


<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php';
?>