/*
 * Procédures JS de l'interface d'administration
 */

function DeleteParam( idcat){
	if ( confirm( "Vous allez supprimer le répertoire courant.\nLes documents ne seront plus accessibles\nEtes-vous sûr ?") )
		document.location =	"form_cat.php?id=" + idcat + "&action=DELETE";
}