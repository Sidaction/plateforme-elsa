<?php
// Types d'informations de proximité
$dbConn->query = "select * from partenaire order by association asc";
$dbConn->ExecuteSelect();
?>
<select name="partenaire">
	<option value=-1>Choisir un partenaire</option>
<?
while ( $part = $dbConn->Fetch_assoc() ) {
	$id		= $part["id"];
	$asso	= $part["association"];
	if ( isset($partenaireid) && $partenaireid == $id )
		echo "	<option value=$id selected>$asso</option>\n";
	else
		echo "	<option value=$id>$asso</option>\n";
}
?>
</select>