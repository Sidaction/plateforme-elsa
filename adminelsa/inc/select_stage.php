<?php
// Liste des années des différents stages
$dbConn->query =
	"select stage.id, ptheme.libelle, stage.annee, stage.accueil, stage.periode " .
	"from stage, ptheme where stage.idtheme=ptheme.id order by stage.annee desc, ptheme.libelle asc";
$dbConn->ExecuteSelect();
?>
<select name="stage">
	<option value=-1>Choisir un stage</option>
<?
while ( $stage = $dbConn->Fetch_assoc() ) {
	$id			= $stage["id"];
	$theme		= $stage["libelle"];
	$annee		= $stage["annee"];
	$accueil	= $stage["accueil"];
	$periode	= $stage["periode"];
	if ( isset($stageid) && $stageid == $id )
		echo "	<option value=$id selected>" . $annee . " " . $theme . " - " . $periode . " " . $accueil . "</option>\n";
	else
		echo "	<option value=$id>" . $annee . " " . $theme . " - " . $periode . " " . $accueil . "</option>\n";
}
?>
</select>