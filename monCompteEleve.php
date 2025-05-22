<h1>Compte Eleve</h1>

<?php

// Vérifier si l'ID_Eleve est dans l'URL
if (isset($_GET['ID_Eleve'])) {
    $ID_Eleve = $_GET['ID_Eleve'];
} else {
    echo "L'ID de l'élève est manquant dans l'URL.";
    exit;  // Arrêter l'exécution si l'ID n'est pas passé
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/eleveModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/inscModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$eleve = new Eleve($bdd);
$detailEleve = $eleve->getEleveById($ID_Eleve);  // Passer l'ID à la méthode

$insc = new Insc($bdd);
$inscInsc = $insc->getInscByIdEleve($ID_Eleve);  // Passer l'ID à la méthode

?>
<h1>Infos</h1>

<?php
echo "Nom : " . htmlspecialchars($detailEleve['Nom']) . "<br>";
echo "Prenom : " . htmlspecialchars($detailEleve['Prenom']) . "<br>";
echo "Email : " . htmlspecialchars($detailEleve['Email']) . "<br>";
echo "Mot de Passe : ••••••<br>";
echo "Niveau : " . htmlspecialchars($detailEleve['Niveau_Texte']) . "<br>";
echo '<a href="index.php?page=updateCompteEleve&ID_Eleve=' . $detailEleve['ID_Eleve'] . '"><button class = infos>Modifier mes informations</button></a>';

?>


<h1>Toutes inscriptions</h1>

<?php
if (empty($inscInsc)) {
    echo "Aucune inscription trouvée pour cet élève.";
} else { ?>
<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Matiere</th>
                <th scope="col">Salle</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Professeur</th>
                <th scope="col">Détails</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($inscInsc as $value) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($value['Matiere']); ?></td>
                        <td><?php echo htmlspecialchars($value['Salle']); ?></td>
                        <td><?php echo htmlspecialchars($value['Date_Cours']); ?></td>
                        <td><?php echo htmlspecialchars($value['Heure']); ?></td>
                        <td><?php echo htmlspecialchars($value['Nom_Prof']) . " " . htmlspecialchars($value['Prenom_Prof']); ?></td>
                        <td><?php echo '<a href="index.php?page=detailCours&ID_Cours=' . $value['ID_Cours'] . '"><button class = detail>Détails</button></a>'; ?></td>
                    </tr>
                <?php }
            ?>

        </tbody>
    </table>
</div>
<?php
}?>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php'); ?>
