<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CFAINSTA</title>

    <!-- Inclusion de votre propre fichier style.css -->
    <link rel="stylesheet" href="/CFA/view/commun/style.css">
</head>

<body>
  <style>body {
  margin: 0;
  padding: 0;
  background: linear-gradient(118deg, #6495ED, #F0FFFF);
  height: 100vh;
  overflow: hidden;
  }</style>
          <div class = "nav">
          <div class = "navInput">
          <?php 
          if (isset($_SESSION['ID_Eleve'])) {
              echo '<button class="navValue"><a aria-current="page" href="http://localhost/CFA/">Home</a></button>';
              echo '<button class="navValue"><a href="index.php?page=monCompteEleve&ID_Eleve=' . htmlspecialchars($_SESSION['ID_Eleve']) . '">' . htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']) . '</a></button>';
              echo '<button class="navValue"><a class="nav-link" href="index.php?page=tousCours">Cours</a></button>';
              echo '<button class="navValue"><a class="nav-link" href="index.php?page=logOut">Deconnection</a></button>';

            } elseif (isset($_SESSION['ID_Professeur'])){
              echo '<button class="navValue"><a aria-current="page" href="http://localhost/CFA/">Home</a></button>';
              echo '<button class="navValue"><a href="index.php?page=monCompteProf&ID_Professeur=' . htmlspecialchars($_SESSION['ID_Professeur']) . '">' . htmlspecialchars($_SESSION['prenom']) . ' ' . htmlspecialchars($_SESSION['nom']) . '</a></button>';
              echo '<button class="navValue"><a href="index.php?page=tousCours">Cours</a></button>';
              echo '<button class="navValue"><a href="index.php?page=publiCours">Nouveau Cours</a></button>';
              echo '<button class="navValue"><a href="index.php?page=logOut">Deconnection</a></button>';
            } else {
              echo '<button class="navValue"><a class="nav-link active" aria-current="page" href="http://localhost/CFA/">Home</a></button>';
              echo '<button class="navValue"><a class="nav-link" href="index.php?page=tousCours">Cours</a></button>';
              echo '<button class="navValue"><a class="nav-link" href="index.php?page=loginEleve">Connection</a></button>';
              echo '<button class="navValue"><a class="nav-link" href="index.php?page=loginProf">Espace Prof</a></button>';

            }
          ?>
    </div>
    </div>
 <style>

  .nav{
    display: flex;
    justify-content: center;
  }

  .navInput {
  height: 50px;
  display: flex;
  flex-direction: row;
  width: fit-content;
  background-color: #0a2351;
  justify-content: center;
  border-radius: 5px;
  gap: 7.5px;
  align-items: center;
}

.navValue {
  background-color: transparent;
  border: none;
  padding: 10px;
  color: white;
  display: flex;
  position: relative;
  gap: 5px;
  cursor: pointer;
  border-radius: 4px;
  transition: all 0.2s ease;
}
.navValue a{
  text-decoration: none;
  color: white;
  font-size: 20px;
}

.navValue:not(:active):hover,
.navValue:focus {
  background-color: #21262c;
}

.navValue:focus,
.navValue:active {
  background-color: #1a1f24;
  outline: none;
}

.navValue::before {
  content: "";
  position: absolute;
  top: 30px;
  right: 0px;
  width: 100%;
  height: 3px;
  background-color: #2f81f7;
  border-radius: 5px;
  opacity: 0;
}

.navValue:focus::before,
.navValue:active::before {
  opacity: 1;
}

 </style>