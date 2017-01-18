
  <section id="site-content" class="site-content single-media">

    <article class="main-content clearfix noback">
        <div class="page_title media_title">

          <div class="wrap row">

              <div class="m-4col">
                <a href="/medias" class="btn-inline">Voir tous les médias</a>
                <h1 class="h1">
                    <?php the_title();?>
                </h1>
              </div>

              <div class="m-3col m-last media_aside">
                  <div class="media_metas">
                      
                      <div class="page_metas_row">
                        <?php if(!empty($auteurs)) echo '<span>Auteur(s) : </span>'.$auteurs;?>
                      </div>
                      
                      <div class="page_metas_row">
                        <?php echo get_the_term_list( $post->ID, 'pays_assoc', '<span>Pays : </span>', ', ' ); ?>
                      </div>

                      <div class="page_metas_row">
                        <?php if(!empty($date_edition)) echo '<span>Date d’édition : </span>' . $date_edition;?> 
                      </div>

                      <div class="page_metas_row">
                        <span>Thème(s) :</span> <?php the_category(', '); ?>
                      </div>

                      <div class="page_metas_row">
                        <?php echo get_the_tag_list('<span>Mots clés : </span>',', ');  ?>
                      </div>

                  </div><!-- .metas -->
              </div><!-- .page_aside -->

          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">
                <div class="m-5col is-centered">

                  <?php the_content();?>

                  <?php if($format == 'video' && !empty($link)) echo wp_oembed_get($link); ?>

                </div>

            </div><!-- .wrap -->
        </div><!-- .page_content -->



        <div class="page_tools blocs_group">
          <div class="wrap row">
    
            <div class="group_title--small m-2col">
              <?php $cnSite->get_fiche_nav();?> 
            </div>

            <div class="group_content m-6col">
              <div class="is-on-left"><a class="btn-secondary" href="#">Lire plus tard</a></div>
              <div class="is-on-left btn-secondary">
                Partagez ! 
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">facebook</a></li>
                <a href="http://twitter.com/share?text=#BiennalePhotoMondeArabe&url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" >twitter</a>
                <a href="#">mail</a> </div>
              <div class="is-on-left"><a href="/soumettre" class="btn-secondary">Soumettre une ressource</a></div>
            </div>

          </div>
        </div><!-- .page_tools -->          
    
    </article>