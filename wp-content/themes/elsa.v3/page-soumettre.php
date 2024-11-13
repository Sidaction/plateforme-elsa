<?php 
/*
 * Page formulaire de soumission d'un document
 * Template Name: Formulaire de soumission de document
 */
  wp_enqueue_script('validation');

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
      
          <?php if($args['step'] != 'validregister') : ?>
            <?php the_content();?>
          <?php endif; ?>


          <div class="txtListe">
            <?php if($args['alert']=='missingfields') : ?>           
              <h2 class="h2">Désolé</h2>
              <p class="msgalert">Des champs obligatoires sont manquants</p>
            <?php endif; ?>
                    
            <?php if($args['step']=='validregister') : ?>           
              <h2>Merci</h2>
              <p class="msgalert">Votre document a été suggéré.</p> <br />

              <div class="flex gap-m">
                <a href="<?php get_bloginfo('url')?>" class="btn btn--secondary">Revenir à l'accueil</a>
                <a href="" class="btn btn--primary">Suggérer une autre ressource</a>
              </div>
            <?php endif; ?>
          </div>


          <?php if($args['step'] != 'validregister') : ?>           

            <div class="form_container">


                      <form method="POST" class="submission_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" id="contact" >

                        <div class="form-group">
                          <h4>La ressource (fichier / lien) </h4>

                          <div class="form-field">
                            <div class="input--file">
                                <input type="file" name="doc_source" id="doc_source" />
                                <label class="plain">
                                  <span class="label-content">Document de la ressource (pdf, jpg, png...) </span>
                                  <span class="btn">
                                    Choisir le fichier
                                  </span>
                                </label>
                              </div>
                          </div>

                            <div class="form-field">
                              <div class="input--file">
                                <input type="file" name="image_file" id="image_file" />
                                <label  class="plain">
                                  <span class="label-content">Visuel associé de la ressource </span>
                                  <span class="btn">
                                    Choisir le fichier
                                  </span>
                                  </label>
                              </div>
                              <small class="msg">Merci de compresser le document ou utiliser un site transfert </small>
                            </div>

                            <div class="form-field">
                              <input placeholder="S'il s'agit d'un lien, indiquez le lien complet (htt://...)" type="text" class="plain" id="link" name="link" value="<?php if( !empty($args['link']) ) { echo $args['link']; } ?>">
                            </div>

                        </div>

                        <div class="form-group">

                          <h4>Détails sur la ressource</h4>

                          <div class="form-field">
                            <input placeholder="Titre de la ressource" type="text" class="plain" id="title" name="title" value="<?php if( !empty($args['title']) ) { echo $args['title']; }?>">
                            <small></small>
                          </div>

                          <div class="form-field">
                            <textarea placeholder="Description de la ressource" name="desc" id="desc" rows="5" ><?php if( !empty($args['desc']) ) { echo $args['desc']; } ?></textarea>
                          <small></small>
                          </div>

                          <div class="form-field">
                            <input placeholder="Date d'édition du document (mm/aaaa ou année seule)" type="text" class="plain" id="date-start" name="date-start" value="<?php if( !empty($args['date-start']) ) { echo $args['date-start']; } ?>">
                            <small></small>
                          </div>

                          <div class="form-field">
                            <div class="input--select">
                              <?php  cnLib::custom_taxonomy_dropdown('format','selectBox--subtil','Format du document','',$args['format'],false);?>
                              <span class="icon">
                                <?php get_template_part('svg/svg', 'carot', array( 'strokes' => '#767676' )); ?>
                              </span>
                            </div>
                          </div>

                          <div class="form-field">
                            <div class="input--select">
                              <?php  cnLib::custom_taxonomy_dropdown('category','selectBox--subtil','Thématique du document','','',false);?>
                              <span class="icon">
                                <?php get_template_part('svg/svg', 'carot', array( 'strokes' => '#767676' )); ?>
                              </span>
                            </div>
                          </div>

                          <div class="form-field">
                            <div class="input--select">
                              <?php  cnLib::custom_taxonomy_dropdown('pays_assoc','selectBox--subtil','Zone géographique du document','','',false);?>  
                              <span class="icon">
                                <?php get_template_part('svg/svg', 'carot', array( 'strokes' => '#767676' )); ?>
                              </span>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">

                          <h4>Vos Coordonnées</h4>

                          <div class="form-field">
                            <input placeholder="Vos nom et prénom" class="plain" type="text" id="contname" name="contname" value="<?php if( !empty($args['contname']) ) { echo $args['contname']; } ?>">
                            <small></small>
                          </div>

                          <div class="form-field">
                            <input placeholder="Votre adresse email" type="text" class="plain" id="contemail" name="contemail" value="<?php if( !empty($args['contemail']) ) {  echo $args['contemail']; } ?>">
                            <small></small>
                          </div>

                          <div class="form-field">
                            <input placeholder="Veuille confirmer votre adresse email" type="text" class="plain" id="contemail2" name="contemail2" value="<?php if( !empty($args['contemail2']) ) {  echo $args['contemail2']; } ?>">
                            <small></small>
                          </div>

                          <div class="form-field">
                            <input placeholder="Association" type="text" class="plain" id="contassoc" name="contassoc" value="<?php if( !empty($args['contassoc']) ) {echo $args['contassoc']; } ?>">
                            <small></small>
                          </div>

                          <!-- <input type="checkbox" id="rappeler" name="rappeler" value="oui">  -->

                        </div>

                        <div class="form-group">

                          <div class="form-field">
                            <input type="text" class="plain" placeholder="Combien font 3+9 ? (anti-spam)" id="check" name="check" >
                            <small></small>
                          </div>

                          <input type="hidden" name="step" value="register" id="step"/>
                          <input type="hidden" name="checknc" value="<?php echo wp_create_nonce( 'my-nonce' );?>" />

                        </div>

                        <div class="form-group">

                          <p class="mb-l">En soumettant cette ressource, j'assure avoir pris connaisssance des <a href="/conditions-generales-dutilisation/" target="_blank">conditions générales d'utilisation</a></p>

                          <button class="soumettreRess btn" aria-label="Soumettre la ressource">Soumettre la ressource</button>

                        </div>


                      </form>  


                    </div>       
                    
              <?php endif; ?>


            </div><!-- .form_container -->
                  
        </div><!-- .wrapper -->
    </section><!-- .sec_page-content -->

  </main>

<?php endwhile; ?>
<?php get_footer(); ?>