<?php

  $dd_assos_titre = get_field('dd-assos-title', 'options');
  $dd_assos_texte = get_field('dd-assos-text', 'options');
  $dd_assos_annuaire = get_field('dd-assos-url', 'options');

?>

<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="dd_title m-2col">
      <h4 class="h4"><?php echo $dd_assos_titre; ?></h4>
    </div>

    <div class="row dd_content">

      <div class="m-4col">
        <?php echo $dd_assos_texte; ?>
      </div>
      
      <div class="m-4col m-last">

        <a href="<?php echo $dd_assos_annuaire; ?>" class="btn-primary">Consulter l'annuaire des associations</a>
      </div>
    </div>

    <div class="row dd_content">

        <?php 

          $assos_args = array(
            'post_type' => array('structure'), 
            'posts_per_page' => -1, 
            'orderby' => 'title', 
            'order' => 'ASC',
            'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa'
          );
          
          $assos_query = new WP_Query( $assos_args );

          if ($assos_query->have_posts()) : 
            echo '<ul class="no-bullets has-3col">';

            while ($assos_query->have_posts()) : $assos_query->the_post();
              
              $slug = get_permalink($post->ID);

              echo '<li><a class="btn-inline" href="'. $slug .'" title="'. get_the_title() .'">' . get_the_title() .'</a></li>';

            endwhile; 
            wp_reset_postdata();

            echo '</ul>';
          
          endif; ?>


      </div>
    

  </div>
</div>
