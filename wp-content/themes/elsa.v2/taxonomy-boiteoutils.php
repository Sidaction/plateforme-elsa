<?php 
/*
 * Page détail d'une Boite à outils
 */

    $boite = get_category( get_queried_object()->term_id );  

    $boite_id = $boite->cat_ID;
    $boite_slug = $boite->slug;
    $meta = get_option('info');

    if (empty($meta)) 
        $meta = array();
    
    if (!is_array($meta)) 
        $meta = (array) $meta;

    $meta = isset($meta[$boite_id]) ? $meta[$boite_id] : array();
    $presentation = $meta['presentation']; 
    $details = $meta['details']; 
    $vignette = $meta['image']; 

get_header(); 

?>

    <section id="site-content" class="">

        <article class="main-content clearfix">
            <div class="page_title archives_title">

                <div id="breadcrumb" class="site-breadcrumb">
                    <div id="breadcrumbWrapper">Vous êtes ici » <a href="#">Accueil</a> » <a href="/dossiers-thematiques/">Boites à outils</a> » <a href="#"><?php echo single_cat_title("", false); ?></a></div>
                </div>

                <div class="wrap">
                    <h1 class="h1">
                        <?php echo single_cat_title("", false); ?>
                    </h1>  
                </div>     
            </div>


            <div class="page_content clearfix">
                <div class="wrap row">
                    <div class="m-5col">
                        <?php echo wpautop($presentation); ?>
                    </div>

                    <div class="m-3col">
                        <img src="">

                        <div class="page_metas">
                            métas
                        </div>

                        <div class="page_actions">
                            <a href="#" class="btn-primary plain">Voir les ressources recommandées</a>
                            <a href="#" class="btn-secondary plain">Voir toutes les ressources</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>

            
        <div id="" class="blocs_group">
           <h3>La plateforme ELSA vous recommande</h3>
         
            <div class="recomWrapper">
                <?php
                    $args = array(
                        'post_type' => array('post'), 
                        'posts_per_page' => 5, 
                        'cat' =>  $cat_id, 
                        'meta_key' => 'homefiche', 
                        'meta_value' => '1'
                    );
                    $wp_query = new WP_Query($args);
                    
                    if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
    
                        <div class="recom">
                            <a href="<?php the_permalink();?>">
                    <div class="leftProg">
                        <?php the_post_thumbnail('medium');?>
                    </div>
                    <div class="rightProg">
                        <span class="first_org"><?php echo cnLib::get_related_post($post->ID, 'first_org');?></span><br />
                        
                        <?php $cat= cnLib::get_terms_withoutlink($post->ID, 'category');
                        $pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');?>
                        <?php if(!empty($cat) or !empty($pays)) :?>
                    <span class="category"><?php if(!empty($cat)) echo $cat;?><?php if(!empty($cat) && !empty($pays)) echo  ' - ';?><?php echo $pays;?></span><br /><?php endif;?>
                       
                        <span class="title"><?php the_title();?></span><br />
                        <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(100); ?></span>
                        <!-- <?php echo cnLib::get_main_term_slug($post->ID, 'format');?> -->
                    </div>
                    </a>  
                </div>

                <?php 
                    endwhile; 
                    wp_reset_query();
                    wp_reset_postdata(); 
                    $args=null; ?>
            </div> 
        </div><!-- .blocs_group -->

     </div>
</section>
<?php get_footer(); ?>

