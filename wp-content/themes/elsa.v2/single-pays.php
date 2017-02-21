<?php 
/*
 * Fiche pays
 */


 $cnSite->page_type='pays';
 get_header(); 

 if ( have_posts() ) while ( have_posts() ) : the_post(); 
    $pays = $post->post_name;
?>



<section id="site-content" class="site-content single-ressource">

    <article class="main-content clearfix noback">
        <div class="page_title pays_title">

            <div class="wrap">
                
                <h1 class="h1">
                    <?php the_title();?>
                </h1>

                <?php echo cnLib::get_main_term($post->ID, 'region');?> 

          </div>     
        </div>


        <div class="page_content clearfix">
            <div class="wrap row">

                <div class="m-5col page_main page_copy">
                    <?php echo get_post_meta($post->ID, 'infos', true);?>
                    <?php echo get_post_meta($post->ID, 'liens', true);?>

                    <?php if(!empty($rapport_activite)): ?>
                        <a href="<?php echo $rapport_activite;?>" class="btn-inline" target="_blank">consulter le rapport d'activité</a>
                    <?php endif;?>
                    <br>
                    <a href="/recherche-documentaire/?totalpays=<?php echo $pays; ?>" class="btn-primary">Les ressources du pays</a>

                </div>

                <div class="m-3col page_aside">

                    <div class="page_media clearfix">
                        <?php the_post_thumbnail('post_thumb');?>
                    </div><!-- .page_media -->
                        
                    <?php 
                        $ligne_ecoute = get_post_meta($post->ID, 'ligne_ecoute', true);
                        if(!empty($ligne_ecoute)): ?>
                            <div class="page_metas">
                                Numéro de ligne d'écoute :
                                <?php echo $ligne_ecoute;?></p>
                            </div><!-- .page_metas -->
                    <?php endif; ?>

                </div><!-- .ressource_aside -->
            </div><!-- .wrap -->
        </div><!-- .page_content -->


    </article>


    <aside class="blocs_group--rebonds">

        <div class="wrap row page_copy">
            <div class="group_title m-2col">
                <h3 class="h3_alt">Préparer une mission</h3>
            </div>
            
            <div class="group_list m-5col m-last">
                <?php echo get_post_meta($post->ID, 'rapport', true);?>
            </div>

        </div>
    </aside>


    <?php 
        // Get acteurs locaux
        $a_cat = array(         
            array(
                'name' => 'Associations partenaires',
                'slug' => 'partenaires-elsa-associations-du-reseau-elsa',
                'orderby'=>'title'
            ),
            // array(
            //     'name' => 'Réseaux d’ONG',
            //     'slug' => 'reseaux-dong', 
            //     'orderby'=>'slug'
            // ),
            // array(
            //     'name' => 'Plus de contacts sur',
            //     'slug' => 'plus-de-contacts-sur', 
            //     'orderby'=>'slug'
            // ),
            array(
                'name' => 'Réseaux de journalistes',
                'slug' => 'reseaux-de-journalistes', 
                'orderby'=>'slug'),
        );
        $assos = array();
    ?>

   

    <aside class="blocs_group--rebonds">

      <div class="wrap row page_copy">
        <div class="group_title m-2col">
          <h3 class="h3_alt">Principaux acteurs nationaux et internationaux</h3>
        </div>
        
        <div class="group_list m-5col m-last">

            <?php 

                foreach($a_cat as $cat) :
                    $i = 0;
                    $args = array(
                         'post_type' => 'structure',
                         'posts_per_page' => -1,
                         'type_structure' => $cat['slug'],
                         'orderby' => $cat['orderby'],
                         'order' => 'ASC',
                         'pays_assoc' =>  $pays
                    );
                    $wp_query = new WP_Query($args);
                    if( $wp_query->have_posts() ) :

                        echo '<h3>' . $cat['name'] . '</h3><ul>';
                            while ($wp_query->have_posts()) : $wp_query->the_post();
                                $link = ( $cat['slug'] == 'partenaires-elsa-associations-du-reseau-elsa') ? get_permalink():get_post_meta($post->ID, 'link', true);
                                $target = ($cat['slug'] == 'partenaires-elsa-associations-du-reseau-elsa') ? '':'_blank';
                                if($cat['slug']=='partenaires-elsa-associations-du-reseau-elsa') 
                                    $assos[]=  $post->ID; ?>
                                
                                <li><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php the_title();?></a></li>
                
                  <?php endwhile; ?>
                  </ul>
                  <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; 
                endforeach; ?>

                <?php echo get_post_meta($post->ID, 'infoscomp', true); ?>


        </div>

      </div>
    </aside>


</section>



<?php endwhile; ?>
<?php get_footer(); ?>