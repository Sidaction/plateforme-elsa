<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

$dao = new PartenaireDAO( $dbConn);

if ( isset($_POST['ppays']) )
	$ppaysid = $_POST['ppays'];
else
	$ppaysid = -1;

$partenaires_array = $dao->GetPartenairesForAdmin( $ppaysid);
$table = new HTMLTableVue(	"generic", $partenaires_array,
			array( "ID", "Association", "Pays", "Contact", "Actif", "&nbsp;"),
			array( "idcol", "tdata", "tdata", "tdata", "tcdata", "tcdata"),
			array( "", "", "", "", "",
					"<input type=\"button\" class=\"button\" value=\"Modif.\" onClick=\"javascript:OpenUrl( 'fiche_partenaire.php?id=[0]', 550, 700);\">"
				)
			);
$nb_partenaires = $dao->GetNbPartenaires( $ppaysid);
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
		<p><a href="index.php">Accueil</a> &gt; Liste des partenaires</p>
		<p>
		<form action="list_partenaires.php" method="post" name="ppays">
		<table width="800"><tr>
			<td><?php include( "inc/select_ppays.php"); ?>&nbsp;&nbsp; <?php echo $nb_partenaires; ?> partenaire(s)</td>
			<td align="right">
				<input class="button" type="button" value="Rafraîchir" onClick="javascript:window.location.reload(false);">
				&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="bbutton" type="button" value="Nouveau" onClick="javascript:OpenUrl( 'fiche_partenaire.php', 550, 700);">
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