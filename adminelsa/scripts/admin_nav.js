/*
 * Procédures JS de l'interface d'administration
 */

// Ouverture d'une pop-up
function OpenUrl( url, width, height) {
	window.open( url, "_blank", "width=" + width + ",height=" + height + ",toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,titlebar=no");
}

// Processus de mise en ligne d'une zone
function Publish( idpage, idzone) {
	if ( confirm( "Vous allez mettre en ligne le contenu de la zone,\nEtes-vous sûr ?") )
		document.location =	"zone.php?idpage=" + idpage + "&idzone=" + idzone + "&publish=TRUE";
}

// Fonction de validation de saisie d'un partenaire
function IsValidPartenaire() {
	if ( document.partenaire.association.value.length==0 || document.partenaire.ppays.value==-1 ) {
		alert( "Vous devez saisir le nom d'une association et choisir un pays.");
		return false;
	}
	else
		return true;
}

// Fonction de validation de saisie d'un stagiaire
function IsValidStagiaire() {
	if ( document.stagiaire.partenaire.value==-1 || document.stagiaire.stage.value==-1 || document.stagiaire.nom.value.length==0 ) {
		alert( "Vous devez choisir un partenaire, un stage et saisir un nom.");
		return false;
	}
	else
		return true;
}

// Fonction de validation de saisie d'un stage
function IsValidStage() {
	if ( document.stage.ptheme.value==-1 || document.stage.annee.value.length==0 ) {
		alert( "Vous devez saisir un thème et une année.");
		return false;
	}
	else
		return true;
}

// Processus de suppression d'un partenaire
function DeletePartenaire( idpartenaire) {
	if ( confirm( "Vous allez supprimer le partenaire courant,\nEtes-vous sûr ?") )
		document.location =	"fiche_partenaire.php?id=" + idpartenaire + "&action=DELETE";
}

// Processus de suppression d'un stagiaire
function DeleteStagiaire( idstagiaire) {
	if ( confirm( "Vous allez supprimer le stagiaire courant,\nEtes-vous sûr ?") )
		document.location =	"fiche_stagiaire.php?id=" + idstagiaire + "&action=DELETE";
}

// Processus de suppression d'un stage
function DeleteStage( idstage) {
	if ( confirm( "Vous allez supprimer le stage courant,\nEtes-vous sûr ?") )
		document.location =	"fiche_stage.php?id=" + idstage + "&action=DELETE";
}

// Processus de suppression d'un fichier
function DeleteFile( dir, fichier) {
	if ( confirm( "Vous allez supprimer le fichier " + fichier + ",\nEtes-vous sûr ?") )
		document.location =	"list_documents.php?dir=" + dir + "&deletefile=" + fichier;
}//Processus de suppression d'un utilisateur extranetfunction DeleteUserExtranet( iduser) {	if ( confirm( "Vous allez supprimer l'utilisateur courant,\nEtes-vous sûr ?") )		document.location =	"form_user.php?id=" + iduser + "&action=DELETE";}