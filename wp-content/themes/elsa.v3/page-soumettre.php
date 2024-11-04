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

<main>


  <section class="sec_page-hero">
        <div class="wrapper">

                    <div class="page_title static_title">
                        <div class="wrap row">
                            <h1 class="h1 m-6col is-centered text-on-center">
                                <?php the_title(); ?>
                            </h1>  
                        </div>     
                    </div>

        </div>
    </section>


  <section class="sec_page-content">
    <div class="wrapper">

    <div class="entry-content">


          <?php the_content();?>

                <div class="txtListe">
                  <?php if($args['alert']=='missingfields') : ?>           
                    <h2>Désolé</h2>
                    <p class="msgalert">Des champs obligatoires sont manquants</p>
                    <?php endif; ?>
                    <?php if($args['step']=='validregister') : ?>           
                    <h2>Merci</h2>
                    <p class="msgalert">Votre document a été suggéré.</p> <br />
                    <?php endif; ?>
                </div>


                <div class="">


                    <form method="post" class="submission_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="contact" >

                        <br><br>

                        <div class="input--file">
                          <input type="file" name="doc_source" id="label" />
                          <label class="plain">Télécharger la source <span class="icon-arrow_right-big"></span></label>
                        </div>

                        <div class="input--file">
                          <input type="file" name="image_file" id="image_file" />
                          <label  class="plain">Visuel associé <span class="icon-arrow_right-big"></span></label>
                          <span class="msg">Merci de compresser le document ou utiliser un site transfert </span>
                        </div>

                        <input placeholder="S'il s'agit d'un lien, indiquez le lien complet (htt://...)" type="text" class="plain" id="link" name="link" value="<?php if( !empty($args['link']) ) { echo $args['link']; } ?>">
                        

                        <br><br>                      
                        <h4>Détails sur la ressource</h4>

                        <input placeholder="Titre de la ressource" type="text" class="plain" id="title" name="title" value="<?php if( !empty($args['title']) ) { echo $args['title']; }?>">

                        <textarea placeholder="Description de la ressource" name="desc" id="desc" rows="5" ><?php if( !empty($args['desc']) ) { echo $args['desc']; } ?></textarea>

                        <input placeholder="Date d'édition du document (mm/aaaa ou année seule)" type="text" class="plain" id="date-start" name="date-start" value="<?php if( !empty($args['date-start']) ) { echo $args['date-start']; } ?>">

                        <div class="input--select">
                          <?php  cnLib::custom_taxonomy_dropdown('format','selectBox--subtil','Format du document','',$args['format'],false);?>
                          <span class="icon-arrow_right-big"></span>
                        </div>

                        <div class="input--select">
                          <?php  cnLib::custom_taxonomy_dropdown('category','selectBox--subtil','Thématique du document','','',false);?>
                          <span class="icon-arrow_right-big"></span>
                        </div>

                        <div class="input--select">
                          <?php  cnLib::custom_taxonomy_dropdown('pays_assoc','selectBox--subtil','Zone géographique du document','','',false);?>  
                          <span class="icon-arrow_right-big"></span>
                        </div>

                        <br><br>                      
                        <h4>Vos Coordonnées</h4>

                        <input placeholder="Vos nom et prénom" class="plain" type="text" id="contname" name="contname" value="<?php if( !empty($args['contname']) ) { echo $args['contname']; } ?>">

                        <input placeholder="Votre adresse email" type="text" class="plain" id="contemail" name="contemail" value="<?php if( !empty($args['contemail']) ) {  echo $args['contemail']; } ?>">

                        <input placeholder="Veuille confirmer votre adresse email" type="text" class="plain" id="contemail2" name="contemail2" value="<?php if( !empty($args['contemail2']) ) {  echo $args['contemail2']; } ?>">

                        <input placeholder="Association" type="text" class="plain" id="contassoc" name="contassoc" value="<?php if( !empty($args['contassoc']) ) {echo $args['contassoc']; } ?>">

                        <input type="checkbox" id="rappeler" name="rappeler" value="oui"> 

        <br><br>

                        <input type="text" class="plain" placeholder="Combien font 2+2 ? (anti-spam)" id="check" name="check" >

                        <input type="hidden" name="step" value="register" id="step"/>
                        <input type="hidden" name="checknc" value="<?php echo wp_create_nonce( 'my-nonce' );?>" />
                           <div style="display:none"><label for="name">Name (mandatory)* :</label><input type="text" id="name" name="name" value="<?php echo $args['name'];?>"></div>


                        <p>En soumettant cette ressource, j'assure avoir pris connaisssance des <a href="/conditions-generales-dutilisation/" target="_blank">conditions générales d'utilisation</a></p>

                        <button class="soumettreRess btn">Soumettre la ressource</button>
                    
                    </form>  


                  </div>                        
                </div>
                
      </div>


</section>


</main>

<?php endwhile; ?>
<?php get_footer(); ?>