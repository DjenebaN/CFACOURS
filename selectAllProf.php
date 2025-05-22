<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/profModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$prof = new Prof ($bdd);
$allProf = $prof -> allProf();

?>