<?php
$elsa->GetSession();
if ( isset($_SESSION['admin_user_connected']) )
	$user_connected = $_SESSION['admin_user_connected'];
else
	header( "location: ".$elsa->URL."adminelsa/login.php");
?>