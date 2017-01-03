<?php 

/*///////////////////////////////////////////////////////////////

 Plateforme Elsa by Clair et Net. / www.clair-et-net.com

 Page Contact

 Template Name: Page contact

 //////////////////////////////////////////////////////////////*/

 require('__core/classes/contact.php' );	

$contact = new contact(array('info@plateforme-elsa.org'), 'contact');

$args=$contact->get_args();



 

 get_header(); ?>

 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<section id="contentSite" class="orange">

	<div id="breadcrumb">

    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Plateforme Elsa</a> » <a href="#">Qui sommes-nous ?</a></div>

    </div>

     <div id="contentWrapper">

     	<div class="shadowLeft"></div>

        <div class="shadowRight"></div>

        <article>

        <h1><?php the_title();?></h1>

<?php if($args['step']=='valid') { ?><p>Merci votre message a bien été pris en compte</p>

<?php }else{?>

          <form id="contact" method="post">

          <div class="blockForm">

                <div class="formLine"><label for="nom">Nom :</label><br /><input type="text" id="nom" name="nom"/></div><div class="clear"></div>

                <div class="formLine"><label for="prenom">Prénom :</label><br /><input type="text" id="prenom"  name="prenom"/></div><div class="clear"></div>

          </div>

          <div class="blockForm">

                <div class="formLine"><label for="email">E-mail *:</label><br /><input type="text" id="email" name="email" /></div><div class="clear"></div>

                <div class="formLine"><label for="conf">Confirmation E-mail *:</label><br /><input type="text" name="email2" /></div><div class="clear"></div>

          </div>

          <div class="clear"></div>

            <div class="formLine"><label>Sujet *:</label><br />

            <select class="selectBox" name="sujet">

            	<option>Choisir un sujet</option>

                <option value="Signaler un lien cassé">Signaler un lien cassé</option>

                <option value="Remarque générale sur le centre de ressources">Remarque générale sur le centre de ressources</option>

                <option value="Proposer un événement">Proposer un événement</option>

                <option value="Donner des infos sur un pays">Donner des infos sur un pays</option>

                <option value="ignaler une actualité">Signaler une actualité</option>

                <option value="Problème technique">Problème technique</option>

                <option value="Autres">Autres</option>

            </select></div><div class="clear"></div>

            <div class="formLine"><label for="message">Votre message *:</label><br /><textarea name="message"></textarea></div><div class="clear"></div>

            <div class="formLine"><input type="checkbox" name="copie" value="ok" /><label for="copie" class="copie">Recevoir une copie de ce mail</label></div><div class="clear"></div>

              <div class="clear"></div>

                    <div class="soumLabel"><label></label></div><div class="soumForm">Afin d'éviter les spams, merci de nous indiquer combien font 2+2<br />

<input type="text" id="check" name="check" ></div>

            <div style="display:none"><label for="name">Name* :</label><input type="text" id="name" name="name"></div>

             <input type="hidden" name="checknc" value="<?php echo wp_create_nonce( 'my-nonce' );?>" />

             <input type="hidden" name="step" value="subscribe" />





            <div class="formLine"><button>Envoyer</button></div>

          </form>

          <?php } ?>



          <div class="clear"></div>

          <div id="adElsa"><?php the_content();?></div>

           <div id="mapElsa"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.020566929759!2d2.3925332999999878!3d48.85781819999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66d8baadc7c2b%3A0xabd6feff9833ff1e!2s190+Boulevard+de+Charonne!5e0!3m2!1sfr!2sfr!4v1394794421430" width="390" height="300" frameborder="0" style="border:0"></iframe></div>

          <div class="clear"></div>  

          

        </article>

        

         <script src="<?php echo $cnSite->templatelink; ?>/_js/jquery.validate.min.js"></script>

    <script>

			jQuery(document).ready(function(e) {	

			

			

				  /* VALIDATE */

	  jQuery("#contact").validate({

				rules: {

					sujet: "required",

					message: "required",

					email: {

					  required: true,

					  email: true

					},

					email2: {

					  required: true,

					  equalTo: "#email",

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

        

        <?php get_sidebar(); ?>

     </div>

</section>

<?php endwhile; ?>

<?php get_footer(); ?>