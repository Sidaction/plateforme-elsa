<?php
// Types d'informations de proximité
if ( isset($source_page) && $source_page == "SP" )	// Cas SP : Stages précendents. Mémo: Penser à MAJ la date
	$dbConn->query = "select * from ptheme where exists ( select * from stage where ptheme.id=stage.idtheme ) order by libelle asc";	// and stage.annee<>'2009' plus nécessaire car que Archives
else
	$dbConn->query = "select * from ptheme order by libelle asc";
$dbConn->ExecuteSelect();
?>
<select name="ptheme" onChange="javascript:document.theme.submit();">
	<option value="-1">Choisir un thème</option>
<?
while ( $ptheme = $dbConn->Fetch_assoc() ) {
	$id			= $ptheme["id"];
	$libelle	= $ptheme["libelle"];
	if ( isset($pthemeid) && $pthemeid == $id )
		echo "	<option value=$id selected>$libelle</option>\n";
	else
		echo "	<option value=$id>$libelle</option>\n";
}
?>
</select>