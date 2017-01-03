<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page formulaire de soumission d'un document
 Template Name: Formulaire de soumission de document
 //////////////////////////////////////////////////////////////*/
 require('__core/classes/soumettre.php' );
 $doc = new doc();
 $args=$doc->get_args();	
 get_header(); 
 
  ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="marron soumettre">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Soumettre une ressource</a></div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        
   
    
    
    			<div id="titleSoum"><?php the_title();?></div>
                <div class="clear"></div>
                <div id="SoumTxt"><?php the_content();?></div>
    
                <div class="txtListe">
					<?php if($args['alert']=='missingfields') : ?>           
                    <h2>Désolé</h2>
                    <p class="msgalert">Des champs obligatoires sont manquants</p>
                    <?php endif; ?>
                    <?php if($args['step']=='validregister') : ?>           
                    <h2>Merci</h2>
                    <p class="msgalert">Votre document a été suggéré. <br />
                    <?php endif; ?>
                </div>
           
           
           
            <?php if($args['step']!='validregister') : ?>   
            
              <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
              <style>

  .ui-tooltip {
    font: normal 15px "Dosis", Sans-Serif;

  }
  
  </style>
             <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                    <script type="text/javascript">
					jQuery(document).ready(function(e) {
					var tooltips = $( "#contact [title]" ).tooltip();
					
					})
					</script>

            
            <form  method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="contact" >
                <div class="soumLabel"><label>Format</label></div><div class="soumForm"><?php  cnLib::custom_taxonomy_dropdown('format','selectBox','Sélectionnez','',$args['format'],false);?><span class="infobulle" title="Précisez ici s’il s’agit d’une ressource de type document, site internet, diaporama, vidéo ou fichier audio.">?</span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Télécharger la source</label></div><div class="soumForm"><input type="file" name="doc_source" id="label" /><br /><span>Merci de compresser le document ou utiliser un site transfert </span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>S'il s'agit d'un lien, indiquez le lien </label></div><div class="soumForm"><input type="text" id="link" name="link" value="<?php echo $args['link']; ?>"></div>
                <div class="clear"></div>
                
                <hr class="shadowBottom">
                
                <div class="soumLabel"><label>Titre de la ressource</label></div><div class="soumForm"><input type="text" id="title" name="title" value="<?php echo $args['title']; ?>"><span class="infobulle" title="Saisissez le titre exactement tel qu’il est sur la ressource (en respectant les majuscules, les accents…). S’il n’y a pas de titre à votre ressource, proposez-en un le plus fidèle possible au contenu.">?</span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Description de la ressource</label></div><div class="soumForm"><textarea name="desc" id="desc"><?php echo $args['desc']; ?></textarea><span class="infobulle" title="Décrivez votre ressource en quelques lignes. De quel type de ressource s’agit-il ? quel est le sujet ? le public ciblé ? pour quel.s usage.s ?... n’oubliez pas d’indiquer la période sur laquelle porte la ressource.">?</span><br /><span>1 000 caractères max</span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Visuel associé</label></div><div class="soumForm"><input type="file" name="image_file" id="image_file" /><br /><span>Merci de compresser le document ou utiliser un site transfert </span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Date d'édition</label></div><div class="soumForm"><input type="text" id="date-start" name="date-start" value="<?php echo $args['date-start']; ?>"><span class="infobulle" title="La date d’édition est la date à laquelle la ressource a été créée (et diffusée). A ne pas confondre avec la période sur laquelle porte le sujet. Exemple : un rapport sur la prise en charge des OEV à Ouagadougou entre 2000 et 2010 (période) qui a été publié en 2012 (date d’édition).">?</span><br /><span>mm/aaaa ou année seule</span></div>
                <div class="clear"></div>
                
                <hr class="shadowBottom">
                
                <div class="soumLabel"><label>Organisme associé</label></div><div class="soumForm listeDer"><?php cnLib::custom_post_inputlist( "structure", "organisme", $args['organisme']); ?></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Auteurs</label></div><div class="soumForm"><input type="text" id="auteur" name="auteur" value="<?php echo $args['auteur']; ?>"><span class="infobulle" title="L’auteur.e renvoie à deux rubriques : ce peut être un organisme (associatif ou non) et/ou une personne physique (nominative). Pour chaque rubrique, vous pouvez saisir plusieurs auteur.e.s s’il s’agit d’un ouvrage collectif.">?</span></div>
                <div class="clear"></div>
                
                <hr class="shadowBottom">
                
                <div class="soumLabel"><label>Thématique</label></div><div class="soumForm"><?php  cnLib::custom_taxonomy_dropdown('category','selectBox','Sélectionnez','',$args['category'],false);?><span class="infobulle" title="Vous pouvez référencer la ressource dans une ou plusieurs thématiques et avec un ou plusieurs mots-clés, en fonction de son contenu. Ces choix seront intégrés par le moteur de recherche.">?</span></div>
                <div class="clear"></div>
                <div class="soumLabel"><label>Mots clés</label></div><div class="soumForm listeDer"><?php cnLib::custom_taxonomy_inputlist( "post_tag", "post_tag", $args['post_tag']); ?></div><span class="infobulle" title="Vous pouvez référencer la ressource dans une ou plusieurs thématiques et avec un ou plusieurs mots-clés, en fonction de son contenu. Ces choix seront intégrés par le moteur de recherche.">?</span>
                <div class="clear"></div>
                <div class="soumLabel"><label>Zone géographique</label></div><div class="soumForm listeDer"><?php cnLib::custom_taxonomy_inputlist( "pays_assoc", "pays_assoc", $args['pays_assoc']); ?></div><span class="infobulle" title="Vous devez référencer la ressource selon les zones géographiques, en fonction de son contenu. Exemple : Sénégal, Guinée, Afrique de l’Ouest.">?</span>
                <div class="clear"></div>
                
                <hr class="shadowBottom">
                 <div class="soumLabel"><label>Nom</label></div><div class="soumForm"><input type="text" id="contname" name="contname" value="<?php echo $args['contname']; ?>"></div>
                 <div class="clear"></div>
                   <div class="soumLabel"><label>Prénom</label></div><div class="soumForm"><input type="text" id="contfirtname" name="contfirtname" value="<?php echo $args['contfirtname']; ?>"></div>
                   <div class="clear"></div>
                   <div class="soumLabel"><label>Email</label></div><div class="soumForm"><input type="text" id="contemail" name="contemail" value="<?php echo $args['contemail']; ?>"></div>
                   <div class="clear"></div>
                   <div class="soumLabel"><label>Confirmation de l'email</label></div><div class="soumForm"><input type="text" id="contemail2" name="contemail2" value="<?php echo $args['contemail2']; ?>"></div>
                   <div class="clear"></div>
                   <div class="soumLabel"><label>Association</label></div><div class="soumForm"><input type="text" id="contassoc" name="contassoc" value="<?php echo $args['contassoc']; ?>"></div>
                   <div class="clear"></div>
                   <div class="soumLabel"><label></label></div><div class="soumForm"><input type="checkbox" id="rappeler" name="rappeler" value="oui"> 
                   J'ai pris connaisssance des <a href="/conditions-generales-dutilisation/" target="_blank">conditions générales d'utilisation</a></div>
                  <div class="clear"></div>
                    <div class="soumLabel"><label></label></div><div class="soumForm">Afin d'éviter les spams, merci de nous indiquer combien font 2+2<br />
