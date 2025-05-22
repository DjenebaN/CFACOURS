<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$cours = new Cours($bdd);
$allCours = $cours->allCours(); // Récupère tous les cours

?>


<h1> Liste des cours</h1>
<div class ="tousCours">
<?php foreach ($allCours as $value) {
    echo "<div class = cours>";
    echo "<div class = textCours>";
    echo "<h3>" .$value['Matiere'] . "</h4><br>";
    echo "Professeur : " . htmlspecialchars($value['Nom_Prof']) . " " . htmlspecialchars($value['Prenom_Prof']) . "<br>";
    echo "Salle : " . htmlspecialchars($value['Salle']) . "<br>";
    echo "Date : " . htmlspecialchars($value['Date_Cours']) . "<br>";
    echo "Heure : " . htmlspecialchars($value['Heure']) . "<br>";
    echo "Niveau : " . htmlspecialchars($value['Niveau_Texte']) . "<br>";
    echo '<button class = detail><a href="index.php?page=detailCours&ID_Cours=' . htmlspecialchars($value['ID_Cours']) . '">Détails</a></button>';
    echo "</div>";
    echo "</div>";
    echo "<hr>";
}
?>
</div>

   <style>
        .cours {
            height: 250px;
            width: 300px;
            background-color: aliceblue;
            margin: 10px;
            border-radius: 15px;
        }

        .textCours {
            margin-left: 7px;
        }

        .tousCours{
            display: flex;
            flex-direction: row;
        }
   </style>


<?php

include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php');

?>