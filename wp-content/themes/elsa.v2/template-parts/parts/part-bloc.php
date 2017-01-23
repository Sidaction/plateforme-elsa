


<?php if( $type == 'media' ) : ?>
  <div class="bloc_item bloc--<?php echo $type; ?> bg_cover" style="background-image:url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }  ?>)">

      <?php //echo $gema75_ril_frontend->show_read_it_later_after_title( 'hello' ); ?>

      <a href="#" class="bookmark"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="<?php echo $post->ID; ?>"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></span></a>

      <a href="<?php the_permalink();?>">
          <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>
          <?php get_terms(); ?>
          <h2 class="h2 bloc_title"><?php the_title();?></h2>
      </a> 
  </div>


<?php else : ?>
  <div class="bloc_item bloc--<?php echo $type; ?>">
      
      <a href="#" class="bookmark"><span class="gema75_read_it_later_text addToReadItLaterButton" data-readitlater-id="<?php echo $post->ID; ?>"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></span></a>

      <a href="<?php the_permalink();?>">
          <?php get_terms(); ?>
          <h2 class="h2 bloc_title"><?php the_title();?></h2>
          <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>
      </a> 
    
  </div>

<?php endif; ?>


  