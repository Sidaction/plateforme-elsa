<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

if ( !$user_connected->IsSuperAdmin() ) header( "location: index.php");

$message = "";
$date = new Date();

$dao = new StagiaireDAO( $dbConn);
$stagiaire = new Stagiaire( NULL);

if ( isset($_GET['id']) ) {				// On arrive sur la fiche en consultation
	if ( isset($_GET['action']) && $_GET['action'] == "DELETE") {
		$dao->Delete( intval($_GET['id']));
		$stagiaire->id = -1;
		$action = "CREATE";
		$message = "Le stagiaire a bien été effacé.";
	}
	else {
		$action = "UPDATE";
		$stagiaire = $dao->Get( intval($_GET['id']));
	}
}
else if ( isset($_POST['action']) ) {	// Le formulaire a été posté
	$stagiaire->idstage			= $_POST["stage"];
	$stagiaire->idpartenaire	= $_POST["partenaire"];
	$stagiaire->prenom			= $_POST["prenom"];
	$stagiaire->nom				= $_POST["nom"];
	if ( isset($_POST["sexe"]) ) $stagiaire->sexe = $_POST["sexe"];
	$stagiaire->dcreat			= $_POST["dcreat"];
	$stagiaire->dmodif			= $_POST["dmodif"];

	if ( $_POST['action'] == "UPDATE" ) {
		$stagiaire->id	= $_POST["id"];
		$dao->Update( $stagiaire);
		$message = "Mise a jour effectuée.";
	}
	else if ( $_POST['action'] == "CREATE" ) {
		$dao->Insert( $stagiaire);
		$message = "Fiche créée.";
	}
	$action = "UPDATE";
}	
else									// Création d'un nouveau partenaire
	$action = "CREATE";
?>
<html>
<head>
<title>Plateforme ELSA - Fiche Stagiaire</title>
<?php include( "inc/head.php"); ?>
</head>
<body>
<table width="500" align="center"><tr>
	<td width="80%"><h3><?php echo $stagiaire->prenom . " " . $stagiaire->nom; ?></h3></td>
	<td align="center" style="color:#ff6300" width="20%"><h4>Plateforme<br>ELSA</h4></td>
</tr></table>
<p class="message" align="center"><?php if ( isset($message) ) echo htmlentities( $message); ?></p>
<fieldset style="border:1px #ff6300 solid;">
<form action="fiche_stagiaire.php" method="post" name="stagiaire" onSubmit="javascript:return IsValidStagiaire();">
<input type="hidden" name="action" value="<?php echo $action; ?>">
<input type="hidden" name="id" value="<?php echo $stagiaire->id; ?>">
<input type="hidden" name="dcreat" value="<?php echo $stagiaire->dcreat; ?>">
<input type="hidden" name="dmodif" value="<?php echo $stagiaire->dmodif; ?>">
<p><legend>Identifiant <b><?php echo $stagiaire->id; ?></b> - Création <b><?php echo $date->db2french( $stagiaire->dcreat); ?></b> - Modification <b><?php echo $date->db2french( $stagiaire->dmodif); ?></b></legend></p>
<table width="500" align="center">
<tr>
	<td width="120" align="right"><b>Partenaire : </b></td>
	<td width="380"><?php $partenaireid = $stagiaire->idpartenaire; include( "inc/select_partenaire.php"); ?></td>
</tr>
<tr>
	<td width="120" align="right"><b>Stage : </b></td>
	<td width="380"><?php $stageid = $stagiaire->idstage; include( "inc/select_stage.php"); ?></td>
</tr>
<tr>
	<td align="right">Prénom : </td>
	<td><input type="text" size="50" maxlength="50" name="prenom" value="<?php echo $stagiaire->prenom; ?>"></td>
</tr>
<tr>
	<td align="right"><b>Nom : </b></td>
	<td><input type="text" size="50" maxlength="50" name="nom" value="<?php echo $stagiaire->nom; ?>"></td>
</tr>
<tr>
	<td align="right">Sexe : </td>
	<td>
		<input type="radio" name="sexe" value="M" <?php echo ( $stagiaire->sexe=="M" )?"checked":""; ?>> Masculin 
		<input type="radio" name="sexe" value="F" <?php echo ( $stagiaire->sexe=="F" )?"checked":""; ?>> Féminin	
	</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="Valider">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Re Initialiser">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value="Effacer" onClick="javascript:DeleteStagiaire( '<?php echo $stagiaire->id; ?>');">
	</td>
</tr>
</table>
</form>
</fieldset>
</body>
</html>