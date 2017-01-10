<?php 
/*
 * Fiche structure
 */

$cnSite->page_type='structure';	
get_header(); 

if ( have_posts() ) while ( have_posts() ) : the_post(); 
 $structure=$post->post_name;
 $structure_id=$post->ID;
 $pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');
 $link=get_post_meta($post->ID, 'link', true);
 $link2=get_post_meta($post->ID, 'link2', true);
 $email=get_post_meta($post->ID, 'email', true);
 $ligne=get_post_meta($post->ID, 'ligne', true);
 $rapport_activite=get_post_meta($post->ID, 'rapport_activite', true);

 $web = get_post_meta($post->ID, 'web', true);

?>
 
 


  <section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        <div class="page_title ressource_title">

            <!-- <div id="breadcrumb">
            <div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#"> <?php echo cnStrings::stripString(get_the_title(),80);?></a></div>
          </div> -->

          <div class="wrap">
              <h1 class="h1">
                  <?php the_title();?>
              </h1> 
              <?php echo get_post_meta($post->ID, 'adresse', true);?> <?php echo get_post_meta($post->ID, 'cp', true);?> <?php echo get_post_meta($post->ID, 'ville', true);?>

          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="m-5col">
                    <?php the_content();?>
                    
                    <?php if(!empty($rapport_activite)): ?>
                        <a href="<?php echo $rapport_activite;?>" target="_blank">» consulter le rapport d'activité</a>
                    <?php endif;?>

                </div>

                <div class="m-3col page_aside">

                    <div class="page_media">

                        <?php
                            $diapo = get_post_field('diaporama', $structure_id);
                            if($diapo != '') { ?>
                        
                                 <ul class="no-bullets">
                                 <?php 
                                    $images = get_post_meta($structure_id, 'diaporama', false );
                                    $images = implode( ',' , $images );
                                    $images = $wpdb->get_col( "
                                        SELECT ID FROM {$wpdb->posts}
                                        WHERE post_type = 'attachment'
                                        AND ID in ({$images})
                                        ORDER BY menu_order ASC
                                    " );
                                    $i = 0;
                                    function array_random($arr, $num = 1) {
                                        shuffle($arr);
                                        
                                        $r = array();
                                        for ($i = 0; $i < $num; $i++) {
                                            $r[] = $arr[$i];
                                        }
                                        return $num == 1 ? $r[0] : $r;
                                    }
                                    if( !empty($images) )
                                        $images = array_random($images, 7);
                                    
                                    foreach ( $images as $imgid )   {
                                
                                        $src = wp_get_attachment_image_src( $imgid, 'large' );
                                        $src = $src[0];
                                        $title=get_the_title($imgid);
                                        $class=($i==0)?'class="first"':'';
                                        echo "<li ".$class."><div><a href='{$src}' class='fancybox' rel='diaporama' title='{$title}'><img src='{$src}' /></a></div>";
                            
                                        echo  "</li>";
                                        $i++;
                                    } ?>
                             
                             </ul>

                        <?php } ?>
                            
                    </div><!-- .page_media -->
                    


                    <div class="page_metas">
                        
                        <?php the_post_thumbnail('medium'); // LOGO ASSOCIATION ?>

                        <?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?>

                        <?php if( count(wp_get_object_terms( $post->ID, 'activites')) > 0 ) : ?> 
                            <li>Activité(s) : <?php echo cnLib::get_terms_withoutlink($post->ID, "activites",", ");?></li>
                        <?php endif; ?> 
        
                        <?php if( count(wp_get_object_terms( $post->ID, 'public_cibles')) > 0 ) : ?>
                            <li>Public(s) : <?php echo cnLib::get_terms_withoutlink($post->ID, "public_cibles", ", "); ?></li>
                        <?php endif; ?> 

                        <ul class="contacts no-bullets">
                            <strong>Contacts :</strong>
                            <li>Tel. : <?php echo get_post_meta($post->ID, 'tel', true);?></li>

                            <?php if(!empty($ligne)): ?>
                                <li>Ligne d'écoute : <?php echo($ligne);?></li>
                            <?php endif; ?>
                            
                            <?php if(!empty($link)):?>
                                <li><a href="<?php echo $link;?>" target="_blank">Site internet</a></li>
                            <?php endif;?>

                            <?php if(!empty($link2)):?>
                                <li><a href="<?php echo $link2;?>" target="_blank">Page Facebook</a></li>
                            <?php endif;?>

                            <?php if(!empty($email)):?>
                                <li><a href="mailto:<?php echo $email;?>">email</a></li>
                            <?php endif;?>
                        </ul>


                    </div><!-- .page_metas -->


                </div><!-- .ressource_aside -->
            </div><!-- .wrap -->
        </div><!-- .page_content -->


        <?php   
            $args = array('post_type' => array('post'), 'posts_per_page' => 4, 
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
        $wp_query = new WP_Query($args); ?>
         
        <?php if ($wp_query->have_posts()) : ?>        

            <aside class="blocs_group">

                <div class="wrap row">
                    <div class="group_title m-2col">
                      <h3 class="A lire aussi">Les ressources de cette association</h3>
                    </div>
                    
                    <div class="group_list m-6col">
                        <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                            <a href="<?php the_permalink();?>">
                        
                                <img src="<?php echo $cnSite->templatelink; ?>/_img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" />                  
                                <?php echo $auteurs=$cnSite->get_authors($post->ID);?>
                                <?php echo cnLib::get_terms_withoutlink($post->ID, 'category');?>
                                <?php the_title(); ?>

                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="wrap row">
                    <a href="/recherche-documentaire/?struct=<?php echo $structure_id;?>" class="is-centered btn-secondary">Voir toutes les ressources</a>
                </div>
                  
            </aside>

        <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>

    </article>



    <?php 
        // Get "Sur le web"
        if( !empty($web) ) : ?>

        <aside class="blocs_group--rebonds">

          <div class="wrap row">
            <div class="group_title m-2col">
              <h3 class="A lire aussi">Sur le web</h3>
            </div>
            
            <div class="group_list m-6col">
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
                  <h3 class="h3">Autres associations du réseau Elsa</h3>
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


  </div>
</section>




<?php endwhile; ?>
<?php get_footer(); ?>