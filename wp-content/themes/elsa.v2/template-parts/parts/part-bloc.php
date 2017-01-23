<?php

  $cat = cnLib::get_terms_withoutlink($post->ID, 'category');
  $format = cnLib::get_main_term_slug($post->ID, 'format');
  $auteurs = $cnSite->get_authors($post->ID);

?>



<?php if( $type == 'media' ) : ?>
  <div class="bloc_item bloc--<?php echo $type; ?> bg_cover" style="background-image:url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }  ?>)">

      <?php //echo $gema75_ril_frontend->show_read_it_later_after_title( 'hello' ); ?>

      <a href="#" class="bookmark"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="<?php echo $post->ID; ?>"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></span></a>

      <a href="<?php the_permalink();?>">

          <div class="bloc_meta bloc_category">
            <?php 
              if( $cat != '') {
                limit_words($cat, 5); 
              }
              if ($format != ''  & $cat != '') {
                echo ' | ';
              }
              if ($format != '') {
                echo $format;
              }
              if ($format != ''  & $auteurs != '') {
                echo ' | ';
              }
              if ($auteurs != '') {
                echo $auteurs;
              }
            ?>
          </div>

          <h2 class="h2 bloc_title"><?php limit_words( get_the_title(), 5 );?></h2>
      </a> 
  </div>

<?php else : ?>
  <div class="bloc_item bloc--<?php echo $type; ?>">
      
      <a href="#" class="bookmark"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="<?php echo $post->ID; ?>"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></span></a>

      <a href="<?php the_permalink();?>">

          <?php if( $type != 'statique') : ?>
            <div class="bloc_meta bloc_category">
              <?php 
                if( $cat != '') {
                  limit_words($cat, 5); 
                }
                if ($format != ''  & $cat != '') {
                  echo ' | ';
                }
                if ($format != '') {
                  echo $format;
                }
              ?>
            </div>
          <?php endif; ?>

          <h2 class="h2 bloc_title"><?php limit_words( get_the_title(), 7 );?></h2>

          <div class="bloc_meta bloc_authors">
            <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>
          </div>

          <?php if( $type == 'statique') : ?>
            <div class="bloc_meta bloc_excerpt">
              <?php the_excerpt(); ?>
            </div>
          <?php endif; ?>

      </a> 
    
  </div>

<?php endif; ?>


  