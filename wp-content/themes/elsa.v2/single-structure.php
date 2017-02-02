<?php 
/*
 * Fiche structure
 */

$cnSite->page_type='structure';	
get_header(); 

if ( have_posts() ) while ( have_posts() ) : the_post(); 
 $structure = $post->post_name;
 $structure_id = $post->ID;
 $pays = cnLib::get_main_term_slug($post->ID, 'pays_assoc');
 $link = get_post_meta($post->ID, 'link', true);
 $link2 = get_post_meta($post->ID, 'link2', true);
 $email = get_post_meta($post->ID, 'email', true);
 $antenne = get_post_meta($post->ID, 'antenne', true);
 $ligne = get_post_meta($post->ID, 'ligne', true);
 $rapport_activite = get_post_meta($post->ID, 'rapport_activite', true);

 $web = get_post_meta($post->ID, 'web', true);

?>
 
 


  <section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        <div class="page_title structure_title">

          <div class="wrap">
              <h1 class="h1">
                  <?php the_title();?>
              </h1> 
              <?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?>

          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="m-5col page_main">
                    <?php the_content();?>
                    
                    <?php if(!empty($rapport_activite)): ?>
                        <a href="<?php echo $rapport_activite;?>" target="_blank">» consulter le rapport d'activité</a>
                    <?php endif;?>
                </div>

                <div class="m-3col page_aside">


                    <?php $images = get_post_meta($structure_id, 'diaporama', false ); ?>
                    <?php if( isset($images) && !empty($images) ) : ?>

                        <div class="page_media">

                            <div id="slider_outer" class="slider_outer">
                                <ul class="no-bullets clearfix bxslider">
                                    <?php $i = 0;

                                    foreach ( $images as $img_id )   {
                                      
                                        $src = wp_get_attachment_image_src( $img_id, 'large' );
                                        $src = $src[0];
                                        $title = get_the_title($img_id);
                                        $class = ($i==0) ? 'class="first"':'';

                                        echo "<li ".$class."><img src='{$src}' /></li>";

                                        $i++;
                                    } ?>
                                </ul>
                                <a href="#" id="js-sliderfull" class="btn-inline-little">Voir en plein écran</a>
                            </div>
                        
                        </div><!-- .page_media -->
                    <?php endif; ?>


                    <div class="page_metas">

                        <div class="page_metas_row clearfix logo">
                            <?php the_post_thumbnail('medium'); // LOGO ASSOCIATION ?>
                        </div>

                        <?php if( count(wp_get_object_terms( $post->ID, 'activites')) > 0 ) : ?>
                            <div class="page_metas_row">
                                <span>Domaine(s) d'intervention : </span><?php echo cnLib::get_terms_withoutlink($post->ID, "activites",", ");?>
                            </div>
                        <?php endif; ?> 
        
                        <?php if( count(wp_get_object_terms( $post->ID, 'public_cibles')) > 0 ) : ?>
                            <div class="page_metas_row">
                                <span>Public(s) : </span><?php echo cnLib::get_terms_withoutlink($post->ID, "public_cibles", ", "); ?>
                            </div>
                        <?php endif; ?> 

                        <?php if( isset($antenne) && $antenne != '' ) : ?>
                            <div class="page_metas_row">
                                <span>Antenne(s) : </span><?php echo $antenne; ?>
                            </div>
                        <?php endif; ?> 


                        <ul class="page_metas_row contacts no-bullets">
                            <span>Contacts : </span>
                            <li class="contact-item">

                            <span class="icon-arrow_right"></span>
                            <?php echo get_post_meta($post->ID, 'adresse', true);?> <?php echo get_post_meta($post->ID, 'cp', true);?> <?php echo get_post_meta($post->ID, 'ville', true);?>, <?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?>

                            <li class="contact-item">
                                <span class="icon-arrow_right"></span> Tel. : <?php echo get_post_meta($post->ID, 'tel', true);?>
                            </li>

                            <?php if(!empty($ligne)): ?>
                                <li class="contact-item"><span class="icon-arrow_right"></span> Ligne d'écoute : <?php echo($ligne);?></li>
                            <?php endif; ?>
                            
                            <?php if(!empty($link)):?>
                                <li class="contact-item">
                                    <span class="icon-arrow_right"></span>
                                    <a href="<?php echo $link;?>" target="_blank" class=""><?php echo $link;?></a></li>
                            <?php endif;?>

                            <?php if(!empty($email)):?>
                                <li class="contact-item">
                                    <span class="icon-arrow_right"></span>
                                    <a href="mailto:<?php echo $email;?>" class=""><?php echo $email;?></a></li>
                            <?php endif;?>

                            <?php if(!empty($link2)):?>
                                <li class="contact-item">
                                    <span class="icon-arrow_right"></span>
                                    <a href="<?php echo $link2;?>" target="_blank" class=""><span class="icon-facebook"></span></a></li>
                            <?php endif;?>

                        </ul>

                    </div><!-- .page_metas -->

                </div><!-- .page_aside -->
            </div><!-- .wrap -->
        </div><!-- .page_content -->



                <?php
                    $args = array(
                        'post_type' => array('post'), 
                        'posts_per_page' => 6, 
                        'meta_query' => array (
                            'relation' => 'OR',
                            array(
                                'key' => 'first_org',
                                'value' =>  $structure_id,
                            ),
                            array(
                                'key' => 'second_org',
                                'value' =>  $structure_id,
                            ),
                            array(
                                'key' => 'other_org',
                                'value' =>  $structure_id,
                            )
                        )
                    );
                    $grille_posts = get_posts($args);

                    if( !empty( $grille_posts ) ) :
                        $i = 0; ?>


                        <div id="" class="blocs_group">
                            <div class="wrap row">

                                <div class="group_title grid-title m-2col">
                                    <h3 id="recommandations" class="h3_alt">Les ressources de l'association</h3>
                                </div>


                                <div class="group_list grid-list">
         

                        <?php foreach ( $grille_posts as $post ) : setup_postdata( $post ); 

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


                    <?php 
                    
                        $i++; 
                        endforeach; 
                        wp_reset_postdata(); ?>


                                </div>

                                <div class="group_action row">
                                    <a href="/recherche-documentaire/?struct=<?php echo $structure_id;?>" class="btn-secondary">Les ressources de l'association</a>
                                </div> 
                                
                            </div><!-- .wrap -->

                        </div><!-- .blocs_group -->


                    <?php endif; ?>



    </article>



    <?php 
        // Get "Sur le web"
        if( !empty($web) ) : ?>

        <aside class="blocs_group--rebonds">

          <div class="wrap row">
            <div class="group_title m-2col">
              <h3 class="h3_alt">L'association dans d'autres médias</h3>
            </div>
            
            <div class="group_list m-5col m-last">
              <?php  echo $web; ?>
            </div>

          </div>
        </aside>

    <?php endif; ?>



    <?php 
        // Get other associations
        $args = array(
            'post_type' => 'structure',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
            'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa',
            'pays_assoc' => $pays,
            'post__not_in' =>array($structure_id)
        );
        $wp_query = new WP_Query($args);
         
        if( $wp_query->have_posts() ) : ?>

            <aside class="blocs_group--rebonds">

              <div class="wrap row">
                <div class="group_title m-2col">
                  <h3 class="h3_alt">Les autres associations partenaires locales</h3>
                </div>
                
                <div class="group_list m-5col m-last">
                    <ul>
                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                        <li>
                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                </div>

              </div>
            </aside>
        
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        <?php wp_reset_postdata(); ?>
        <?php $args = null; ?>

</section>


    <?php get_template_part('template-parts/content', 'rebonds'); ?>


<?php endwhile; ?>
<?php get_footer(); ?>