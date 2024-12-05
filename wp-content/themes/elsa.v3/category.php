<?php 
/*
 * Page détail d'une catégorie
 */

    $cat = get_category( get_query_var( 'cat' ) );	

    $cat_id = $cat->cat_ID;
    $cat_slug = $cat->slug;
    
    // $meta = get_option('info');
    // if (empty($meta)) 
    //     $meta = array();
    // if (!is_array($meta)) 
    //     $meta = (array) $meta;
    // $meta = isset($meta[$cat_id]) ? $meta[$cat_id] : array();
    // $presentation = $meta['presentation'];

    $presentation = get_field('presentation', $cat); 
    $image = get_field('image', $cat);
    $tags_linked = get_field('tags_linked', $cat);
    $themes_linked = get_field('themes_linked', $cat);
    $boites_linked = get_field('boites_linked', $cat);
    $size = 'post_thumb';


get_header(); 

?>

<main>
    <section class="sec_post-hero" style="background-image:url(<?= get_template_directory_uri(); ?>/assets/img/search/bg-search.png);">
        <div class="wrapper">
            <?php get_template_part('components/breadcrumb'); ?>

            <h1 class="h2 mb-m"><?= single_cat_title("", false); ?></h1>

            <?php if( isset($boites_linked) && !empty($boites_linked) ) : ?>
                <div class="ressource-meta">
                    <span class="p small">Boites à outils : </span>

                    <ul>

                    <?php foreach( $boites_linked as $term ): ?>
                        <li><a class="p small" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                    <?php endforeach; ?>

                    </ul>

                </div>
            <?php endif; ?>

            <?php if( isset($tags_linked) && !empty($tags_linked) ) : ?>
                <div class="ressource-meta">
                    <span class="p small">Mots clefs : </span>

                    <ul>
                        <?php foreach( $tags_linked as $term ): ?>
                            <li><a class="p small" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <section class="sec_post-content">
        <div class="container grid wrapper">
            <div class="t-12col l-9col entry-content">
                <?= wpautop($presentation); ?>
            </div>
            <div class="ressources t-12col l-3col flex column end-y">
                <a href="#recommandations" class="btn --secondary mb-m">Nos recommandations</a>
                <a href="/recherche-documentaire/?totalcat=<?php echo $cat_slug; ?>" class="btn">Toutes les ressources</a>
            </div>
        </div>
    </section>

    <section class="sec_related-ressources on-desktop" id="recommandations">
        <div class="wrapper">
            <h2 class="h2 mb-l">Ressources en lien</h2>
            <div class="flex column gap-l mb-l">
                <?php
                $related = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID)
                ));

                if ($related) {
                    foreach ($related as $post) {
                        setup_postdata($post);                         
                        get_template_part('template-parts/parts/part', 'ressource');  
                    }
                    wp_reset_postdata();
                } else {
                    echo '<p>Aucune ressource liée trouvée.</p>';
                }
                ?>
            </div>
            
            <a href="/recherche-documentaire/?totalcat=<?php echo $cat_slug; ?>" class="btn btn--primary">Voir toutes les ressources</a>
        </div>
    </section>

</main>




<?php get_footer(); ?>