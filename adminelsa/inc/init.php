<?php
// 1. Initialisation de Elsa
global $elsa;
$elsa = new Elsa();

// 2.1. Instance de la base de données
$dbConn = new MySQL( $elsa->DB_SERVER, $elsa->DB_NAME, $elsa->DB_USER, $elsa->DB_PASSWORD, $elsa->DB_ADMINMAIL);

// 2.2. Connexion à la base de données
$dbConn->Connect();
?>