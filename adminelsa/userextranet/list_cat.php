<?php
include( "../inc/init-path.php");
include( "include.mpns2.php");
include( "../inc/include.php");
include( "../inc/init.php");
include( "../inc/check_adminsession.php");

// Liste des catégories
$param_dao = new ParamDAO( $dbConn, "pcdocs");
$cat_array = NULL;
$param_dao->GetAllParam( -1, 0, $cat_array);
$nb_cat = sizeof( $cat_array);


?>
<html>
<head>
<title>Plateforme ELSA - Interface d'administration</title>
<?php include( "../inc/head.php"); ?>
</head>
<body>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="160" valign="top"><?php include( "../inc/menu.php"); ?></td>
    <td valign="top"><?php include( "../inc/top.php"); ?>
		<p><a href="../index.php">Accueil</a> &gt; Liste des répertoires de l'extranet</p>
		<a href="form_cat.php">&gt; Ajouter un r&eacute;pertoire</a>
		<p>
		<table border="1">
			<tr class="header">
				<th>Libelle</th>
				<th>&nbsp;</th>
			</tr>
			<?php for($i=0; $i<$nb_cat; $i++){ ?>
				<tr>
					<td class="tdata"><?php echo $cat_array[$i]->libelle; ?></td>
					<td class="tcdata"><a href="form_cat.php?id=<?php echo $cat_array[$i]->id; ?>">Modifier</a></td>
				</tr>
			<?php }?>
		</table>
		</p>
		
	</td>
  </tr>
</table>
<p>&nbsp; </p>
</body>
</html>