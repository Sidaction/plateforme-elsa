

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
            
            $pays_args = array(
              'post_type' => array('pays'), 
              'posts_per_page' => -1, 
              'orderby' => 'title', 
              'order' => 'ASC',
              'region' => $region->slug
            );
            $query_pays = new WP_Query($pays_args);
          
            if ($query_pays->have_posts()) :
              $results = '<h3>'.$region->name.'</h3>';
              $results .= '<ul class="listePays">';
            
              while ($query_pays->have_posts()) : $query_pays->the_post();
              
                $slug = get_permalink($post->ID);
                $results .= '<li><a href="'. $slug .'" title="'. get_the_title() .'">»  ' . get_the_title() .'</a></li>';
                
              endwhile; 

              $results.='</ul>';
            endif;
          
          wp_reset_postdata();
          $regions = null;

          echo $results;
          
        } ?>


      </div>
    </div>
    

  </div>
</div>
