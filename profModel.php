<?php

class Prof
{

    private $bdd;

    function __construct ($bdd)
    {
        $this -> bdd = $bdd;
    }

    public function allProf()
    {
        $req = $this -> bdd -> prepare ("SELECT * FROM PROFESSEURS");
        $req -> execute();

        return $req -> fetchAll();
    }

    public function supprimerProf($ID_Eleve)
    {
        $req = $this -> bdd -> prepare ("DELETE FROM PROFESSEURS WHERE ID_Professeur = ?");
        return $req -> execute([$ID_Eleve]);
    }
    
    public function updateprof ($nom , $prenom , $email , $mdp , $ID_Professeur)
    {
        $stmt = $this -> bdd -> prepare ("UPDATE PROFESSEURS SET Nom = :nom , Prenom = :prenom , Email = :email, Mdp = :mdp WHERE ID_Professeur = :ID_Professeur");
        $stmt -> bindParam (':nom' , $nom);
        $stmt -> bindParam (':prenom' , $prenom);
        $stmt -> bindParam (':email' , $email);
        $stmt -> bindParam (':mdp' , $mdp);
        $stmt -> bindParam (':ID_Professeur' , $ID_Professeur);

        return $stmt -> execute();

    }

    public function connection($email, $mdp)
{
    try {
        // Préparer la requête pour récupérer l'utilisateur
        $stmt = $this->bdd->prepare("SELECT * FROM PROFESSEURS WHERE Email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Récupérer l'utilisateur
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && $mdp === $user['Mdp']) {
            return $user; // Connexion réussie
        } else {
            return false; // Identifiants incorrects
        }
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur : " . $e->getMessage();
        return false;
    }
}

public function getProfById($ID_Professeur)
{
    $stmt = $this->bdd->prepare('SELECT * FROM PROFESSEURS WHERE ID_Professeur = ?');
    $stmt->execute([$ID_Professeur]);
    return $stmt->fetch();
}


}