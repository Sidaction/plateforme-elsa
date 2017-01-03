<?php
// Liste des années des différents stages
$dbConn->query = "select distinct annee from stage order by annee desc";
$dbConn->ExecuteSelect();
?>
<select name="annee" onChange="javascript:document.stage.submit();">
	<option value=-1>Choisir une année</option>
<?
while ( $stage = $dbConn->Fetch_assoc() ) {
	$annee = $stage["annee"];
	if ( isset($cannee) && $cannee == $annee )
		echo "	<option value=$annee selected>" . $annee . "</option>\n";
	else
		echo "	<option value=$annee>" . $annee . "</option>\n";
}
?>
</select>