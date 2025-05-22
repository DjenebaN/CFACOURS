<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/coursModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$cours = new Cours ($bdd);
$allCours = $cours -> allCours();

?>