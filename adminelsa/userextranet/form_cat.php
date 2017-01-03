<?php
include( "../inc/init-path.php");
include( "include.mpns2.php");
include( "../inc/include.php");
include( "../inc/init.php");
include( "../inc/check_adminsession.php");
$message = "";

$param_dao = new ParamDAO( $dbConn, "pcdocs");
$param = new Param( NULL);

if ( isset($_GET['id']) ) {				// On arrive sur la fiche en consultation
	if ( isset($_GET['action']) && $_GET['action'] == "DELETE") {
		$param_dao->Delete( intval($_GET['id']));
		$param->id = -1;
		$message = "Répertoire effacé.";
	}
	else
		$param = $param_dao->Get( intval($_GET['id']));
}
else if ( isset($_POST['id']) ) {	// Le formulaire a été posté
	// 0.1. On charge la version courante si mode UPDATE
	if ( intval( $_POST['id']) > 0 ) $param = $param_dao->Get( intval( $_POST['id']));
	
	// 0.2. Chargement du formulaire posté
	$param->DoPost();
	if( $param->idref == -1) $param->idref = NULL;
	if ( $param->libelle == "" )
		$message = "Vous devez saisir un libellé !";
	else if ( $param->id>0 && $param->id== $param->idref )
		$message = "Vous devez choisir un autre répertoire !";
	else {
		$param_dao->Save( $param);
		$message = "L'opération a correctement été effectuée.";
	}
}

// Liste des catégories
$param_dao  = new ParamDAO( $dbConn, "pcdocs");
$cat_array  = $param_dao->GetAllParamList();
$select_cat = new HTMLSelectVue( "idref", $cat_array);
$select_cat->option_choice_lib = "- Choisir un répertoire -";
?>
<html>
<head>
<title>Plateforme ELSA - Interface d'administration</title>
<?php include( "../inc/head.php"); ?>
<script language="JavaScript" src="<?php echo $elsa->URL; ?>adminelsa/scripts/admin_extranet.js" type="text/javascript"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="160" valign="top"><?php include( "../inc/menu.php"); ?></td>
    <td valign="top"><?php include( "../inc/top.php"); ?>
		<p><a href="../index.php">Accueil</a> <a href="list_cat.php">&gt; Liste des r&eacute;pertoires</a> &gt; Fiche r&eacute;pertoire</p>
		<span style="color:red;"><?php echo $message; ?></span>
		<fieldset style="border:1px #000000 solid;width:400px;">
			<legend>Identifiant <b><?php echo $param->id; ?></b></legend>
			<form action="form_cat.php" method="post" name="param">
				<input type="hidden" name="id" value="<?php echo $param->id; ?>">
				<table width="500" align="center">
					<tr>
						<td align="right">Cat&eacute;gorie parente : </td>
						<td><?php $select_cat->EchoHTMLSelect( $param->idref, true); ?></td>
					</tr>
					<tr>
						<td align="right"><b>Libell&eacute; : </b></td>
						<td><input type="text" size="50" maxlength="255" name="libelle" value="<?php echo $param->libelle; ?>"></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" class="bbutton" value="Enregistrer la fiche" />&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" class="button" value="Supprimer la fiche" onClick="javascript:DeleteParam( '<?php echo $param->id; ?>');" />
						</td>
					</tr>
				</table>
			</form>
		</fieldset>	
	
		
		
	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>