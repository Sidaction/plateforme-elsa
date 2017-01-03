<?php
include( "../inc/init-path.php");
include( "include.mpns2.php");
include( "../inc/include.php");
include( "../inc/init.php");
include( "../inc/check_adminsession.php");
$message = "";
$date = new Date();
$userextra_dao = new CuserExtranetDAO( $dbConn);
$userextra = new CuserExtranet(NULL);
if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'DELETE' ){
	$userextra_dao->Delete( intval($_GET['id']));
		$message = "L'utilisateur a bien été supprim&eacute;.";
}else if(isset($_GET['id'])){
	
	$userextra = $userextra_dao->Get(intval($_GET['id']));
}
else if( isset($_POST['valider'])){
	if ( intval( $_POST['id']) > 0 ) $userextra = $userextra_dao->Get( intval( $_POST['id']));
	$userextra->DoPost();
	if( $userextra->nom == "" || $userextra->prenom == "" || $userextra->email == "" || $userextra->login == "" || $userextra->password == "" ){
		$message = "Les champs en gras sont obligatoires";
	}else{
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$message = "L'email n'est pas correct";	
		}else{
			$userextra_dao->Save( $userextra);
			$message = "L'opération a correctement été effectuée.";
		}
	}
}
?>
<html>
<head>
<title>Plateforme ELSA - Interface d'administration</title>
<?php include( "../inc/head.php"); ?>
</head>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="160" valign="top"><?php include( "../inc/menu.php"); ?></td>
    <td valign="top"><?php include( "../inc/top.php"); ?>
		<p><a href="../index.php">Accueil</a> <a href="list_user.php">&gt; Liste des utilisateurs de l'extranet</a> &gt; Fiche utilisateur</p>
		<span style="color:red;"><?php echo $message; ?></span>
		<fieldset style="border:1px #C3C3C3 solid; width:530px;">
			<legend>Fiche utilisateur<b><?php echo $userextra->id; ?></b> - Cr&eacute;ation <b><?php echo $date->db2french( $userextra->dcreat); ?></b> - Modification <b><?php echo $date->db2french( $userextra->dmodif); ?></b></legend>
			<form method="post" action="form_user.php">
				<input type="hidden" name="id" value="<?php echo $userextra->id; ?>" />
				<input type="hidden" name="dcreat" value="<?php echo $userextra->dcreat; ?>" />
				<input type="hidden" name="dmodif" value="<?php echo $userextra->dmodif; ?>" />
				<input type="hidden" name="idappli" value="1" />
				<input type="hidden" name="idref" value="1" />
				<input type="hidden" name="idprofil" value="1" />
				<input type="hidden" name="idtype" value="1" />
				<input type="hidden" name="isadmin" value="false" />
				<input type="hidden" name="issuperadmin" value="false" />
				<input type="hidden" name="newsletter" value="false" />
				<input type="hidden" name="optin" value="false" />	
				<table width="500">
					<tr>
						<td></td>
						<td>
							<input type="radio" name="isactive" value="true"<?php echo ( $userextra->isactive == "true" )?' checked="checked"':''; ?> /> <b>Actif</b>
							<input type="radio" name="isactive" value="false"<?php echo ( $userextra->isactive != "true" )?' checked="checked"':''; ?> /> <b>Inactif</b>
						</td>
					</tr>
					<tr>
						<td align="right"><b>Nom</b> :</td>
						<td><input type="text" name="nom" value="<?php echo $userextra->nom; ?>" />
					</tr>
					<tr>
						<td align="right"><b>Pr&eacute;nom</b> :</td>
						<td><input type="text" name="prenom" value="<?php echo $userextra->prenom; ?>" />
					</tr>
					<tr>
						<td align="right"><b>Email</b> :</td>
						<td><input type="text" name="email" value="<?php echo $userextra->email; ?>" />
					</tr>
					<tr>
						<td align="right"><b>Identifiant</b> :</td>
						<td><input type="text" name="login" value="<?php echo $userextra->login; ?>" />
					</tr>
					<tr>
						<td align="right"><b>Mot de passe</b> :</td>
						<td><input type="text" name="password" value="<?php echo $userextra->password; ?>" />
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="valider" value="Enregistrer"/>
							<input type="button" name="supprimer" onclick="javascript: DeleteUserExtranet( <?php echo $userextra->id; ?>);" value="Supprimer l'utilisateur"/>
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