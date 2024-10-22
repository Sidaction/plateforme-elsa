<?php 
/*
 * Page détail d'une Boite à outils
 */

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

</main>




    <section id="site-content" class="site-content">

        <article class="main-content clearfix">
            <div class="page_title ressource_title">

                <div class="wrap row">
                    <h1 class="h1 m-5col m-clearfix">
                        <?php echo single_cat_title("", false); ?>
                    </h1>  
                </div>     
            </div>


            <div class="page_content clearfix">
                <div class="wrap row">
                    <div class="m-5col page_main page_copy">
                        <?php echo wpautop($presentation); ?>
                    </div>

                    <div class="m-3col page_aside m-last">

                        <?php if( $image ) { ?>
                            <div class="page_media clearfix">
                                <?php echo wp_get_attachment_image( $image, $size ); ?>
                            </div>
                        <?php } ?>
        
                        <?php if( isset($tags_linked) || isset($boites_linked) ) : ?>
                                <div class="page_metas">
                                    
                                    <?php if( isset($themes_linked) && !empty($themes_linked) ) : ?>
                                        <div class="page_metas_row">
                                            <span>Thématiques : </span>

                                            <ul>

                                            <?php foreach( $themes_linked as $term ): ?>
                                                <li><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                                            <?php endforeach; ?>

                                            </ul>

                                        </div>
                                    <?php endif; ?>


                                    <?php if( isset($tags_linked) && !empty($tags_linked) ) : ?>
                                        <div class="page_metas_row">
                                            <span>Mots clefs : </span>

                                            <ul>

                                            <?php foreach( $tags_linked as $term ): ?>
                                                <li><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>
                                            <?php endforeach; ?>

                                            </ul>

                                        </div>
                                    <?php endif; ?>

                                </div>
                        <?php endif; ?>

                        <div class="page_actions">
                            <a href="#recommandations" class="scroll btn-primary plain">Les ressources recommandées</a>
                            <a href="/recherche-documentaire/?boites=<?php echo $boite_slug; ?>" class="btn-secondary plain">Toutes les ressources de la boîte à outils</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>

            
        <div id="" class="blocs_group bg-cut">
            <div class="wrap row">

                <div class="group_title grid-title m-2col">
                    <h3 id="recommandations" class="h3_alt">La plateforme ELSA vous recommande</h3>
                </div>


                <div class="group_list grid-list">
         
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
                    $grille_posts = get_posts($args);

                    if( $grille_posts ) : 
                        $i = 0; 
                        foreach ( $grille_posts as $post ) : setup_postdata( $post ); ?>

                                <?php 
                                    $format = cnLib::get_main_term_slug($post->ID, 'format');
                                    switch ($format) {
                                        case 'video':
                                            $type = 'media';
                                            break;
                                        case 'audio':
                                            $type = 'media';
                                            break;
                                        case 'diaporama':
                                            $type = 'media';
                                            break;
                                        default:
                                            $type = 'ressource';
                                            break;
                                    }
                                ?>

                                <?php if( $i == 0 ) : ?>
                                    <div class="m-2col">
                                        <?php set_query_var( 'type', $type ); ?>
                                        <?php set_query_var( 'cnSite', $cnSite ); ?>

                                <?php elseif ( $i % 2 == 0 ) : ?>
                                    <div class="m-4col m-clearfix">
                                        <?php set_query_var( 'type', $type ); ?>
                                        <?php set_query_var( 'cnSite', $cnSite ); ?>

                                <?php else : ?>
                                    <div class="m-4col">
                                        <?php set_query_var( 'type', $type ); ?>

                                <?php endif; ?>

                                        <?php get_template_part('template-parts/parts/part', 'bloc'); ?>

                                    </div><!-- end .col -->


                            <?php $i++; ?>
                                

                            <?php endforeach; 
                            wp_reset_postdata();

                        else : ?> 
                            <p class="m-5col m-1col-push page_text">
                                <br>Il n'y a aucune ressource recommandée pour cette boîte à outils. <br>
                                <a href="/soumettre-une-ressource" class="">Souhaitez-vous nous en soumettre une ? </a></p>

                        <?php endif; ?>

                    </div>

                    <div class="row group_action">
                        <a href="/recherche-documentaire/?boites=<?php echo $boite_slug; ?>" class="btn-secondary is-centered">Toutes les ressources de la boîte à outils</a>
                    </div> 
                    
                </div><!-- .wrap -->

            </div><!-- .blocs_group -->

         </div>
     </div>




</section>
<?php get_footer(); ?>
