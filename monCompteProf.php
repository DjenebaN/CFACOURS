<h1>Compte Prof</h1>

<?php

// Vérifier si l'ID_Professeur est dans l'URL
if (isset($_GET['ID_Professeur'])) {
    $ID_Professeur = $_GET['ID_Professeur'];  // Utilisation de $ID_Professeur
} else {
    echo "L'ID du professeur est manquant dans l'URL.";
    exit;  // Arrêter l'exécution si l'ID n'est pas passé
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/profModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$cours = new Cours($bdd);
$donneCours = $cours->getCoursByProf($ID_Professeur);  // Passer l'ID à la méthode

$prof = new Prof($bdd);
$detailProf = $prof->getProfById($ID_Professeur);  // Passer l'ID à la méthode

?>
<div class ="scroll">
<h1>Infos</h1>

<?php
echo "Nom : " . htmlspecialchars($detailProf['Nom']) . "<br>";
echo "Prenom : " . htmlspecialchars($detailProf['Prenom']) . "<br>";
echo "Email : " . htmlspecialchars($detailProf['Email']) . "<br>";
echo "Mot de Passe : " . htmlspecialchars($detailProf['Mdp']) . "<br>";
echo '<a href="index.php?page=updateCompteProf&ID_Professeur=' . $detailProf['ID_Professeur'] . '"><button class = infos>Modifier mes informations</button></a>';

?>

<h1>Tous les cours</h1>
<?php
if (empty($donneCours)) {  // Vérifier $donneCours, pas $inscInsc
    echo "Vous ne donnez aucun cours";
} else {?>
<div class="table-container"> <!-- Un conteneur pour la table -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Matiere</th>
                <th scope="col">Salle</th>
                <th scope="col">Date</th>
                <th scope="col">Heure</th>
                <th scope="col">Niveau</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donneCours as $value) {  ?>
            <tr>
                <td><?php echo htmlspecialchars($value['Matiere']); ?></td>
                <td><?php echo htmlspecialchars($value['Salle']); ?></td>
                <td><?php echo htmlspecialchars($value['Date_Cours']); ?></td>
                <td><?php echo htmlspecialchars($value['Heure']); ?></td>
                <td><?php echo htmlspecialchars($value['Niveau_Texte']); ?></td>
                <td><?php echo '<a href="index.php?page=detailCours&ID_Cours=' . $value['ID_Cours'] . '"><button class = detail>Détails</button></a>'; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php 
} ?>

<?php include ($_SERVER['DOCUMENT_ROOT'] . '/CFA/view/commun/footer.php'); ?>
