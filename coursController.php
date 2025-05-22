<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';


if (isset($_POST ['cours'])) {

    $coursController = new CoursController ($bdd);

    switch ($_POST['cours']){

        case 'ajouter':
            $coursController -> create();
            break;
            
        case 'modifier':
            $coursController -> update();
            break;

        case 'supprimer':
            $coursController -> delete();
            break;

        default :
            echo "Action non reconnue.";
            break;
    }
}


class CoursController
{
    private $cours;

    function __construct($bdd)
    {
        $this -> cours = new Cours ($bdd);
    }

    public function create()
{
    // Vérification si tous les champs sont présents dans le formulaire
    if (isset($_POST['ID_Professeur'], $_POST['matiere'], $_POST['salle'], $_POST['date'], $_POST['heure'], $_POST['niveau'], $_POST['infos'])) {
        
        // Ajouter le cours avec les valeurs récupérées
        $this->cours->ajouterCours($_POST['ID_Professeur'], $_POST['matiere'],$_POST['salle'] ,$_POST['date'], $_POST['heure'], $_POST['niveau'], $_POST['infos']);

        // Redirection après l'ajout du cours
        header('Location: http://127.0.0.1/CFA/');
        exit();
    } else {
        // Si un champ est manquant, afficher un message d'erreur
        echo "Tous les champs sont requis.";
    }
}

public function update()
    {
        // Vérifier que les données nécessaires sont présentes
        if (isset($_POST['matiere'], $_POST['salle'], $_POST['date'], $_POST['heure'], $_POST['niveau'], $_POST['infos'], $_POST['ID_Cours'])) {
            
            // Récupérer l'ID du professeur à partir de la session
            $ID_Professeur = $_SESSION['ID_Professeur'];

            // Appeler la méthode pour mettre à jour le cours
            $result = $this->cours->updateCours(
                $_POST['matiere'], 
                $_POST['salle'], 
                $_POST['date'], 
                $_POST['heure'], 
                $_POST['niveau'], 
                $_POST['infos'], 
                $ID_Professeur,  // ID du professeur récupéré depuis la session
                $_POST['ID_Cours']
            );
            
            // Si la mise à jour a réussi, rediriger vers la page principale
            if ($result) {
                header('Location: http://127.0.0.1/CFA/');
                exit();
            } else {
                echo "Erreur lors de la mise à jour du cours.";
            }

        } else {
            echo "Tous les champs sont requis.";
        }
    }

public function delete()
{
    // Vérifier si 'ID_Cours' est présent dans la requête POST
    if (isset($_POST['ID_Cours']) && !empty($_POST['ID_Cours'])) {
        // Récupérer l'ID_Cours de la requête POST
        $ID_Cours = $_POST['ID_Cours'];

        // Appeler la méthode pour supprimer le cours dans la base de données
        $result = $this->cours->supprimerCours($ID_Cours);

        header('Location: http://127.0.0.1/CFA/');
        exit();
    } else {
        // Si un champ est manquant, afficher un message d'erreur
        echo "La suppréssion a échouée.";
    }
}







}
?>
