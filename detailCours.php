<?php

if (isset($_GET['ID_Cours']) && !empty($_GET['ID_Cours'])) {
    $ID_Cours = $_GET['ID_Cours'];
} else {
    echo "L'ID du cours est manquant ou invalide dans l'URL.";
    exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/inscModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$cours = new Cours($bdd);
$insc = new Insc($bdd);

$detailCours = $cours->getCoursById($ID_Cours);

if (!$detailCours) {
    echo "Aucun détail trouvé pour ce cours.";
    exit();
}

?>

<h1>Détail Cours</h1>
<p>Nom du Professeur : <?php echo htmlspecialchars($detailCours['Nom_Prof']); ?></p>
<p>Prénom du Professeur : <?php echo htmlspecialchars($detailCours['Prenom_Prof']); ?></p>
<p>Matière : <?php echo htmlspecialchars($detailCours['Matiere']); ?></p>
<p>Salle : <?php echo htmlspecialchars($detailCours['Salle']); ?></p>
<p>Date : <?php echo htmlspecialchars($detailCours['Date_Cours']); ?></p>
<p>Heure : <?php echo htmlspecialchars($detailCours['Heure']); ?></p>
<p>Niveau : <?php echo htmlspecialchars($detailCours['Niveau_Texte']); ?></p>
<p>Informations : <?php echo htmlspecialchars($detailCours['Infos']); ?></p>

<?php
if (isset($_SESSION['ID_Eleve'])) {
    $ID_Eleve = $_SESSION['ID_Eleve'];

    // Vérifier si l'inscription existe
    $inscriptionExistante = $insc->checkInscExists($ID_Eleve, $ID_Cours);

    if ($inscriptionExistante) {
        echo '<form action="controller/inscController.php" method="POST">';
        echo '<input type="hidden" name="insc" value="supprimer">';
        echo '<input type="hidden" name="ID_Cours" value="' . htmlspecialchars($ID_Cours) . '">';
        echo '<input type="hidden" name="ID_Eleve" value="' . htmlspecialchars($ID_Eleve) . '">';
        echo '<button class = detail type="submit">Se désinscrire</button>';
        echo '</form>';
    } else {
        echo '<form action="controller/inscController.php" method="POST">';
        echo '<input type="hidden" name="insc" value="ajouter">';
        echo '<input type="hidden" name="ID_Cours" value="' . htmlspecialchars($ID_Cours) . '">';
        echo '<input type="hidden" name="ID_Eleve" value="' . htmlspecialchars($ID_Eleve) . '">';
        echo '<button class = detail type="submit">Inscription</button>';
        echo '</form>';
    }
}
?>

<?php
if (isset($_SESSION['ID_Professeur'])) {
    $ID_Professeur = $_SESSION['ID_Professeur'];

    // Vérifier si l'inscription existe
    $donneCoursExistant = $cours->donneCoursExistant($ID_Professeur, $ID_Cours);

    if ($donneCoursExistant) {
    // Formulaire pour supprimer le cours
// Formulaire pour supprimer le cours
echo '<form action="controller/coursController.php" method="POST">';
echo '<input type="hidden" name="cours" value="supprimer">';
echo '<input type="hidden" name="ID_Cours" value="' . htmlspecialchars($detailCours['ID_Cours']) . '">';
echo '<button class="delete" type="submit">
        <span class="text">Supprimer</span>
        <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
            </svg>
        </span>
      </button>';
echo '</form>';



    echo '<a href="index.php?page=listeEleves&ID_Cours=' .($detailCours['ID_Cours']) . '"><button class = detail>Élèves</button></a>';
    }

}

?>
