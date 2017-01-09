<?php 
/*
 * Page d'accueil
 * Template Name: Page d'accueil
 *
*/

get_header(); ?>


<section id="site-content" class="site-content template-home">

    
    <div id="sliderHome" class="home-feature" style="background-image:url();">
        <div class="wrap">
            <div class="feature-title">Zoom</div>
            <div class="feature-title">
                <h2>Financement de la lutte contre le sida</h2>
            </div>

            <div class="row">
                <div class="m-6col">
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </div>
                
                    <div class="feature-action">
                        <a class="btn-primary">En savoir plus</a>
                        <a class="btn-secondary">LEs ressources de la thématique</a>
                    </div>
                </div>


                <div class="m-6col">
                    <div class="feature-asso">Ceradis</div>
                    <div class="feature-pays">Bénin</div>
                </div>

            </div>
        </div><!-- .wrap -->   
    </div>
    
    
    
    <div id="contentWrapper" class="home-grid">
        <div class="wrap row">

            <div class="grid-title">
                <h3>Des documents, des photos, des vidéos...</h3>
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