<input type="text" id="check" name="check" ></div>
                   <div class="clear"></div>
                <input type="hidden" name="step" value="register" id="step"/>
                <input type="hidden" name="checknc" value="<?php echo wp_create_nonce( 'my-nonce' );?>" />
                   <div style="display:none"><label for="name">Name (mandatory)* :</label><input type="text" id="name" name="name" value="<?php echo $args['name'];?>"></div>
            
            <div class="soumLabel"></div><div class="soumForm"><button class="soumettreRess">Soumettre</button></div>
            
            </form>
            
            
            
                <script src="<?php echo $cnSite->templatelink; ?>/_js/jquery.validate.min.js"></script>
    <script>
			jQuery(document).ready(function(e) {	
			
			
				  /* VALIDATE */
	  jQuery("#contact").validate({
				rules: {
					contname: "required",
					contfirtname: "required",
					title: "required",
					desc: "required",
					contemail: {
					  required: true,
					  email: true
					},
					contemail2: {
					  required: true,
					  equalTo: "#contemail",
					},
					check: {
					  required: true,
					   range:[4,4]
					},

					
					
			}
		});
	  
	  jQuery.extend(jQuery.validator.messages, {
		  	minlength: 'Merci de saisir un numéro à 10 chiffres',
			maxlength: 'Merci de saisir un numéro à 10 chiffres',
			number: 'Merci de saisir un numéro à 10 chiffres',
		  	required: 'Ce champ est obligatoire',
			range: 'Merci de renseigner le chiffre exact ( = 4)',
		    email: 'Merci de renseigner un mail valide',
			equalTo: 'Merci de saisir le même email'
	
		});
	  /* VALIDATE */
			
			
	
				
			
				
				
				
			
				
			})
		</script>
              <?php endif; ?>
        <div id="sharebottom">
			<?php $cnSite->share_links();?>
        </div>
        <div class="clear"></div>
        
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>