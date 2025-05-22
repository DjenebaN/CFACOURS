<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/eleveModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$eleve = new Eleve ($bdd);
$allEleve = $eleve -> allEleve();

?>