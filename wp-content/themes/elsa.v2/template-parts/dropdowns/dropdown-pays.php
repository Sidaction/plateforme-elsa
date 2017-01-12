

<div class="dd_group">
  <div class="wrap">

    <h4>Tous les Pays</h4>
    
    <div class="row">

      <div class="m-2col">
        <img src="" class="">
      </div>
      
      <div class="m-4col m-last">


        <?php 

          $regions = get_terms( 
            'region', 
            array( 
              'orderby' => 'slug', 
              'order' =>'ASC',  
              'hide_empty'  => true, 
              'exclude'=>array(351,131,126,161,278) 
              )  
            ); 
          
          foreach($regions as $region) {
            
            $args = array(
              'post_type' => array('pays'), 
              'posts_per_page' => -1, 
              'orderby' => 'title', 
              'order' => 'ASC',
              'region' => $region->slug
            );
            $wp_query = new WP_Query($args);
          
            if ($wp_query->have_posts()) :
              $results = '<h3>'.$region->name.'</h3>';
              $results .= '<ul class="listePays">';
            
              while ($wp_query->have_posts()) : $wp_query->the_post();
              
                $slug = get_permalink($post->ID);
                $results .= '<li><a href="'. $slug .'" title="'. get_the_title() .'">»  ' . get_the_title() .'</a></li>';
                
              
              endwhile; 

              $results.='</ul>';
            endif;
          
          wp_reset_query();
          wp_reset_postdata(); 
          $args=null;
          
          echo $results;
          
        } ?>


      </div>
    </div>
    

  </div>
</div>
