<?php
// Types d'informations de proximité
$dbConn->query = "select * from ptheme order by libelle asc";
$dbConn->ExecuteSelect();
?>
<select name="ptheme" onChange="javascript:document.theme.submit();">
	<option value=-1>Select a theme</option>
<?
while ( $ptheme = $dbConn->Fetch_assoc() ) {
	$id			= $ptheme["id"];
	$libelle	= $ptheme["libelle_en"];
	if ( isset($pthemeid) && $pthemeid == $id )
		echo "	<option value=$id selected>$libelle</option>\n";
	else
		echo "	<option value=$id>$libelle</option>\n";
}
?>
</select>