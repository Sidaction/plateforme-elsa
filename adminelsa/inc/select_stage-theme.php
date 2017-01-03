<?php
// Liste des années des différents stages
$dbConn->query = "select distinct theme from stage order by theme asc";
$dbConn->ExecuteSelect();
?>
<select name="theme" onChange="javascript:document.stage.submit();">
	<option value=-1>Choisir un thème</option>
<?
while ( $stage = $dbConn->Fetch_assoc() ) {
	$theme = $stage["theme"];
	if ( isset($ctheme) && $ctheme == $theme )
		echo "	<option value=\"" . $theme . "\" selected>" . $theme . "</option>\n";
	else
		echo "	<option value=\"" . $theme . "\">" . $theme . "</option>\n";
}
?>
</select>