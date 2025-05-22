<?php

class Eleve
{

    private $bdd;

    function __construct ($bdd)
    {
        $this -> bdd = $bdd;
    }

    public function allEleve()
    {
        $req = $this -> bdd -> prepare ("SELECT * FROM ELEVES");
        $req -> execute();

        return $req -> fetchAll();
    }

    public function ajouterEleve($nom , $prenom , $email , $mdp , $niveau)
    {
        $req = $this -> bdd -> prepare("INSERT INTO ELEVES (Nom, Prenom, Email, Mdp, Niveau) VALUES (:nom , :prenom , :email , :mdp , :niveau)");
        $req -> bindParam (':nom' , $nom);
        $req -> bindParam (':prenom' , $prenom);
        $req -> bindParam (':email' , $email);
        $req -> bindParam (':mdp' , $mdp);
        $req -> bindParam (':niveau' , $niveau);

        return $req -> execute();
    }

    public function supprimerEleve($ID_Eleve)
    {
        $req = $this -> bdd -> prepare ("DELETE FROM ELEVES WHERE ID_Eleve = ?");
        return $req -> execute([$ID_Eleve]);
    }
    
    public function updateEleve($nom, $prenom, $email, $mdp, $niveau, $ID_Eleve) {
        $stmt = $this->bdd->prepare("UPDATE ELEVES 
            SET Nom = :nom, Prenom = :prenom, Email = :email, Mdp = :mdp, Niveau = :niveau
            WHERE ID_Eleve = :id");
    
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':niveau', $niveau);
        // Erreur ici : mauvais paramètre ou omission
        $stmt->bindParam(':id', $ID_Eleve); 
    
        $stmt->execute();
    }
    

    public function connection($email, $mdp)
{
    try {
        // Préparer la requête pour récupérer l'utilisateur
        $stmt = $this->bdd->prepare("SELECT * FROM ELEVES WHERE Email = :email");
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

public function getEleveById($ID_Eleve) 
{
    // Requête pour récupérer les informations de l'élève et le texte du niveau
    $stmt = $this->bdd->prepare(
        'SELECT 
            ELEVES.ID_Eleve, 
            ELEVES.Nom, 
            ELEVES.Prenom, 
            ELEVES.Email, 
            ELEVES.Mdp, 
            NIVEAUX.Niveau AS Niveau_Texte
        FROM ELEVES
        JOIN NIVEAUX ON ELEVES.Niveau = NIVEAUX.ID_Niveau
        WHERE ELEVES.ID_Eleve = ?'
    );

    // Exécutez la requête avec l'ID de l'élève
    $stmt->execute([$ID_Eleve]);

    // Renvoyez un seul résultat
    return $stmt->fetch();
}
public function getAllNiveaux()
    {
        // Requête pour récupérer tous les niveaux
        $stmt = $this->bdd->prepare('SELECT * FROM NIVEAUX');
        $stmt->execute();
        return $stmt->fetchAll();
    }



}