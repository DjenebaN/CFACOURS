<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/eleveModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';


if (isset($_POST ['eleve'])) {

    $eleveController = new EleveController ($bdd);

    switch ($_POST['eleve']){

        case 'ajouter':
            $eleveController -> create();
            break;

        case 'supprimer':
            $eleveController -> delete();
            break;
        case 'connection':
            $eleveController -> connect();

        case 'update' :
            $eleveController -> update ();
            break;
        default :
            echo "Action non reconnue.";
            break;
    }
}


class EleveController
{
    private $eleve;

    function __construct($bdd)
    {
        $this -> eleve = new Eleve ($bdd);
    }

    public function create()
    {
        if (isset ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['niveau'])){
            $this -> eleve -> ajouterEleve ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['niveau']);
    
            header('Location: http://127.0.0.1/CFA/');
            exit();
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    public function delete()
    {
        if (isset ($_POST ['ID_Eleve'])){
            $this -> eleve -> supprimerEleve ($_POST ['ID_Eleve']);
    
            header('Location: http://127.0.0.1/CFA/');
            exit();
        }
    }

    public function update()
    {
        if (isset ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['niveau'] , $_POST ['ID_Eleve'])){
            $this -> eleve -> updateEleve ($_POST ['nom'], $_POST ['prenom'] , $_POST['email'], $_POST['mdp'], $_POST ['niveau'] , $_POST ['ID_Eleve']);
    
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

        $user = $this->eleve->connection($email, $mdp);
        
        if ($user) {
            // Si l'utilisateur est trouvé et les informations sont valides
            session_start(); // Démarrer la session
            $_SESSION['ID_Eleve'] = $user['ID_Eleve']; // Stocker l'ID de l'utilisateur dans la session
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
