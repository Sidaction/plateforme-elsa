<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

if ( !$user_connected->IsSuperAdmin() ) header( "location: index.php");

$dao = new StageDAO( $dbConn);

if ( isset($_POST['annee']) )
	$cannee = $_POST['annee'];
else
	$cannee = -1;

$stages_array = $dao->GetStages( $cannee, -1);
$table = new HTMLTableVue(	"generic", $stages_array,
			array( "ID", "Thème", "Année", "Structure d'accueil", "Période", "&nbsp;"),
			array( "idcol", "tdata", "tcdata", "tdata", "tdata", "tcdata"),
			array( "", "", "", "", "",
			"<input type=\"button\" class=\"button\" value=\"Modif.\" onClick=\"javascript:OpenUrl( 'fiche_stage.php?id=[0]', 550, 500);\">"
				)
			);
$nb_stages = $dao->GetNbStages( $cannee, -1);
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

	<p><a href="index.php">Accueil</a> &gt; Liste des stages</p>
	<p>
	<form action="list_stages.php" method="post" name="stage">
	<table width="800"><tr>
		<td><?php include( "inc/select_stage-annee.php"); ?>&nbsp;&nbsp; <?php echo $nb_stages; ?> stage(s)</td>
		<td align="right">
			<input class="button" type="button" value="Rafraîchir" onClick="javascript:window.location.reload(false);">
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input class="bbutton" type="button" value="Nouveau" onClick="javascript:OpenUrl( 'fiche_stage.php', 550, 500);">
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