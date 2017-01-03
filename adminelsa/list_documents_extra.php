<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

$message = "";

// Initialisation du répertoire de travail
if ( isset($_GET['dir']) ) {
	$dir = $_GET['dir'];
}
else if ( isset($_POST['dir']) ) {
	$dir = $_POST['dir'];
}
else
	$dir = $elsa->DOCS_DIR_EXTRA;

$up_nav = ( $dir != $elsa->DOCS_DIR_EXTRA);

if ( isset($_GET['deletefile']) ) {
	$delete_file = $dir . $_GET['deletefile'];
	if ( file_exists($delete_file) ) {
		unlink($delete_file);
		$message = "Le fichier $delete_file a bien été supprimé.";
	}
}

if ( isset($_FILES['fichier']) ) {
	$fuploader = new FileUploader( "fichier", $dir);
	$return = $fuploader->Upload();
	if ( $return == 0 )
		$message = "Le fichier a bien été envoyé.";
	else if ( $return == 1 )
		$message = "Problème survenu lors de l'envoi du fichier : " . $fuploader->GetErrorMessage();
	else if ( $return == 2 )
		$message = "Problème survenu lors de la copie du fichier : " . $fuploader->GetErrorMessage();
	else
		$message = $fuploader->GetErrorMessage();
}
?>
<html>
<head>
<title>Plateforme ELSA - Interface d'administration</title>
<?php include( "inc/head.php"); ?>
</head>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="160" valign="top"><?php include( "inc/menu.php"); ?></td>
    <td valign="top"><?php include( "inc/top.php"); ?>

	<p><a href="index.php">Accueil</a>
	<?php if ( $up_nav ) { ?>
		&gt; <a href="list_documents.php">Liste des documents du répertoire <?php echo "../".$elsa->DOCS_DIR; ?></a>
	<?php } ?>
	&gt; Liste des documents du répertoire <b><?php echo $dir; ?></b></p>
	<p class="message"><?php echo $message; ?></p>
<?php
if ( is_dir($dir) ) {
   if ( $handle = opendir($dir) ) {
?>
	<table id="generic" width="70%">
	  <tr class="header"> 
		<td>Nom</td>
		<td>Taille (octets)</td>
		<td>Création</td>
		<td>Modification</td>
		<td>Dernier Accès</td>
		<td>&nbsp;</td>
	  </tr>
<?php
   while ( ($file = readdir($handle)) !== false ) {
		if ( is_file($dir.$file) ) {
			echo "	<tr>\n";
			echo "		<td class=tdata><a href=\"" . $elsa->URL . "extranet/Docs/Documents/" . $file . "\" target=\"_blank\">" . $file . "</a></td>\n";
			echo "		<td class=tdata>" . filesize($dir.$file) . "</td>\n";
			echo "		<td class=tcdata>" . date("d/m/Y H:i:s",filectime($dir.$file)) . "</td>\n";
			echo "		<td class=tcdata>" . date("d/m/Y H:i:s",filemtime($dir.$file)) . "</td>\n";
			echo "		<td class=tcdata>" . date("d/m/Y H:i:s",fileatime($dir.$file)) . "</td>\n";
			echo "		<td class=tcdata><input type=button class=button value=\"Suppr.\" onClick=\"javascript:DeleteFile( '" . $dir . "', '" . $file . "');\"></td>\n";
			echo "	</tr>\n";
		}
		else if ( is_dir($dir.$file) && $file!="." && $file!=".." ) {
			echo "	<tr>\n";
			echo "		<td colspan=6 class=tdata><a href=\"list_documents.php?dir=" . $dir . $file . "/\">" . $file . "</a></td>\n";
			echo "	</tr>\n";
		}
   }
   closedir($handle);
} }
?>
	</table>
	  <p>Envoyer un fichier dans le r&eacute;pertoire <b><?php echo $dir; ?></b><br>
        <u>Recommandations</u> : Ne pas utiliser d'espace et d'accent dans le nom du fichier</p>
	<form method="post" name="envoifichier" enctype="multipart/form-data" action="list_documents.php">
		<input type="hidden" name="dir" value="<?php echo $dir; ?>">
		<input type="file" name="fichier"><br>
		<input type="submit" value="Envoyer">
	</form>

	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>