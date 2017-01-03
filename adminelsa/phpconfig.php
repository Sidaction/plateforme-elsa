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
		<p><a href="index.php">Accueil</a> &gt; Configuration PHP</p>
      	<iframe src="phpinfo.php" width="800" height="1000" marginwidth="1" marginheight="1" hspace="0" vspace="0" frameborder="0" border="0" scrolling="auto" name="phpinfo"></iframe>
	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>