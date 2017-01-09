<?php 

/*
 * Page détail d'une boite à outils
 */

    

    $cat = get_category( get_query_var( 'cat' ) );	

    $cat_id = $cat->cat_ID;
    $cat_slug=$cat->slug;
    $meta = get_option('info');

    if (empty($meta)) 
        $meta = array();

    if (!is_array($meta)) 
        $meta = (array) $meta;

    $meta = isset($meta[$cat_id]) ? $meta[$cat_id] : array();

    $presentation = $meta['presentation']; 
    $details = $meta['details']; 
    $vignette = $meta['image']; 

get_header(); 

?>



<section id="site-content" class="template-boite">


        <article>
		  <h1>
            <?php echo  single_cat_title("", false); ?></h1>           
        
            <?php echo wpautop($presentation); ?>
            
        </article>
        

        
        
        
</section>
<?php get_footer(); ?>