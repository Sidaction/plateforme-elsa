<?php

  $dd_pays_titre = get_field('dd-pays-title', 'options');
  $dd_pays_img = get_field('dd-pays-img', 'options');
  $dd_pays_texte = get_field('dd-pays-text', 'options');

?>

<div class="dd_group bg-cut">
  <div class="wrap">

    <div class="dd_title">
      <h4><?php echo $dd_pays_titre; ?></h4>
    </div>

    <div class="row">

      <div class="m-3col dd_img">
        <img src="<?php echo $dd_pays_img; ?>" class="">
      </div>
      
      <div class="m-5col m-last has-2col dd_content">

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
              $results .= '<ul class="dd_pays_row no-bullets ">';
            
              while ($query_pays->have_posts()) : $query_pays->the_post();
              
                $slug = get_permalink($post->ID);
                $results .= '<li><a class="btn-inline" href="'. $slug .'" title="'. get_the_title() .'">' . get_the_title() .'</a></li>';
                
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
