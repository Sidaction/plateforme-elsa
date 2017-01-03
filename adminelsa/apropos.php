<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");
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
		<p><a href="index.php">Accueil</a> &gt; A propos</p>

		<p>
		<strong>Version PHP : </strong><?php echo phpversion(); ?><br>
		<strong>Version ELSA : </strong><?php echo $elsa->ToString(); ?><br>
		<strong>URL ELSA : </strong><a href="<?php echo $elsa->URL; ?>"><?php echo $elsa->URL; ?></a><br>
		<strong>Configuration PHP : </strong><a href="phpconfig.php">PHP Config</a><br>
		</p>

	<p><strong>Variables Globales</strong></p>
	
	<table width="750" border="1" cellspacing="0" cellpadding="1">
	  <tr> 
		<td>Mot de passe administrateur</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->ADMIN_PASSWORD; ?></td>
	  </tr>
 	  <tr> 
		<td>Adresse E-mail administrateur</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->ADMIN_EMAIL; ?></td>
	  </tr>
 	  <tr> 
		<td>Répertoire contenant les documents</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->URL . $elsa->DOCS_DIR; ?></td>
	  </tr>
	  <tr> 
		<td colspan="2"><em><b>Base de donn&eacute;es</b></em></td>
	  </tr>
	  <tr> 
		<td>Serveur</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->DB_SERVER; ?></td>
	  </tr>
	  <tr> 
		<td>Nom de la base</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->DB_NAME; ?></td>
	  </tr>
	  <tr> 
		<td>Compte de connexion</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->DB_USER; ?></td>
	  </tr>
	  <tr> 
		<td>Mot de passe</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->DB_PASSWORD; ?></td>
	  </tr>
	  <tr> 
		<td>Administrateur</td>
		<td bgcolor="#CCCCCC"><?php echo $elsa->DB_ADMINMAIL; ?></td>
	  </tr>
	</table>

	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>