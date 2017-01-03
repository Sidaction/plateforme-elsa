/*
 * Procédures Javascript de gestion de l'editeur WYSIWYG
 */

IE  = window.ActiveXObject ? true : false;
MOZ = window.sidebar       ? true : false;

// Initilisation de l'éditeur en fonction du navigateur. (Appel dans le onload du body de l'éditeur)
function iniEditor() {
	if ( IE ) edoc = window.frames['editeur'].document;
	if ( MOZ ) edoc = document.getElementById('editeur').contentDocument;

	if ( !IE && !MOZ ) {
		alert( 'Votre navigateur n\'est pas compatible avec ce système d\'éditeur WYSIWYG !');
		return;
	}

	if ( edoc.designMode != 'On' ) edoc.designMode = 'On';
	if ( !edoc.body )
		setTimeout( 'iniEditor()', 20);
	else
		edoc.body.innerHTML = document.getElementById('editeur_content').value;
}

// Fonction de prise en compte des styles.
function setContent( action, interfac, value) {
	okCommand = true;

	if ( IE ) {
		ewin = window.frames['editeur'];
		edoc = ewin.document;
	}
	else if ( MOZ ) {
		ewin = document.getElementById('editeur').contentWindow;
		edoc = document.getElementById('editeur').contentDocument;
	}

	if ( action == "CreateLinkH" ) {		// Bouton lien hypertext
		action = "CreateLink";
		if ( MOZ ) {
			interfac = false;
			value = prompt( "Saisissez une URL (exemple: http://www.domaine.com):", "http://");
			if ( value == null ) okCommand = false;
		}
	}
	else if ( action == "CreateLink" ) {	// Bouton Lien sur un document
		interfac = false;
		value = prompt( "Saisissez une URL complète d'un document\n(exemple: http://www.domaine.com/doc.pdf):", value);
		if ( value == null ) okCommand = false;
	}
	else if ( action == "InsertImage" ) {	// Bouton insertion d'une image
		interfac = false;
		value = prompt( "Saisissez une URL complète d'une image\n(exemple: http://www.domaine.com/image.jpg):", value);
		if ( value == null ) okCommand = false;
	}

	if ( okCommand ) {
		edoc.execCommand( action, interfac, value);
		ewin.focus();
	}
}

// Récupère le contenu de l'éditeur avant de l'envoyer
function getEditorContent() {
	if ( IE ) edoc = window.frames['editeur'].document;
	if ( MOZ ) edoc = document.getElementById('editeur').contentDocument;
	document.getElementById('editeur_content').value = edoc.body.innerHTML;
	document.editor.submit;
}