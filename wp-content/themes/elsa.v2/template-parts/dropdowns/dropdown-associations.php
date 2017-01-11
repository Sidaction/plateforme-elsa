

<div class="dd_group">
  <div class="wrap">

    <h4>Toutes les associations</h4>
    
    <div class="row">

      <div class="m-4col">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. </p>

        <p>Excepteur sint occaecat cupidatat non  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      
      <div class="m-4col m-last">

        <a href="/associations" class="btn-primary">Consulter l'annuaire des associations</a>
      </div>
    </div>

    <div>


        <?php 

          $args = array(
            'post_type' => array('structure'), 
            'posts_per_page' => -1, 
            'orderby' => 'title', 
            'order' => 'ASC',
            'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa'
          );
          
          $wp_query = new WP_Query($args);

          if ($wp_query->have_posts()) : 
            echo '<ul class="no-bullets">';

            while ($wp_query->have_posts()) : $wp_query->the_post();
              
              $slug = get_permalink($post->ID);

              echo '<li><a href="'. $slug .'" title="'. get_the_title() .'">' . get_the_title() .'</a></li>';

            endwhile; 
            wp_reset_query();
            wp_reset_postdata(); 
            $args=null;

            echo '</ul>';
          
          endif; ?>


      </div>
    

  </div>
</div>
