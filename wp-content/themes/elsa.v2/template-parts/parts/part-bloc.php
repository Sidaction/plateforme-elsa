


<?php if( $type == 'media' ) : ?>
  <div class="bloc_item bloc--<?php echo $type; ?>">
      <a href="#" class="bookmark"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></a>
      <a href="<?php the_permalink();?>">
          <?php get_terms(); ?>
          <span class="title"><?php the_title();?></span>
          <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>

          <div class="btn-inline"><span class="icon-arrow_right"></span> Regarder</div>
      </a> 
  </div>


<?php else : ?>
  <div class="bloc_item bloc--<?php echo $type; ?>">
      <a href="#" class="bookmark"><span class="icon-bookmark_full"><span class="path1"></span><span class="path2"></span></span></a>

      <a href="<?php the_permalink();?>">
          <?php get_terms(); ?>
          <span class="title"><?php the_title();?></span>
          <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>
      </a> 
    
  </div>

<?php endif; ?>


  