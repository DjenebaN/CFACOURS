<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/inscModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';


if (isset($_POST ['insc'])) {

    $inscController = new InscController ($bdd);

    switch ($_POST['insc']){

        case 'ajouter':
            $inscController -> create();
            break;

        case 'supprimer':
            $inscController -> delete();
            break;

        default :
            echo "Action non reconnue.";
            break;
    }
}


class InscController
{
    private $insc;

    function __construct($bdd)
    {
        $this -> insc = new Insc ($bdd);
    }

    public function create()
    {
        if (isset ($_POST ['ID_Cours'], $_POST ['ID_Eleve'])){
            $this -> insc -> ajouterInsc ($_POST ['ID_Cours'], $_POST ['ID_Eleve']);
    
            header('Location: http://127.0.0.1/CFA');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    public function delete()
    {
        // Vérifie si les données nécessaires sont présentes dans la requête POST
        if (isset($_POST['ID_Eleve'], $_POST['ID_Cours'])) {
            // Récupère les valeurs depuis POST
            $ID_Eleve = $_POST['ID_Eleve'];
            $ID_Cours = $_POST['ID_Cours'];
            
            // Appelle la méthode pour supprimer l'inscription
            $result = $this->insc->supprimerInsc($ID_Eleve, $ID_Cours);
            
            // Vérifie si la suppression a réussi
            if ($result) {
                // Redirection vers la page de l'élève après succès
                header('Location: http://127.0.0.1/CFA/');
                exit();
            } else {
                echo "Erreur : Impossible de supprimer l'inscription.";
            }
        } else {
            echo "Erreur : Données incomplètes pour effectuer la suppression.";
        }
    }
    

}
?>
