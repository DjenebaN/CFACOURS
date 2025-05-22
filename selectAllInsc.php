<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/model/eleveModel.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CFA/bdd/bdd.php';

$insc = new Insc ($bdd);
$allInsc = $insc -> allInsc();

?>