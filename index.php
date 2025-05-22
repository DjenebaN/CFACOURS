<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include ('view/commun/header.php');

$page = isset($_GET ['page']) ? $_GET['page'] : 'accueil';

switch ($page) {
    case 'signIn' :
        include ('view/logSingIn/signIn.php');
        break;
        
    case 'loginEleve' :
        include ('view/logSingIn/loginEleve.php');
        break;

    case 'loginProf' :
        include ('view/logSingIn/loginProf.php');
        break;

    case 'monCompteEleve' :
        include ('view/logSingIn/monCompteEleve.php');
        break;
        
    case 'monCompteProf' :
        include ('view/logSingIn/monCompteProf.php');
        break;

    case 'tousCours' :
        include ('view/cours/tousCours.php');
        break;

    case 'publiCours' :
        include ('view/cours/publiCours.php');
        break;

    case 'publiCoursUpdate' :
        include ('view/cours/publiCoursUpdate.php');
        break;

    case 'updateCompteEleve' :
        include ('view/logSingIn/updateCompteEleve.php');
        break;

    case 'updateCompteProf' :
        include ('view/logSingIn/updateCompteProf.php');
        break;

    case 'listeEleves' :
        include ('view/cours/listeEleves.php');
        break;

    case 'logOut' :
        include ('view/logSingIn/logOut.php');
        break;

    case 'detailCours':
        include('view/cours/detailCours.php');
        break;

    default:
		include('view/accueil.php');
		break;
}