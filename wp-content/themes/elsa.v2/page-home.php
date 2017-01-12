<?php 
/*
 * Page d'accueil
 * Template Name: Page d'accueil
 *
*/

get_header(); 

$image = get_field('zoom_image');
$zoom_thematique = get_field('zoom_thematique');
$zoom_pays = get_field('zoom_pays');
$zoom_association = get_field('zoom_association');

?>


<section id="site-content" class="site-content template-home">

    
    <div id="" class="home-featured">
        <div class="featured-cover bg_cover" style="background-image:url(<?php echo $image['url']; ?>);">

        </div>
        <div class="featured-content">

            <div class="wrap">
                <div class="featured-title">Zoom</div>
                <div class="featured-title">
                    <h2><?php the_field('zoom_titre'); ?></h2>
                </div>

                <div class="row">
                    <div class="m-4col">
                        <div><?php the_field('zoom_texte'); ?></div>
                    
                        <div class="featured-action">
                            <a class="btn-primary" href="/category/<?php echo $zoom_thematique->slug; ?>">En savoir plus</a>
                            <a class="btn-secondary" href="<?php echo $zoom_thematique->slug; ?>">Les ressources de la thématique</a>
                        </div>
                    </div>


                    <div class="m-2col">
                        <div class="featured-asso"><?php echo $zoom_association->post_title; ?></div>
                        <div><?php echo $zoom_association->post_excerpt; ?></div>
                        <a href="/structure/<?php echo $zoom_association->post_name?>"> -> </a>
                    </div>

                    <div class="m-2col">
                        <div class="featured-pays"><?php echo $zoom_pays->post_title; ?></div>
                        <div><?php echo $zoom_pays->post_excerpt; ?></div>
                        <a href="/pays/<?php echo $zoom_pays->post_name?>"> -> </a>
                    </div>
                </div>
            </div><!-- .wrap -->   

        </div>
    </div><!-- .home-featured -->
    
    
    
    <div id="" class="home-grid blocs_group">
        <div class="wrap row">

            <div class="grid-title">
                <h3 class="h3">Des documents, des photos, des vidéos...</h3>
            </div>
    	    
            <div class="grid-list">
                <?php 	
                    $args = array('post_type' => array('post'), 'posts_per_page' => 5);
                    $wp_query = new WP_Query($args);
    				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>

    					<a href="<?php the_permalink();?>">
                        
                            <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" /></div>
                          
        					<div class="leftProg">
        						<?php the_post_thumbnail('medium');?>
                            </div>

                            <div class="rightProg">
        						<span class="first_org">
                                    <?php echo $auteurs=$cnSite->get_authors($post->ID);?>
                                </span>                    
                                
                                <?php 
                                    $cat= cnLib::get_terms_withoutlink($post->ID, 'category');
        							$pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');
                                ?>
                                
                                <?php if(!empty($cat) or !empty($pays)) : ?>
                                    <span class="category"><?php if(!empty($cat)) echo $cat;?><?php if(!empty($cat) && !empty($pays)) echo  ' - ';?><?php echo $pays;?></span>
                                <?php endif;?>

                                <span class="title"><?php the_title();?></span>

                                <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(100); ?></span>

                                <!-- <?php echo cnLib::get_main_term_slug($post->ID, 'format');?> -->
                            </div>
                        </a>  

                 <?php 
                     endwhile; 
                     wp_reset_query();
                     wp_reset_postdata(); 
                     $args=null; 
                 ?>
            </div><!-- .grid-list -->

        </div><!-- .wrap -->
     </div>


</section>

<?php get_footer(); ?>
