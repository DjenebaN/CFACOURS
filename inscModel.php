<?php

class Insc
{

    private $bdd;

    function __construct ($bdd)
    {
        $this -> bdd = $bdd;
    }

    public function allInsc()
    {
        $req = $this -> bdd -> prepare ("SELECT * FROM Inscription");
        $req -> execute();

        return $req -> fetchAll();
    }

    public function ajouterInsc($ID_Cours , $ID_Eleve)
    {
        $req = $this -> bdd -> prepare("INSERT INTO INSCRIPTIONS (ID_Cours, ID_Eleve) VALUES (:ID_Cours , :ID_Eleve)");
        $req -> bindParam (':ID_Cours' , $ID_Cours);
        $req -> bindParam (':ID_Eleve' , $ID_Eleve);

        return $req -> execute();
    }

    public function supprimerInsc($ID_Eleve, $ID_Cours) 
    {
        $query = "DELETE FROM INSCRIPTIONS WHERE ID_Eleve = :ID_Eleve AND ID_Cours = :ID_Cours";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':ID_Eleve', $ID_Eleve, PDO::PARAM_INT);
        $stmt->bindParam(':ID_Cours', $ID_Cours, PDO::PARAM_INT);
    
        return $stmt->execute(); // Retourne vrai si la suppression a réussi
    }

    
    
    public function getInscByIdEleve($ID_Eleve) 
{
    // Requête pour récupérer les inscriptions avec le libellé du niveau
    $stmt = $this->bdd->prepare(
        'SELECT 
            COURS.ID_Cours, 
            COURS.Matiere, 
            COURS.Salle, 
            COURS.Date_Cours, 
            COURS.Heure, 
            NIVEAUX.Niveau AS Niveau_Texte, 
            PROFESSEURS.Nom AS Nom_Prof, 
            PROFESSEURS.Prenom AS Prenom_Prof
        FROM INSCRIPTIONS
        JOIN COURS ON INSCRIPTIONS.ID_Cours = COURS.ID_Cours
        JOIN NIVEAUX ON COURS.Niveau = NIVEAUX.ID_Niveau
        JOIN PROFESSEURS ON COURS.ID_Professeur = PROFESSEURS.ID_Professeur
        WHERE INSCRIPTIONS.ID_Eleve = ?'
    );

    // Exécutez la requête avec l'ID de l'élève
    $stmt->execute([$ID_Eleve]);

    // Renvoyez tous les résultats
    return $stmt->fetchAll();
}


    public function checkInscExists($ID_Eleve, $ID_Cours) {
        $query = "SELECT COUNT(*) as count FROM INSCRIPTIONS WHERE ID_Eleve = :ID_Eleve AND ID_Cours = :ID_Cours";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':ID_Eleve', $ID_Eleve, PDO::PARAM_INT);
        $stmt->bindParam(':ID_Cours', $ID_Cours, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'] > 0; // Retourne vrai si une inscription existe
    }

    public function getElevesByCours($ID_Cours) {
        $stmt = $this->bdd->prepare("
            SELECT e.ID_Eleve, e.Nom, e.Prenom, e.Email, n.Niveau AS Niveau_Texte
            FROM ELEVES e
            INNER JOIN INSCRIPTIONS i ON e.ID_Eleve = i.ID_Eleve
            INNER JOIN NIVEAUX n ON e.Niveau = n.ID_Niveau
            WHERE i.ID_Cours = :ID_Cours
        ");
        $stmt->bindParam(':ID_Cours', $ID_Cours, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}