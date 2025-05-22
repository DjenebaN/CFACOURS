<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/profModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

if (isset($_POST ['prof'])) {

    $profController = new ProfController ($bdd);

    switch ($_POST['prof']){

        case 'supprimer':
            $profController -> delete();
            break;
        case 'connection':
            $profController -> connect();

        case 'update' :
            $profController -> update ();
            break;
        default :
            echo "Action non reconnue.";
            break;
    }
}


class ProfController
{
    private $prof;

    function __construct($bdd)
    {
        $this -> prof = new Prof ($bdd);
    }
    public function delete()
    {
        if (isset ($_POST ['ID_Professeur'])){
            $this -> prof -> supprimerProf ($_POST ['ID_Professeur']);
    
            header('Location: http://127.0.0.1/CFA/');
            exit();
        }
    }

    public function update()
    {
        if (isset ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['ID_Professeur'])){
            $this -> prof -> updateProf ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['ID_Professeur']);
    
            header('Location: http://127.0.0.1/CFA/');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    public function connect()
{
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        $user = $this->prof->connection($email, $mdp);
        
        if ($user) {
            // Si l'utilisateur est trouvé et les informations sont valides
            session_start(); // Démarrer la session
            $_SESSION['ID_Professeur'] = $user['ID_Professeur']; // Stocker l'ID de l'utilisateur dans la session
            $_SESSION['prenom'] = $user['Prenom']; 
            $_SESSION['nom'] = $user['Nom']; 
            $_SESSION['email'] = $user['Email']; 

            header('Location: http://localhost/CFA/'); // Redirection
            exit();
        } else {
            // Identifiants incorrects
            echo "Identifiants incorrects.";
        }
    } else {
        // Champs non remplis
        echo "Veuillez remplir tous les champs.";
    }
}



}
?>
