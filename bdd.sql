CREATE DATABASE CFA;

USE CFA;

CREATE TABLE NIVEAUX (
    ID_Niveau INT NOT NULL AUTO_INCREMENT,
    Niveau VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID_Niveau)
);

INSERT INTO NIVEAUX (ID_Niveau, Niveau)
VALUES 
    (1, '1ère année SLAM'),
    (2, '1ère année SISR'),
    (3, '2ème année SLAM'),
    (4, '2ème année SISR'),
    (5, '3ème année SLAM'),
    (6, '3ème année SISR'),
    (7, '4ème année SLAM'),
    (8, '4ème année SISR'),
    (9, '5ème année SLAM'),
    (10, '5ème année SISR');

CREATE TABLE ELEVES (
    ID_Eleve INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Mdp VARCHAR(100) NOT NULL,
    Niveau INT NOT NULL,
    PRIMARY KEY (ID_Eleve),
    FOREIGN KEY (Niveau) REFERENCES NIVEAUX (ID_Niveau)
);

CREATE TABLE PROFESSEURS (
    ID_Professeur INT NOT NULL AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Mdp VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID_Professeur)
);

CREATE TABLE COURS (
    ID_Cours INT NOT NULL AUTO_INCREMENT,
    ID_Professeur INT NOT NULL,
    Matiere VARCHAR(100) NOT NULL,
    Salle INT NOT NULL,
    Date_Cours DATE NOT NULL,
    Heure  TIME NOT NULL,
    Niveau INT NOT NULL,
    Infos TEXT NOT NULL,
    PRIMARY KEY (ID_Cours),
    FOREIGN KEY (ID_Professeur) REFERENCES PROFESSEURS (ID_Professeur),
    FOREIGN KEY (Niveau) REFERENCES NIVEAUX (ID_Niveau)
);

CREATE TABLE INSCRIPTIONS (
    ID_Inscription INT NOT NULL AUTO_INCREMENT,
    ID_Cours INT NOT NULL,
    ID_Eleve INT NOT NULL,
    PRIMARY KEY (ID_Inscription),
    FOREIGN KEY (ID_Cours) REFERENCES COURS (ID_Cours),
    FOREIGN KEY (ID_Eleve) REFERENCES ELEVES (ID_Eleve)
);
