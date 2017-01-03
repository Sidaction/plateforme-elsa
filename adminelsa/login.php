<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");

$logmess = "";

if ( isset($_POST['email']) && isset($_POST['password']) ) {
	$auth = $elsa->AuthenticateAdminUser( $_POST['email'], $_POST['password'], $dbConn);
	if ( $auth == 0 )
			header( "location: index.php");
	else {
		if ( $auth == 1 )
			$logmess = "Mot de passe incorrect !";
		else if ( $auth == 2 )
			$logmess = "Login incorrect !";
		else
			$logmess = "Problème de connexion !";
	}
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

	<p align="center" class="message"><b>&nbsp;<?php echo $logmess; ?></b></p>
	<form action="login.php" method="post">
      <table width="300" border="0" cellspacing="0" cellpadding="3" bgcolor="#bdbfb4" align="center">
        <tr>
          <td align="right"><b>LOGIN :</b></td>
          <td><input type="text" name="email"></td>
        </tr>
        <tr>
          <td align="right"><b>PASSWORD :</b></td>
          <td><input type="password" name="password"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="submit" value="Se connecter"></td>
        </tr>
      </table>
	  </form>

	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>