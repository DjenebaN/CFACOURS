<?php

class Cours
{

    private $bdd;

    function __construct ($bdd)
    {
        $this -> bdd = $bdd;
    }

    public function allCours()
{
    $req = $this->bdd->prepare(
        "SELECT 
            COURS.ID_Cours, 
            COURS.Matiere, 
            COURS.Salle, 
            COURS.Date_Cours, 
            COURS.Heure, 
            NIVEAUX.Niveau AS Niveau_Texte, 
            PROFESSEURS.Nom AS Nom_Prof, 
            PROFESSEURS.Prenom AS Prenom_Prof
        FROM COURS
        JOIN PROFESSEURS ON COURS.ID_Professeur = PROFESSEURS.ID_Professeur
        JOIN NIVEAUX ON COURS.Niveau = NIVEAUX.ID_Niveau"
    );
    $req->execute();

    return $req->fetchAll();
}


    public function ajouterCours($ID_Professeur , $matiere, $salle, $date, $heure, $niveau, $infos)
{
    // Préparation de la requête SQL pour ajouter le cours
    $req = $this->bdd->prepare("INSERT INTO Cours (ID_Professeur, Matiere, Salle, Date_Cours, Heure, Niveau, Infos) 
                                VALUES (:ID_Professeur, :matiere, :salle, :date, :heure, :niveau, :infos)");

    // Liaison des paramètres
    $req->bindParam(':ID_Professeur', $ID_Professeur);
    $req->bindParam(':matiere', $matiere);
    $req->bindParam(':salle', $salle);
    $req->bindParam(':date', $date);   // La date sous le format YYYY-MM-DD
    $req->bindParam(':heure', $heure); // L'heure sous le format HH:MM
    $req->bindParam(':niveau', $niveau);
    $req->bindParam(':infos', $infos);

    // Exécution de la requête
    return $req->execute();
}


public function supprimerCours($id)
{
    var_dump($id); // Vérifiez que l'ID est bien reçu
    $query = "DELETE FROM Cours WHERE ID_Cours = :id";
    $stmt = $this->bdd->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
    

public function getCoursById($ID_Cours) 
{
    // Préparez la requête SQL pour récupérer les informations du cours avec le texte du niveau
    $stmt = $this->bdd->prepare(
        'SELECT 
            COURS.ID_Cours, 
            COURS.Matiere, 
            COURS.Salle, 
            COURS.Date_Cours, 
            COURS.Heure, 
            COURS.Infos, 
            NIVEAUX.Niveau AS Niveau_Texte,
            PROFESSEURS.Nom AS Nom_Prof, 
            PROFESSEURS.Prenom AS Prenom_Prof
        FROM COURS
        JOIN PROFESSEURS ON COURS.ID_Professeur = PROFESSEURS.ID_Professeur
        JOIN NIVEAUX ON COURS.Niveau = NIVEAUX.ID_Niveau
        WHERE COURS.ID_Cours = ?'
    );

    // Exécutez la requête avec l'ID du cours passé en paramètre
    $stmt->execute([$ID_Cours]);
    
    // Récupérez les résultats de la requête
    return $stmt->fetch();
}

    
public function getCoursByProf($ID_Professeur) 
{
    // Préparez la requête SQL pour récupérer les cours donnés par le professeur, avec le libellé du niveau
    $stmt = $this->bdd->prepare(
        'SELECT 
            COURS.ID_Cours, 
            COURS.Matiere, 
            COURS.Salle, 
            COURS.Date_Cours, 
            COURS.Heure, 
            COURS.Infos, 
            NIVEAUX.Niveau AS Niveau_Texte
        FROM COURS
        JOIN NIVEAUX ON COURS.Niveau = NIVEAUX.ID_Niveau
        WHERE COURS.ID_Professeur = ?'
    );

    // Exécutez la requête en passant l'ID du professeur
    $stmt->execute([$ID_Professeur]);

    // Récupérez tous les résultats de la requête
    return $stmt->fetchAll();
}

    
    public function updateCours($matiere, $salle, $date, $heure, $niveau, $infos, $ID_Professeur, $ID_Cours)
    {
        $stmt = $this->bdd->prepare(
            "UPDATE COURS 
             SET Matiere = :matiere, 
                 Salle = :salle, 
                 Date_Cours = :date, 
                 Heure = :heure, 
                 Niveau = :niveau, 
                 Infos = :infos, 
                 ID_Professeur = :ID_Professeur
             WHERE ID_Cours = :ID_Cours"
        );
        $stmt->bindParam(':matiere', $matiere);
        $stmt->bindParam(':salle', $salle);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->bindParam(':infos', $infos);
        $stmt->bindParam(':ID_Professeur', $ID_Professeur);
        $stmt->bindParam(':ID_Cours', $ID_Cours);

        // Exécuter la requête
        return $stmt->execute();
    }

    public function donneCoursExistant ($ID_Professeur, $ID_Cours) {
        $query = "SELECT COUNT(*) as count FROM COURS WHERE ID_Professeur = :ID_Professeur AND ID_Cours = :ID_Cours";
        $stmt = $this->bdd->prepare($query);
        $stmt->bindParam(':ID_Professeur', $ID_Professeur, PDO::PARAM_INT);
        $stmt->bindParam(':ID_Cours', $ID_Cours, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result['count'] > 0; // Retourne vrai si une inscription existe
    }

    public function getElevesByCours($ID_Cours) {
        // Requête SQL pour récupérer les élèves inscrits à un cours spécifique
        $stmt = $this->bdd->prepare("
            SELECT e.ID_Eleve, e.Nom, e.Prenom, e.Email, e.Niveau
            FROM ELEVES e
            INNER JOIN INSCRIPTION i ON e.ID_Eleve = i.ID_Eleve
            WHERE i.ID_Cours = :ID_Cours
        ");
        
        // Liaison du paramètre
        $stmt->bindParam(':ID_Cours', $ID_Cours, PDO::PARAM_INT);

        // Exécution de la requête
        $stmt->execute();

        // Récupérer tous les résultats sous forme de tableau associatif
        $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retourner la liste des élèves
        return $eleves;
    }

    public function getNiveaux()
{
    $stmt = $this->bdd->prepare("SELECT ID_Niveau, Niveau FROM NIVEAUX");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}