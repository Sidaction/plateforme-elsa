<?php
include( "inc/init-path.php");
include( "include.mpns.php");
include( "inc/include.php");
include( "inc/init.php");
include( "inc/check_adminsession.php");

// Initilisations
$message = "";
$date = new Date();

$zone_dao = new ZoneDAO( $dbConn);
$zone = new Zone( NULL);

// Traitements
if ( isset($_POST['contenu']) && isset($_POST['idpage']) && isset($_POST['idzone']) ) {
	$idpage = intval($_POST['idpage']);
	$idzone = $_POST['idzone'];
	$isactive = $_POST['isactive'];

	// Sauvegarde de la zone en cours de modification
	$zone_dao->Save( $idpage, $idzone, $_POST['contenu'], $isactive);
	$message = "Le contenu de la zone a bien été enregistré avec l'état EN COURS DE MODIFICATION.";
}
else if ( isset($_GET['idpage']) && isset($_GET['idzone']) ) {
	$idpage = intval($_GET['idpage']);
	$idzone = $_GET['idzone'];

	// Publication de la zone
	if ( isset($_GET['publish']) && $_GET['publish'] == "TRUE" ) {
		$zone_dao->Publish( $idpage, $idzone);
		$message = "La zone a correctement été publiée.";
	}
}
else
	header( "location: index.php");

// Initialisation de la page
$ppage_dao = new PpageDAO( $dbConn);
$ppage = $ppage_dao->Get( $idpage);

// Initialisation de la zone
$zone = $zone_dao->GetZoneForAdmin( $idpage, $idzone);
if ( $zone->etat == "L" )
	$zone_info = "Contenu actuellement en ligne.";
else
	$zone_info = "Contenu actuellement en cours de modification.";
?>
<html>
<head>
<title>Plateforme ELSA - Interface d'administration</title>
<?php include( "inc/head.php"); ?>
<script type="text/javascript" src="scripts/editeur.js"></script>
</head>
<body onLoad="iniEditor();">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="160" valign="top"><?php include( "inc/menu.php"); ?></td>
    <td valign="top"><?php include( "inc/top.php"); ?>

	<p><a href="index.php">Accueil</a> &gt;
	   <a href="list_zone.php?idpage=<?php echo $ppage->id; ?>">Liste des zones de la page <?php echo $ppage->libelle; ?></a> &gt;
		Zone <b><?php echo $zone->libelle; ?></b>
	</p>
	<span class="message" align="center"><?php echo $message; ?></span>
	<form action="zone.php" method="post" name="editor" onSubmit="getEditorContent();">
		<input type="hidden" name="idpage" value="<?php echo $zone->idpage; ?>">
		<input type="hidden" name="idzone" value="<?php echo $zone->idzone; ?>">
      <table width="600" border="0" cellspacing="0" cellpadding="3" bgcolor="#bdbfb4" align="center">
		<tr>
		  <td colspan="2">
		  	<table><tr>
				<td>
			&nbsp;Taille :&nbsp;
		  	<select name="FontSize" onChange="setContent( 'FontSize', false, document.editor.FontSize.value)">
				<option value="2">-1</option>
				<option value="3" selected>0</option>
				<option value="5">+1</option>
		  	</select>
			&nbsp;Couleur :&nbsp;
			<select name="ForeColor" onChange="setContent( 'ForeColor', false, document.editor.ForeColor.value)">
		  		<option value="null">Defaut</option>
				<option value="#000000">Noir</option>
				<option value="#ff6300">Orange</option>
				<option value="#85a422">Vert</option>
		  	</select>
			</td>
			<td>&nbsp;Style :&nbsp;</td>
			<td>
			<img class="ico" src="images/bold.gif"      title="Gras"              alt="Gras"              onclick="setContent('bold', false, null)">
			<img class="ico" src="images/underline.gif" title="Souligner"         alt="Souligner"         onclick="setContent('underline', false, null)">
			<img class="ico" src="images/left.gif"      title="Aligner à gauche"  alt="Aligner à gauche"  onclick="setContent('justifyleft', false, null)">
			<img class="ico" src="images/center.gif"    title="Centrer"           alt="Centrer"           onclick="setContent('justifycenter', false, null)">
			<img class="ico" src="images/right.gif"     title="Aligner à droite"  alt="Aligner à droite"  onclick="setContent('justifyright', false, null)">
			<img class="ico" src="images/pictosAdminLienWeb.gif" 		title="Lien Hypertexte"   alt="Lien Hypertexte"   onclick="setContent('CreateLinkH', true, null)" height="20" width="20">
			<img class="ico" src="images/pictosAdminLienDossier.gif"    title="Lien Document"     alt="Lien Document"     onclick="setContent('CreateLink', true, '<?php echo $elsa->URL . $elsa->DOCS_DIR . "Documents/" ?>')" height="20" width="20">
			<img class="ico" src="images/pictosAdminImage.gif"			title="Insérer une image" alt="Insérer une image" onClick="setContent('InsertImage', true, '<?php echo $elsa->URL . $elsa->DOCS_DIR . "Images/" ?>')" height="20" width="20">
			</td>
			</tr></table>
		  </td>
		</tr>
        <tr>
          <td align="center" colspan="3">
		  	<textarea id="editeur_content" name="contenu" style="display:none;"><?php echo $zone->contenu; ?></textarea>
			<iframe id="editeur" frameborder="1" width="550" height="200" marginheight="2" marginwidth="2"></iframe>
		  </td>
        </tr>
        <tr>
		  <td>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="isactive" value="true" <?php echo ( $zone->isactive=="true" )?"checked":""; ?>> Visible 
			<input type="radio" name="isactive" value="false" <?php echo ( $zone->isactive=="false" )?"checked":""; ?>> Non visible	
          <td align="right" colspan="2">
		  	<input type="submit" name="submit" value="Enregistrer">&nbsp;&nbsp;&nbsp;
		  </td>
        </tr>
      </table>
	  </form>
	  <br>
	  <table width="600" border="0" cellspacing="0" cellpadding="3" bgcolor="#bdbfb4" align="center">
	  	<tr><td colspan="2"><b><?php echo $zone_info; ?></b></td></tr>	
		<tr>
			<td>Date de création : <b><?php echo $date->db2french( $zone->dcreat); ?></b></td>
			<td>Date de modification : <b><?php echo $date->db2french( $zone->dmodif); ?></b></td>
		</tr>
	  	<tr>
			<td>
				<a href="<?php echo $elsa->URL . $ppage->url; ?>?admin=TRUE" target="_blank">Visualiser la version en cours de modification</a><br>
				<a href="<?php echo $elsa->URL . $ppage->url; ?>" target="_blank">Visualiser la version en ligne</a>
			</td>
			<td align="center" valign="middle">
				<input type="button" value="Mettre en ligne" OnClick="javascript:Publish( '<?php echo $zone->idpage; ?>', '<?php echo $zone->idzone; ?>');">
			</td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>