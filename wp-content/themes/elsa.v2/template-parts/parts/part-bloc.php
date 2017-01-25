<?php

  $cat = cnLib::get_terms_withoutlink($post->ID, 'category');
  $format = cnLib::get_main_term_slug($post->ID, 'format');
  $auteurs = $cnSite->get_authors($post->ID);
  $reco = get_field('recommandation');
  $boite = get_the_term_list( $post->ID, 'boiteoutils', 'People: ', ', ' );

  global $Bookmarks;
  global $post;
?>



<?php if( $type == 'media' ) : ?>
  <div class="bloc_item bloc--<?php echo $type; ?> bg_cover" style="background-image:url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }  ?>)">

      <?php echo $Bookmarks->show_bookmark_btn(); ?>

      <img class="bloc-media_format" src="<?php echo get_template_directory_uri(); ?>/_img/icon-<?php echo $format; ?>.png">

      <a href="#" class="bookmark"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="<?php echo $post->ID; ?>"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></span></a>

      <a href="<?php the_permalink(); ?><?php if( isset($ref) && $ref == 'media' ) echo '?ref=media'; ?>">

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

          <h2 class="h2 bloc_title">
            <?php limit_words( get_the_title(), 5 );?>
            <?php if( is_home() || is_front_page() ) {
              echo '<p><a class="btn-inline" href="/medias">Voir tous nos médias</a></p>';
              } ?>
          </h2>



          <div class="bloc_icons">
            <?php if( isset($reco) && $reco ) : ?>
              <span class="icon-recommandation"></span>
            <?php endif; ?>
            <?php if( isset($boite) && $boite ) : ?>
              <span class="icon-boite"></span>
            <?php endif; ?>
          </div>


      </a> 
  </div>

<?php else : ?>
  <div class="bloc_item bloc--<?php echo $type; ?>">
      
<?php echo $Bookmarks->show_bookmark_btn(); ?>

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

          <h2 class="h2 bloc_title"><?php limit_words( get_the_title(), 8 );?></h2>

          <div class="bloc_meta bloc_authors">
            <?php limit_words( $auteurs );  ?>
          </div>

          <?php if( $type == 'statique') : ?>
            <div class="bloc_meta bloc_excerpt">
              <?php the_excerpt(); ?>
            </div>
          <?php endif; ?>


          <div class="bloc_icons">
            <?php if( isset($reco) && $reco ) : ?>
              <span class="icon-recommandation"></span>
            <?php endif; ?>
            <?php if( isset($boite) && $boite ) : ?>
              <span class="icon-boite"></span>
            <?php endif; ?>
          </div>

      </a> 
    
  </div>

<?php endif; ?>


  