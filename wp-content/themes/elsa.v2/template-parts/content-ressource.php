<?php 
if($link) {
  $parse = parse_url($link);
  $domain = $parse['host'];  
}
?>

  <section id="site-content" class="site-content single-ressource">


    <article class="main-content clearfix noback">
        <div class="page_title ressource_title">

          <div class="wrap row">
              <?php $cnSite->get_back_link(); ?> 

              <h1 class="h1 m-5col m-clearfix">
                  <?php the_title();?>
              </h1>  
          </div>     
        </div>

        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="page_mobile m-hide ">

                  <div class="page_metas s-6col">

                      <?php if(!empty($auteurs)) : ?>
                        <div class="page_metas_row">
                          <?php echo '<span>Auteur(s) : </span>'.$auteurs; ?>
                        </div>
                      <?php endif; ?>
                      
                      <div class="page_metas_row">
                        <?php echo get_the_term_list( $post->ID, 'pays_assoc', '<span>Pays : </span>', ', ' ); ?>
                      </div>

                      <div class="page_metas_row">
                        <?php if(!empty($date_edition)) echo '<span>Date d’édition : </span>' . $date_edition;?> 
                      </div>

                      <div class="page_metas_row">
                        <span>Thématique(s) :</span> <?php the_category(', '); ?>
                      </div>

                      <?php echo get_the_tag_list('<div class="page_metas_row"><span>Mots clés : </span>',', ', '</div>');  ?>


                  </div><!-- .metas -->

                  <div class="clearfix">
                    <?php the_post_thumbnail('post_thumb'); ?>
                  </div>

                </div>


                <div class="m-5col page_main m-clearfix">
                  
                  <div class="page_metas">

                        <?php if(!empty($auteurs)) : ?>
                          <div class="page_metas_row">
                            <?php echo '<span>Auteur(s) : </span>'.$auteurs; ?>
                          </div>
                        <?php endif; ?>
                        
                        <div class="page_metas_row">
                          <?php echo get_the_term_list( $post->ID, 'pays_assoc', '<span>Pays : </span>', ', ' ); ?>
                        </div>

                        <div class="page_metas_row">
                          <?php if(!empty($date_edition)) echo '<span>Date d’édition : </span>' . $date_edition;?> 
                        </div>

                        <div class="page_metas_row">
                          <span>Thématique(s) :</span> <?php the_category(', '); ?>
                        </div>

                      <?php echo get_the_tag_list('<div class="page_metas_row"><span>Mots clés : </span>',', ', '</div>');  ?>


                    </div><!-- .metas -->


                  <?php the_content();?>

                  <div class="page_actions">

                    <?php if( $format == 'lien' && !empty($link) ) echo "<a href='{$link}' title='Voir le site' target='_blank' class='btn-primary'>Voir le site <br>( <em>{$domain}</em> )</a>"?>

                    <?php if( $format!='lien' && $format!='video' && !empty($link) ) echo "<a href='{$link}' title='Voir le site' target='_blank' class='btn-primary'>Voir le site <br>( <em>{$domain}</em> )</a>"?> 

                    <?php
                      $files = rwmb_meta( 'file', 'type=file' );
                      foreach ( $files as $info ) {
                    
                        $size = filesize( $info['path'] );
                        $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
                        $size = false === $size ? 0 : size_format( $size, 2 );
                        
                        echo "<a href='{$info['url']}' title='{$info['title']}' class='btn-primary' target='_blank'>Consultez la ressource <br> ( <em>{$kind} -{$size}</em> )</a>";
                      }?>

                  </div><!-- .page_actions -->  

                </div>


                <div class="m-3col page_aside">

                    <div class="page_media clearfix ">
                      <?php the_post_thumbnail('post_thumb'); ?>
                    </div>
                    
                </div><!-- .ressource_aside -->
            </div><!-- .wrap -->
        </div><!-- .page_content -->


        <?php get_template_part('template-parts/parts/part', 'share'); ?>
     
    
    </article>