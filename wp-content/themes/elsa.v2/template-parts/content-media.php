

  <section id="site-content" class="site-content single-media">

    <article class="main-content clearfix noback">
        <div class="page_title media_title">

          <div class="wrap row">

              <div class="m-4col">
                <a href="/medias" class="btn-inline btn-goback">Voir tous les médias</a>
                <h1 class="h1">
                    <?php the_title();?>
                </h1>
              </div>

              <div class="m-3col m-last media_aside">
                  <div class="media_metas">
                      
                      
                      <?php if(!empty($auteurs)) echo '<div class="page_metas_row"><span>Auteur(s) : </span>'.$auteurs .'</div>';?>
                      
                      <div class="page_metas_row">
                        <?php echo get_the_term_list( $post->ID, 'pays_assoc', '<span>Pays : </span>', ', ' ); ?>
                      </div>

                      <?php if(!empty($date_edition)) echo '<div class="page_metas_row"><span>Date d’édition : </span>' . $date_edition . '</div>';?> 

                      <div class="page_metas_row">
                        <span>Thématique(s) :</span> <?php the_category(', '); ?>
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

                  <?php // VIDEO ?>
                  <?php if($format == 'video' && !empty($link)) echo wp_oembed_get($link); ?>

                  <?php // AUDIO ?>
                  <?php if( $format == 'audio' && !empty($link) ) echo "<a href='{$link}' title='Consulter le document sonore' target='_blank' class='btn-primary'>Consulter le document sonore ( {$link} )</a>"?>
                  <?php if( $format == 'audio' && !empty($embed) ) echo "<div class='embed-plain'>". $embed . "</div>" ?>
                  
                    <?php
                      $files = rwmb_meta( 'file', 'type=file' );
                      foreach ( $files as $info ) {
                    
                        $size = filesize( $info['path'] );
                        $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
                        $size = false === $size ? 0 : size_format( $size, 2 );
                        
                        echo "<a href='{$info['url']}' title='{$info['title']}' class='btn-primary' target='_blank'>Consultez la ressource <br> [{$info['title']} ({$kind} -{$size} )]</a>";
                      }?>

                  <?php // DIAPORAMA ?>
                  <?php if( get_field('images') ) : $images = get_field('images'); ?>
                      <ul class="no-bullets bxslider">
                          <?php foreach( $images as $image ): ?>
                              <li>
                                <img src="<?php echo $image['sizes']['diaporama']; ?>" alt="<?php echo $image['alt']; ?>" />
                                <p><?php echo $image['caption']; ?></p>
                              </li>
                          <?php endforeach; ?>
                      </ul>
                    <?php endif; ?>

                  <?php // LE CONTENU ?>
                  <?php the_content();?>

                </div>
            </div><!-- .wrap -->
        </div><!-- .page_content -->



        <?php get_template_part('template-parts/parts/part', 'share'); ?>
   
    
    </article>