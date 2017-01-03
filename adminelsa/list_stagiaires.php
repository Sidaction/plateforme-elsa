<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

if ( !$user_connected->IsSuperAdmin() ) header( "location: index.php");

$dao = new StagiaireDAO( $dbConn);

if ( isset($_POST['ptheme']) )
	$idtheme = intval($_POST['ptheme']);
else
	$idtheme = -1;

$stagiaires_array = $dao->GetStagiaires( -1, $idtheme);
$table = new HTMLTableVue(	"generic", $stagiaires_array,
							array( "ID", "Stagiaire", "Association", "Thème", "Année", "Période", "&nbsp;"),
							array( "idcol", "tdata", "tdata", "tdata", "tcdata", "tdata", "tcdata"),
							array( "", "", "", "", "", "",
								"<input type=\"button\" class=\"button\" value=\"Modif.\" onClick=\"javascript:OpenUrl( 'fiche_stagiaire.php?id=[0]', 550, 500);\">"
								)
							);
$nb_stagiaires = $dao->GetNbStagiaires( -1, $idtheme);
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

	<p><a href="index.php">Accueil</a> &gt; Liste des stagiaires</p>
	<p>
	<form action="list_stagiaires.php" method="post" name="theme">
	<table width="900"><tr>
		<td><?php $pthemeid = $idtheme; include( "inc/select_ptheme.php"); ?>&nbsp;&nbsp; <?php echo $nb_stagiaires; ?> stagiaire(s)</td>
		<td align="right">
			<input class="button" type="button" value="Rafraîchir" onClick="javascript:window.location.reload(false);">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input class="bbutton" type="button" value="Nouveau" onClick="javascript:OpenUrl( 'fiche_stagiaire.php', 550, 500);">
		</td>
	</tr></table>
	</form>
	</p>
	<?php $table->EchoHTMLTable(); ?>

	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>