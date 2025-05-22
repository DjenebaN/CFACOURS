<?php

$ID_Cours = $_GET['ID_Cours'];

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/inscModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$cours = new Cours($bdd);
$insc = new Insc($bdd);

// Récupérer la liste des élèves inscrits à ce cours
$inscritsCours = $insc->getElevesByCours($ID_Cours);

// Débogage : vérifier si des données sont récupérées
if (empty($inscritsCours)) {
    echo "Aucun élève inscrit à ce cours.";
}

?>

<div class="table-container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Niveau</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (!empty($inscritsCours)) {
                foreach ($inscritsCours as $index => $eleve) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($eleve['Nom']); ?></td>
                        <td><?php echo htmlspecialchars($eleve['Prenom']); ?></td>
                        <td><?php echo htmlspecialchars($eleve['Email']); ?></td>
                        <td><?php echo htmlspecialchars($eleve['Niveau_Texte']); ?></td> <!-- Texte du niveau -->
                        <td>
                        <form action="controller/inscController.php" method="POST">
    <input type="hidden" name="insc" value="supprimer">
    <input type="hidden" name="ID_Cours" value="<?php echo htmlspecialchars($ID_Cours); ?>">
    <input type="hidden" name="ID_Eleve" value="<?php echo htmlspecialchars($eleve['ID_Eleve']); ?>">

    <!-- Bouton stylisé "Supprimer" -->
    <button class="delete" type="submit">
        <span class="text">Supprimer</span>
        <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
            </svg>
        </span>
    </button>
</form>

                        </td>
                    </tr>
                <?php }
            }
            ?>
        </tbody>
    </table>
</div>

<style>.table {
  width: 50%;
  border-collapse: collapse;
  margin: 20px auto; /* Centre la table */
  background: none; /* Fond blanc pour la table */
  border-radius: 10px; /* Bordures arrondies */
  overflow: hidden; /* Cache les bordures arrondies */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Ombre pour la table */
}

.table thead {
  background-color: #f1f1f1; /* Couleur de fond de l'en-tête */
  color: #845EC2; /* Couleur du texte de l'en-tête */
}

.table th,
.table td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #dddddd; /* Ligne de séparation des lignes */
}

.table th {
  font-weight: bold; /* Texte en gras pour les en-têtes */
  font-size: 1.1em; /* Taille de police pour les en-têtes */
}

.table tbody tr {
  transition: background-color 0.3s ease; /* Animation au survol */
}

.table tbody tr:hover {
  background-color: #f1f1f1; /* Couleur de survol des lignes */
}

.table tbody td a {
  color: #2691d9; /* Couleur des liens dans la table */
  text-decoration: none; /* Pas de soulignement par défaut */
  font-weight: bold; /* Met le texte des liens en gras */
}

.table tbody td a:hover {
  text-decoration: underline; /* Soulignement au survol */
}</style>