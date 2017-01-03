<?php
include( "../inc/init-path.php");
include( "include.mpns2.php");
include( "../inc/include.php");
include( "../inc/init.php");
include( "../inc/check_adminsession.php");

$userextra_dao = new CuserExtranetDAO( $dbConn);
if( isset($_GET['id']) && isset($_GET['action'])){
	$userextra = new CuserExtranet(NULL);
	$userextra = $userextra_dao->Get(intval($_GET['id']));
	if($_GET['action'] == "activer") $userextra->isactive = "true";
	else $userextra->isactive = "false";
	$userextra_dao->Save( $userextra);
}
$userextra_array = $userextra_dao->GetCuser( -1, -1, -1, -1, "", "", "", "", "id <> 1");
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
		<p><a href="../index.php">Accueil</a> &gt; Liste des utilisateurs de l'extranet</p>
		<a href="form_user.php">&gt; Ajouter un utilisateur</a>
		<p>
		<table border="1">
			<tr class="header">
				<th>Nom</th>
				<th>Pr&eacute;nom</th>
				<th>Login</th>
				<th>Mail</th>
				<th>Actif</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			<?php for($i=0; $i<count($userextra_array); $i++){ ?>
				<tr>
					<td><?php echo $userextra_array[$i]->nom; ?></td>
					<td><?php echo $userextra_array[$i]->prenom; ?></td>
					<td><?php echo $userextra_array[$i]->login; ?></td>
					<td><?php echo $userextra_array[$i]->email; ?></td>
					<td>
						<?php if( $userextra_array[$i]->isactive == "true") echo "X"; else echo ""; ?>
					</td>
					<td>
						<a href="form_user.php?id=<?php echo $userextra_array[$i]->id; ?>">Modifier</a>
					</td>
					<td>
						<?php if( $userextra_array[$i]->isactive == "true") echo "<a href='list_user.php?id=".$userextra_array[$i]->id."&action=desactiver'>D&eacute;sactiver</a>"; else echo "<a href='list_user.php?id=".$userextra_array[$i]->id."&action=activer'>Activer</a>"; ?>
					</td>
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