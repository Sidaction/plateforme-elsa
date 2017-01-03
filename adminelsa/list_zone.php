<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

if ( isset($_GET['idpage']) ) {
	$idpage = intval($_GET['idpage']);

	// Initialisation de la page
	$ppage_dao = new PpageDAO( $dbConn);
	$ppage = $ppage_dao->Get( $idpage);

	// Récupération de la liste des zones
	$table = new ZoneListHTMLTable( "generic", $idpage, $dbConn);
	$table_str = $table->GetHTMLTable();
}
else {
	header( "location: index.php");
	exit;
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
		<p><a href="index.php">Accueil</a> &gt; Liste des zones de la page <b><?php echo $ppage->libelle; ?></b></p>
		<?php echo $table_str; ?>
	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>