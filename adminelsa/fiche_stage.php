<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

if ( !$user_connected->IsSuperAdmin() ) header( "location: index.php");

$message = "";
$date = new Date();

$dao = new StageDAO( $dbConn);
$stage = new Stage( NULL);

if ( isset($_GET['id']) ) {				// On arrive sur la fiche en consultation
	if ( isset($_GET['action']) && $_GET['action'] == "DELETE") {
		$dao->Delete( intval($_GET['id']));
		$stage->id = -1;
		$action = "CREATE";
		$message = "Le stage a bien été effacé.";
	}
	else {
		$action = "UPDATE";
		$stage = $dao->Get( intval($_GET['id']));
	}
}
else if ( isset($_POST['action']) ) {	// Le formulaire a été posté
	$stage->idtheme		= $_POST["ptheme"];
	$stage->annee		= $_POST["annee"];
	$stage->periode		= $_POST["periode"];
	$stage->periode_en	= $_POST["periode_en"];
	$stage->accueil		= $_POST["accueil"];
	$stage->accueil_en	= $_POST["accueil_en"];
	$stage->dcreat		= $_POST["dcreat"];
	$stage->dmodif		= $_POST["dmodif"];

	if ( $_POST['action'] == "UPDATE" ) {
		$stage->id	= $_POST["id"];
		$dao->Update( $stage);
		$message = "Mise a jour effectuée.";
	}
	else if ( $_POST['action'] == "CREATE" ) {
		$dao->Insert( $stage);
		$message = "Fiche créée.";
	}
	$action = "UPDATE";
}	
else									// Création d'un nouveau stage
	$action = "CREATE";
?>
<html>
<head>
<title>Plateforme ELSA - Fiche Stage</title>
<?php include( "inc/head.php"); ?>
</head>
<body>
<table width="500" align="center"><tr>
	<td width="80%"><h3>Stage <?php echo $stage->annee; ?></h3></td>
	<td align="center" style="color:#ff6300" width="20%"><h4>Plateforme<br>ELSA</h4></td>
</tr></table>
<p class="message" align="center"><?php if ( isset($message) ) echo htmlentities( $message); ?></p>
<fieldset style="border:1px #ff6300 solid;">
<form action="fiche_stage.php" method="post" name="stage" onSubmit="javascript:return IsValidStage();">
<input type="hidden" name="action" value="<?php echo $action; ?>">
<input type="hidden" name="id" value="<?php echo $stage->id; ?>">
<input type="hidden" name="dcreat" value="<?php echo $stage->dcreat; ?>">
<input type="hidden" name="dmodif" value="<?php echo $stage->dmodif; ?>">
<p><legend>Identifiant <b><?php echo $stage->id; ?></b> - Création <b><?php echo $date->db2french( $stage->dcreat); ?></b> - Modification <b><?php echo $date->db2french( $stage->dmodif); ?></b></legend></p>
<table width="500" align="center">
<tr>
	<td width="120" align="right"><b>Thème : </b></td>
	<td width="380"><?php $pthemeid = $stage->idtheme; include( "inc/select_ptheme.php"); ?></td>
</tr>
<tr>
	<td width="120" align="right"><b>Année : </b></td>
	<td width="380"><input type="text" size="10" maxlength="4" name="annee" value="<?php echo $stage->annee; ?>"></td>
</tr>
<tr>
	<td width="120" align="right">Période (français) : </td>
	<td width="380"><input type="text" size="50" maxlength="100" name="periode" value="<?php echo $stage->periode; ?>"></td>
</tr>
<tr>
	<td width="120" align="right">Période (anglais) : </td>
	<td width="380"><input type="text" size="50" maxlength="100" name="periode_en" value="<?php echo $stage->periode_en; ?>"></td>
</tr>
<tr>
	<td width="120" align="right">Structure d'accueil (français) : </td>
	<td width="380"><input type="text" size="50" maxlength="200" name="accueil" value="<?php echo $stage->accueil; ?>"></td>
</tr>
<tr>
	<td width="120" align="right">Structure d'accueil (anglais) : </td>
	<td width="380"><input type="text" size="50" maxlength="200" name="accueil_en" value="<?php echo $stage->accueil_en; ?>"></td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="Valider">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="reset" value="Re Initialiser">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="button" value="Effacer" onClick="javascript:DeleteStage( '<?php echo $stage->id; ?>');">
	</td>
</tr>
</table>
</form>
</fieldset>
</body>
</html>