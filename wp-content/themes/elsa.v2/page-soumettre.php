<?php 

/*
 * Page formulaire de soumission d'un document
 * Template Name: Formulaire de soumission de document
 */


 require('__core/classes/soumettre.php' );
 $doc = new doc();
 $args = $doc->get_args();  

 get_header(); 

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <section id="site-content" class="site-content page">

    <article class="main-content clearfix noback">

      <div class="page_title static_title">
          <div class="wrap row">
              <h1 class="h1 m-6col is-centered text-on-center">
                  <?php the_title();?>
              </h1>  
          </div>     
      </div>

      <div class="page_content clearfix">
        <div class="wrap row">

          <nav class="m-2col page_sidebar">
              <?php the_field('sidebar_content') ?>
          </nav>

          <div class="m-5col m-last">
              <?php the_content();?>

    
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
               
           
           
              <?php if($args['step'] != 'validregister') : ?>   
                        
                <script type="text/javascript">
                  // jQuery(document).ready(function(e) {
                  //   var tooltips = $( "#contact [title]" ).tooltip();
                  // })
                </script>

                        
                <div class="row">

                  <div class="m-4col m-clearfix">

                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="contact" >

                      <!-- <div class="soumLabel"><label>Format</label></div>
                            <div class="soumForm"><?php  cnLib::custom_taxonomy_dropdown('format','selectBox','Sélectionnez','',$args['format'],false);?><span class="infobulle" title="Précisez ici s’il s’agit d’une ressource de type document, site internet, diaporama, vidéo ou fichier audio.">?</span>
                            </div>
                           -->
                          
                            <div class="soumLabel"><label>Télécharger la source</label></div>
                            <div class="soumForm"><input class=" plain" type="file" name="doc_source" id="label" /><br />
                              <span>Merci de compresser le document ou utiliser un site transfert </span>
                            </div>
                          
                            <div class="soumLabel"><label>S'il s'agit d'un lien, indiquez le lien </label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="link" name="link" value="<?php if( isset($args['link'])) echo $args['link']; ?>">
                            </div>
                          

                            <div class="soumLabel"><label>Titre de la ressource</label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="title" name="title" value="<?php if( isset($args['title'])) echo $args['title']; ?>"><span class="infobulle" title="Saisissez le titre exactement tel qu’il est sur la ressource (en respectant les majuscules, les accents…). S’il n’y a pas de titre à votre ressource, proposez-en un le plus fidèle possible au contenu.">?</span></div>


                            <div class="soumLabel"><label>Description de la ressource</label></div>
                            <div class="soumForm"><textarea name="desc" id="desc"><?php if( isset($args['desc'])) echo $args['desc']; ?></textarea><span class="infobulle" title="Décrivez votre ressource en quelques lignes. De quel type de ressource s’agit-il ? quel est le sujet ? le public ciblé ? pour quel.s usage.s ?... n’oubliez pas d’indiquer la période sur laquelle porte la ressource.">?</span><br /><span>1 000 caractères max</span></div>


                            <div class="soumLabel"><label>Visuel associé</label></div>
                            <div class="soumForm"><input class=" plain" type="file" name="image_file" id="image_file" /><br /><span>Merci de compresser le document ou utiliser un site transfert </span></div>


                            <div class="soumLabel"><label>Date d'édition</label></div>
                            <div class="soumForm"><input type="text" id="date-start" name="date-start" value="<?php if( isset($args['date-start'])) echo $args['date-start']; ?>"><span class="infobulle" title="La date d’édition est la date à laquelle la ressource a été créée (et diffusée). A ne pas confondre avec la période sur laquelle porte le sujet. Exemple : un rapport sur la prise en charge des OEV à Ouagadougou entre 2000 et 2010 (période) qui a été publié en 2012 (date d’édition).">?</span><br /><span>mm/aaaa ou année seule</span></div>                          

                            
                            <div class="soumLabel"><label>Organisme associé</label></div>
                            <div class="soumForm listeDer">
                              <?php
                                if( isset($args['organisme'])) :                                   cnLib::custom_post_dropdown('structure', 'selectBox', 'Sélectionnez', '', $args['organisme'], $hide_empty = false, '');

                                else : 
                                  cnLib::custom_post_dropdown('structure', 'selectBox', 'Sélectionnez', '', '', $hide_empty = false, '');
                                endif;
                              ?>
                            </div>

                            
                            <div class="soumLabel"><label>Thématique</label></div>
                            <div class="soumForm">
                              <?php
                                if( isset($args['category'])) : 
                                  cnLib::custom_taxonomy_dropdown('category','selectBox','Sélectionnez','',$args['category'],false); 
                                else : 
                                  cnLib::custom_taxonomy_dropdown('category','selectBox','Sélectionnez','','',false); 
                                endif;
                              ?>
                              <span class="infobulle" title="Vous pouvez référencer la ressource dans une ou plusieurs thématiques et avec un ou plusieurs mots-clés, en fonction de son contenu. Ces choix seront intégrés par le moteur de recherche.">?</span>
                            </div>

                            
                            <div class="soumLabel"><label>Nom</label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="contname" name="contname" value="<?php if( isset($args['contname'])) echo $args['contname']; ?>"></div>


                            <div class="soumLabel"><label>Prénom</label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="contfirtname" name="contfirtname" value="<?php if( isset($args['contname'])) echo $args['contfirtname']; ?>"></div>


                            <div class="soumLabel"><label>Email</label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="contemail" name="contemail" value="<?php if (isset($args['contemail']) ) echo $args['contemail']; ?>"></div>


                            <div class="soumLabel"><label>Confirmation de l'email</label></div>
                            <div class="soumForm"><input class=" plain" type="text" id="contemail2" name="contemail2" value="<?php if (isset($args['contemail2']) ) echo $args['contemail2']; ?>"></div>


                            <div class="soumLabel"><label></label></div>

                            <div class="soumForm check-item">
                              <input type="checkbox" class="s_checkbox" id="rappeler" value="" name="rappeler"  value="oui"/> <label for="tous">J'ai pris connaisssance des <a href="/conditions-generales-dutilisation/" target="_blank">conditions générales d'utilisation</a></label>
                            </div>

                            <div class="soumLabel"><label></label></div>
                              <div class="soumForm">Afin d'éviter les spams, merci de nous indiquer combien font 2+2<br />
                              <input type="text" id="check" name="check" >
                            </div>

                            <input type="hidden" name="step" value="register" id="step"/>
                            <input type="hidden" name="checknc" value="<?php echo wp_create_nonce( 'my-nonce' );?>" />
                            <div style="display:none">
                              <label for="name">Name (mandatory)* :</label>
                              <input type="text" id="name" name="name" value="<?php echo $args['name'];?>">
                            </div>
                        
                           <input type="submit" class="soumettreRess btn-primary" value="Soumettre">
                        
                        </form>
                    
                    </div>                        
                  </div>
                
                        
                  <script src="<?php echo $cnSite->templatelink; ?>/_js/jquery.validate.min.js"></script>

                  <?php endif; ?>

            </div>

     </article>
</section>

<?php endwhile; ?>


<?php get_footer(); ?>