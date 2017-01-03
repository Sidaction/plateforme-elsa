<?php
// Dans la page partenaire du site, on n'affiche que les pays dont il existe des partenaires actifs
$dbConn->query = "select distinct ppays.id, ppays.pays_en from ppays";
if ( isset($RUBRIQUE) )
	$dbConn->query .= ", partenaire where ppays.id=partenaire.idpays and partenaire.isactive='true'";
$dbConn->query .= " order by pays_en asc";
$dbConn->ExecuteSelect();
?>
<select name="ppays" onChange="javascript:document.ppays.submit();">
	<option value=-1>Select a country</option>
<?
while ( $ppays = $dbConn->Fetch_assoc() ) {
	$id			= $ppays["id"];
	$pays		= $ppays["pays_en"];
	if ( isset($ppaysid) && $ppaysid == $id )
		echo "	<option value=$id selected>$pays</option>\n";
	else
		echo "	<option value=$id>$pays</option>\n";
}
?>
</select>