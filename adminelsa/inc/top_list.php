<?
/*
 *		TRAITEMENTS GENERIQUES POUR LA NAVIGATION DANS LES LISTES
 *			Cf. bottom_list.php
 * Contraintes de fonctionnement : Les variables suivantes doivent être initialisées dans la page appelante
 * $page, doit être un paramètre _POST
 * $nbi: Nombre d'éléments de la liste	
 */

// Initialisation de la page courante si ce n'est pas déjà fait dans la page courante
if ( !isset($page) )
	if ( !isset($_POST['page']) ) $page = 1; else $page = intval( $_POST['page']);

// Initialisation du nombre total de résultats
$nb_pages = ceil( $total / $nbi );	// Arrondi a l'entier superieur

// Initialisation du début du LIMIT
$debut = ( $page - 1 ) * $nbi;
?>