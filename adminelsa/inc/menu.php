<?php
$ppage_dao = new PpageDAO( $dbConn);
$ppage_array = $ppage_dao->GetPagesWithZones();
?>
<p><a href="<?php echo $elsa->URL; ?>" target="_blank">
	<img src="<?php echo $elsa->URL; ?>images/logo.gif" border="0">
</a></p>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr> 
	<td valign="top" align="center" bgcolor="#ff6300">
		<a href="<?php echo $elsa->URL; ?>adminelsa/index.php" class="mheader">ACCUEIL</a>
	</td>
  </tr>
  <tr>
	<td valign="top" class="mtxt" bgcolor="#bdbfb4">
	</td>
  </tr>
  <tr> 
	<td valign="top" class="mheader" align="center" bgcolor="#ff6300">CONTENUS</td>
  </tr>
  <tr> 
	<td valign="top" class="mtxt" bgcolor="#bdbfb4">
<?php if ( isset($user_connected) && $user_connected->IsSuperAdmin() ) { // Paramétrage des stages accessibles uniquement aux Super Admins ?>
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_stages.php">Stages</a><br>
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_stagiaires.php">Stagiaires</a><br>
<?php } ?>
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_partenaires.php">Partenaires</a><br><br>
<?php
for ( $i=0 ; $i<count($ppage_array) ; $i++ ) {
	$cpage = $ppage_array[$i];
?>
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_zone.php?idpage=<?php echo $cpage->id; ?>"><?php echo $cpage->libelle; ?></a><br>
<?php } ?>
	<br></td>
  </tr>
  <tr> 
	<td valign="top" class="mheader" align="center" bgcolor="#ff6300">DOCUMENTS SITE</td>
  </tr>
  <tr>
	<td valign="top" class="mtxt" bgcolor="#bdbfb4">
		<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_documents.php">Téléchargements</a><br><br>
	</td>
  </tr>
   <tr> 
	<td valign="top" class="mheader" align="center" bgcolor="#ff6300">EXTRANET</td>
  </tr>
  <tr>
	<td valign="top" class="mtxt" bgcolor="#bdbfb4">
		<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/userextranet/list_user.php">Gestion des utilisateurs</a><br/>
		<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/userextranet/list_cat.php">Gestion des r&eacute;pertoires</a><br/>
		<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/list_documents_extra.php">Documents</a>
		<br><br>
	</td>
  </tr>
  <tr>
	<td valign="top" class="mheader" align="center" bgcolor="#ff6300">INFOS</td>
  </tr>
  <tr>
	<td valign="top" class="mtxt" bgcolor="#bdbfb4">
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/apropos.php">A propos</a><br>
	<a class="mtxt" href="<?php echo $elsa->URL; ?>adminelsa/phpconfig.php">Configuration PHP</a><br><br>
	PHP V<?php echo phpversion(); ?><br>
	<?php echo $elsa->ToString(); ?>
	<p align="center">
	<?php
	if ( isset($_SESSION['admin_user_connected']) ) {
		echo "<b>" . $_SESSION['admin_user_connected']->ToString() . "</b><br />";
		echo "<b><a href='" . $elsa->URL . "adminelsa/logout.php'>D&eacute;connexion</a></b>";
	}
	?>
	<br /></p>
	</td>
  </tr>
</table>