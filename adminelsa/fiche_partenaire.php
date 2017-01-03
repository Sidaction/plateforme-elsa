<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

$message = "";
$date = new Date();

$dao = new PartenaireDAO( $dbConn);
$partenaire = new Partenaire( NULL);

if ( isset($_GET['id']) ) {				// On arrive sur la fiche en consultation
	if ( isset($_GET['action']) && $_GET['action'] == "DELETE") {
		$dao->Delete( intval($_GET['id']));
		$partenaire->id = -1;
		$action = "CREATE";
		$message = "Le partenaire a bien été effacé.";
	}
	else {
		$action = "UPDATE";
		$partenaire = $dao->Get( intval($_GET['id']));
	}
}
else if ( isset($_POST['action']) ) {	// Le formulaire a été posté
	$partenaire->association		= $_POST["association"];
	$partenaire->presentation_fr	= $_POST["presentation_fr"];
	$partenaire->presentation_en	= $_POST["presentation_en"];
	$partenaire->activites_fr		= $_POST["activites_fr"];
	$partenaire->activites_en		= $_POST["activites_en"];
	$partenaire->persbenef_fr		= $_POST["persbenef_fr"];
	$partenaire->persbenef_en		= $_POST["persbenef_en"];
	$partenaire->contact1			= $_POST["contact1"];
	$partenaire->contact2			= $_POST["contact2"];
	$partenaire->contact3			= $_POST["contact3"];
	$partenaire->adresse			= $_POST["adresse"];
	$partenaire->idpays				= $_POST["ppays"];
	$partenaire->email1				= $_POST["email1"];
	$partenaire->email2				= $_POST["email2"];
	$partenaire->email3				= $_POST["email3"];
	$partenaire->tel1				= $_POST["tel1"];
	$partenaire->tel2				= $_POST["tel2"];
	$partenaire->tel3				= $_POST["tel3"];
	$partenaire->fax1				= $_POST["fax1"];
	$partenaire->fax2				= $_POST["fax2"];
	$partenaire->fax3				= $_POST["fax3"];
	$partenaire->url				= $_POST["url"];
	$partenaire->isactive			= $_POST["isactive"];
	$partenaire->dcreat				= $_POST["dcreat"];
	$partenaire->dmodif				= $_POST["dmodif"];

	if ( $_POST['action'] == "UPDATE" ) {
		$partenaire->id	= $_POST["id"];
		$dao->Update( $partenaire);
		$message = "Mise a jour effectuée.";
	}
	else if ( $_POST['action'] == "CREATE" ) {
		$dao->Insert( $partenaire);
		$message = "Fiche créée.";
	}
	$action = "UPDATE";
}	
else									// Création d'un nouveau partenaire
	$action = "CREATE";
?>
<html>
<head>
<title>Plateforme ELSA - Fiche Partenaire</title>
<?php include( "inc/head.php"); ?>
</head>
<body>
<table width="500" align="center"><tr>
	<td width="80%"><h3><?php echo $partenaire->association; ?></h3></td>
	<td align="center" style="color:#ff6300" width="20%"><h4>Plateforme<br>ELSA</h4></td>
</tr></table>
<p class="message" align="center"><?php if ( isset($message) ) echo htmlentities( $message); ?></p>
<fieldset style="border:1px #ff6300 solid;">
<form action="fiche_partenaire.php" method="post" name="partenaire" onSubmit="javascript:return IsValidPartenaire();">
<input type="hidden" name="action" value="<?php echo $action; ?>">
<input type="hidden" name="id" value="<?php echo $partenaire->id; ?>">
<input type="hidden" name="dcreat" value="<?php echo $partenaire->dcreat; ?>">
<input type="hidden" name="dmodif" value="<?php echo $partenaire->dmodif; ?>">
<p><legend>Identifiant <b><?php echo $partenaire->id; ?></b> - Création <b><?php echo $date->db2french( $partenaire->dcreat); ?></b> - Modification <b><?php echo $date->db2french( $partenaire->dmodif); ?></b></legend></p>
<table width="500" align="center">
<tr>
	<td align="right"><b>Association : </b></td>
	<td><input type="text" size="40" maxlength="100" name="association" value="<?php echo $partenaire->association; ?>"></td>
