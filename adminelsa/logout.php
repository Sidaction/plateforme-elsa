<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");

$elsa = new Elsa();
$elsa->Logout();

header( "Location: login.php");
?>