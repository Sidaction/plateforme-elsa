<?php 
/*
 * Page détail d'une Boite à outils
 */
    wp_enqueue_script('swiper');
    wp_enqueue_script('slider');
    wp_enqueue_style('swiper-styles');

    $boite = get_category( get_queried_object() );  

    $boite_id = $boite->cat_ID;
    $boite_slug = $boite->slug;

    // $meta = get_option('info');
    // if (empty($meta)) 
    //     $meta = array();
    // if (!is_array($meta)) 
    //     $meta = (array) $meta;
    // $meta = isset($meta[$boite_id]) ? $meta[$boite_id] : array();

    $presentation = get_field('presentation', $boite); 
    $image = get_field('image', $boite);
    $tags_linked = get_field('tags_linked', $boite);
    $themes_linked = get_field('themes_linked', $boite);
    $boites_linked = get_field('boites_linked', $boite);
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

            <!-- <?php if( isset($tags_linked) && !empty($tags_linked) ) : ?>
                <div class="ressource-meta">
                    <span class="p small">Mots clefs : </span>

                    <ul>
                        <?php foreach( $tags_linked as $term ): ?>
                            <li><a class="p small" href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            <?php endif; ?> -->

            <?php if( isset($tags_linked) || isset($boites_linked) ) : ?>
                <div class="page_metas">
                    
                    <?php if( isset($themes_linked) && !empty($themes_linked) ) : ?>
                        <div class="ressource-meta">
                            <span class="p small">Thématiques : </span>

                            <ul>
                                <?php foreach( $themes_linked as $term ): ?>
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
                                    <li><a class="p small   " href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    <?php endif; ?>

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
                <a href="/recherche-documentaire/?boites=<?php echo $boite_slug; ?>" class="btn">Toutes les ressources</a>
            </div>
        </div>
    </section>

    <section class="sec_related-ressources" id="recommandations">
        <div class="wrapper">
            <h2 class="h2 mb-l">Ressources en lien</h2>
            <div class="swiper flex column gap-l mb-l">
                <?php
                $args = array(
                    'post_type' => array('post'), 
                    'posts_per_page' => 6,
                    'boiteoutils' => $boite_slug,
                    'meta_query' => array(
                        array(
                            'key' => 'homefiche',
                            'compare' => '==',
                            'value' => '1'
                        )
                    )
                );
                $related_posts = get_posts($args);

                if ($related_posts) { ?>

                    <div class="navigation">
                        <div class="swiper-button prev">
                            <?php get_template_part('svg/svg', 'swiperprev'); ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button next">
                            <?php get_template_part('svg/svg', 'swipernext'); ?>
                        </div>
                    </div>

                    <div class="swiper-wrapper">

                        <?php foreach ($related_posts as $post) {
                            setup_postdata($post); 
                            get_template_part('template-parts/parts/part', 'ressource', array('slided' => true)); 
                        }
                    wp_reset_postdata(); ?>
                    </div>
                <?php } else {
                    echo '<p>Aucune ressource liée trouvée.</p>';
                }
                ?>
            </div>
            
            <a href="/recherche-documentaire/?boites=<?php echo $boite_slug; ?>" class="btn btn--primary">Voir toutes les ressources</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