</tr>
<tr>
	<td width="120" align="right"><b>Pays : </b></td>
	<td width="380"><?php $ppaysid = $partenaire->idpays; include( "inc/select_ppays.php"); ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
		<input type="radio" name="isactive" value="true" <?php echo ( !isset($partenaire->isactive) || $partenaire->isactive=="true" )?"checked":""; ?>> <b>Actif</b>
		<input type="radio" name="isactive" value="false" <?php echo ( $partenaire->isactive=="false" )?"checked":""; ?>> <b>Non actif</b>
	</td>
</tr>
<tr>
	<td colspan="2">Présentation (français) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="presentation_fr"><?php echo $partenaire->presentation_fr; ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Présentation (anglais) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="presentation_en"><?php echo $partenaire->presentation_en; ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Activités (français) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="activites_fr"><?php echo $partenaire->activites_fr; ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Activités (anglais) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="activites_en"><?php echo $partenaire->activites_en; ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Nombre de personnes bénéficiaires (français) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="persbenef_fr"><?php echo $partenaire->persbenef_fr; ?></textarea></td>
</tr>
<tr>
	<td colspan="2">Nombre de personnes bénéficiaires (anglais) : </td>
</tr>
<tr>
	<td colspan="2" align="center"><textarea cols="45" rows="10" name="persbenef_en"><?php echo $partenaire->persbenef_en; ?></textarea></td>
</tr>
<tr>
	<td align="right">Contact 1 : </td>
	<td><input type="text" size="40" maxlength="100" name="contact1" value="<?php echo $partenaire->contact1; ?>"></td>
</tr>
<tr>
	<td align="right">Contact 2 : </td>
	<td><input type="text" size="40" maxlength="100" name="contact2" value="<?php echo $partenaire->contact2; ?>"></td>
</tr>
<tr>
	<td align="right">Contact 3 : </td>
	<td><input type="text" size="40" maxlength="100" name="contact3" value="<?php echo $partenaire->contact3; ?>"></td>
</tr>
<tr>
	<td align="right">Adresse : </td>
	<td><input type="text" size="40" maxlength="200" name="adresse" value="<?php echo $partenaire->adresse; ?>"></td>
</tr>
<tr>
	<td align="right">E-Mail 1 : </td>
	<td><input type="text" size="40" maxlength="50" name="email1" value="<?php echo $partenaire->email1; ?>"></td>
</tr>
<tr>
	<td align="right">E-Mail 2 : </td>
	<td><input type="text" size="40" maxlength="50" name="email2" value="<?php echo $partenaire->email2; ?>"></td>
</tr>
<tr>
	<td align="right">E-Mail 3 : </td>
	<td><input type="text" size="40" maxlength="50" name="email3" value="<?php echo $partenaire->email3; ?>"></td>
</tr>
<tr>
	<td align="right">Téléphone 1 : </td>
	<td><input type="text" size="40" maxlength="20" name="tel1" value="<?php echo $partenaire->tel1; ?>"></td>
</tr>
<tr>
	<td align="right">Téléphone 2 : </td>
	<td><input type="text" size="40" maxlength="20" name="tel2" value="<?php echo $partenaire->tel2; ?>"></td>
</tr>
<tr>
	<td align="right">Téléphone 3 : </td>
	<td><input type="text" size="40" maxlength="20" name="tel3" value="<?php echo $partenaire->tel3; ?>"></td>
</tr>
<tr>
	<td align="right">Fax 1 : </td>
	<td><input type="text" size="40" maxlength="20" name="fax1" value="<?php echo $partenaire->fax1; ?>"></td>
</tr>
<tr>
	<td align="right">Fax 2 : </td>
	<td><input type="text" size="40" maxlength="20" name="fax2" value="<?php echo $partenaire->fax2; ?>"></td>
</tr>
<tr>
	<td align="right">Fax 3 : </td>
	<td><input type="text" size="40" maxlength="20" name="fax3" value="<?php echo $partenaire->fax3; ?>"></td>
</tr>
<tr>
	<td align="right">Site Internet : </td>
	<td><input type="text" size="40" maxlength="100" name="url" value="<?php echo $partenaire->url; ?>"></td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="Valider">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Re Initialiser">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value="Effacer" onClick="javascript:DeletePartenaire( '<?php echo $partenaire->id; ?>');">
	</td>
</tr>
</table>
</form>
</fieldset>
</body>
</html>