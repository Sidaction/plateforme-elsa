

  <div class="bloc_item bloc--<?php echo $type; ?>">
      <a href="<?php the_permalink();?>">
          <?php get_terms(); ?>
          <span class="title"><?php the_title();?></span>
          <?php echo $auteurs = $cnSite->get_authors($post->ID); ?>
      </a> 
  </div>

  