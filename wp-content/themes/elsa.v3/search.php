<?php 
/*
 * Resultats Recherche
 * Template Name: Page Resultats Recherche
 */

    wp_enqueue_script( 'wp-api' );
    wp_enqueue_script('search');

    global $cnSite;


    $step = (empty($_GET)) ? 'start':'';
    $struct = (isset($_GET['totaltags'])) ? wp_strip_all_tags( addslashes( $_GET['totaltags'])):'';
    $keyword = '';
    $args['totaltags'] = '';


    if( !empty($_GET['filter_totaltags']) ) {
        $keyword = $_GET['filter_totaltags'];
        $args['totaltags'] = $_GET['filter_totaltags'];
    }
    else {
        if( empty($_GET['totaltags']) && !empty($_GET['tag']) ) { 
        $keyword = $_GET['tag'];
        $args['totaltags'] = $_GET['tag'];
        $structure_id = (string)(cnLib::search_ID_by_title($_GET['tag'], 'structure'));
        }
        elseif( !empty($_GET['totaltags']) ) {
        $keyword = $_GET['totaltags'];
        $args['totaltags'] = $_GET['totaltags'];
        $structure_id = (string)(cnLib::search_ID_by_title($_GET['totaltags'], 'structure'));
        } 
        else {

        }
    }

    $args['pays_assoc'] = (isset($_GET['totalpays']))?$_GET['totalpays']:'';
    $args['region'] = (isset($_GET['totalregions']))?$_GET['totalregions']:'';
    $args['category_name'] = (isset($_GET['totalcat']))?$_GET['totalcat']:'';
    $args['boiteoutils'] = (isset($_GET['boites']))?$_GET['boites']:'';
    
    if( isset($_GET['outils']) && $_GET['outils'] === '1' ) {
        // $args['tax_query'] = array(
        //     array(
        //         'taxonomy' => 'boiteoutils',
        //         'field'    => 'slug',
        //         'operator' => 'EXISTS',
        //     ),
        // );
        $args['meta_key'] = 'outil';
        $args['meta_value'] = '1';
    }


function strstr_after($haystack, $needle, $case_insensitive = false) {
    $strpos = ($case_insensitive) ? 'stripos' : 'strpos';
    $pos = $strpos($haystack, $needle);
    if (is_int($pos)) {
        return substr($haystack, $pos + strlen($needle));
    }
    // Most likely false or null
    return $pos;
}

if(strpos($keyword, "\'")) {
    $keyword = strstr_after($keyword, '\'');
}


	/// SI STRUCTURE IS SET

    if( !empty($_GET['struct']) ) { 
		$structure_id = $_GET['struct'];
	}	
	
	if( !empty($structure_id) ) { 
	 $args['meta_query'] = array(
        'relation' => 'OR',
        array(
					'key' => 'other_org',
					'value' =>  $structure_id,
				),
				array(
					'key' => 'first_org',
					'value' =>  $structure_id,
				),
				array(
					'key' => 'second_org',
					'value' =>  $structure_id,
				)
		);
	}
    else {
        $args['s'] = $keyword;	
        apply_filters_ref_array( 'posts_search', 'cn_tags_search', 500, 2 );
    }



    // SI PERIODE  IS SET
    if( isset($_GET['period']) ) {

        $period = $_GET['period'];
        switch($period){
            case '1semaine':
                $after='1 week ago';
            break;
            case '1mois':
                $after='1 month ago';
            break;
            case '3mois':
                $after='3 months ago';
            break;
            case '6mois':
                $after='3 months ago';
            break;
            case '1an':
                $after='1 year ago';
            break;
            default:
                $after='50 years ago';
            break;
        }
        $args['date_query'] = array(
            array(
                'column'        => 'post_date_gmt',
                'after'         => $after,
                'before'        => 'today',
                'inclusive'     => true,
            ));
    }



    // SI FORMAT
    if(isset($_GET['format'])) {
        $args['format'] = implode(",", $_GET['format']);
    } 
    else {
        $args['format'] = '';
    }
  


    // SETTINGS FOR QUERY

    if( !empty($_GET['posts_per_page']) ) {
        $post_per_page = $_GET['posts_per_page'];
    }
    else {
        $post_per_page = 10;
    }

    $currentpage = get_query_var('paged');
    
    $args['posts_per_page'] = $post_per_page;
    $args['post_type'] = 'post';
    $args['post_status'] = 'publish'; 
    $args['paged'] = $currentpage;

    if( isset($_GET['ref']) && $_GET['ref'] == 'search' )	$args = $_SESSION['args'];
    $_SESSION['args'] = $args;

    $results = array();

    $wp_query = new WP_Query();
    $wp_query->query($args);

    $totalpages = $wp_query->max_num_pages;
  
    function get_valuelist($values, $args){
        if(!empty($args[$values]))  {
            $values = explode(",", $args[$values]);
            
            foreach($values as $value){
                echo '<li>'.strtoupper($value).'</li>';
            }
        }
    }
  
    get_header(); 

?>

<main id="search-page">

    <section class="sec_search" style="background-image:url(<?= get_template_directory_uri(); ?>/assets/img/search/bg-search.png);">
        <div class="wrapper">
            
            <div class="sec_search_titles grid mb-l is-relative">
                <div class="t-12col m-8col">
                    <?php get_template_part('components/breadcrumb'); ?>

                    <h2 class="h2 mb-s">Votre recherche</h2>
                    <p>Il y a <span id="foundPostsLabel"><?php echo $wp_query->found_posts;?></span> résultats.</p>
                </div>
                
                <label for="help" class="on-mobile h4 help-mobile-trigger t-12col txt-right">Aide</label>
                <input type="checkbox" id="help" class="help-mobile-input on-mobile">

                <div class="sec_search_help t-12col m-4col" style="background-image:url(<?= get_template_directory_uri(); ?>/assets/img/search/bg-search-help.png);">
              
                    <h4 class="help__title h4">Aide</h4>

                    <ul class="help__links">
                        <li><a href="aide-a-la-recherche" class="js-open-modal menu-item2">Que chercher ? Comment chercher ?</a></li>
                        <li><a href="../extract" class="menu-item2">Télécharger la liste des résultats en format Excel</a></li>
                        <li><a href="../extract-word" class="menu-item2">Télécharger la liste des résultats en format Word</a></li>
                    </ul>

                </div>
            </div>

            <div class="sec_search_filters mb-m">
                <h4 class="h4 mb-m">Affiner votre recherche</h4>

                <div id="rechRess" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            
                    <div id="filtres" class="search-options">

                        <form id="search_txt_form" class="search-form is-relative mb-s" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                            <input type="search" class="input" name="filter_totaltags" placeholder="Mots clés, titre ou auteurs" name="tag" value="<?php echo $keyword; ?>"/>
                            <button class="search-form__button" type="submit">
                                <svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.8319 0.726425L20.3651 6.21277L20.4113 6.2557C20.5965 6.43929 20.7042 6.68141 20.7202 6.96748L20.7193 7.06365C20.7059 7.29026 20.6193 7.50674 20.4486 7.70073L20.384 7.76738L14.8319 13.2736C14.4213 13.6807 13.7574 13.6807 13.3468 13.2736C12.9337 12.864 12.9337 12.198 13.3467 11.7885L17.1804 7.98627L1.77257 7.98665C1.19235 7.98665 0.720215 7.51846 0.720215 6.9387C0.720215 6.35894 1.19236 5.89075 1.77256 5.89075L17.0566 5.89038L13.3468 2.21157C12.9337 1.80197 12.9337 1.13603 13.3468 0.726425C13.7574 0.31926 14.4213 0.31926 14.8319 0.726425Z" fill="white"/>
                                </svg>
                            </button>
                        </form>
                    
                        <div class="cat-filters flex gap-m">
                            <div class="is-relative">
                                <?php cnLib::custom_taxonomy_dropdown('category','input select','Thématique','','',false);?>
                                <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(0.787505 0.616308 -0.787505 0.616308 0 1.40308)" stroke="#767676"/>
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(-0.787505 0.616308 -0.787505 -0.616308 8 7.14221)" stroke="#767676"/>
                                </svg>
                            </div>
                            
                            <div class="is-relative">
                                <select class="input select" name="period" id="period">
                                    <option value="debut">Depuis le début</option>
                                    <option value="1semaine">Moins d'une semaine</option>
                                    <option value="1mois">Moins d'un mois</option>
                                    <option value="3mois">Moins de 3 mois</option>
                                    <option value="6mois">Moins de 6 mois</option>
                                    <option value="1an">Moins d'un an</option>
                                </select>
                                <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(0.787505 0.616308 -0.787505 0.616308 0 1.40308)" stroke="#767676"/>
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(-0.787505 0.616308 -0.787505 -0.616308 8 7.14221)" stroke="#767676"/>
                                </svg>
                            </div>

                            <div class="is-relative">
                                <?php cnLib::custom_taxonomies_dropdown("region, pays_assoc", "input select", "Pays",'','',false,'','pays_assoc',array(351,131,161,126,278)); ?>
                                <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(0.787505 0.616308 -0.787505 0.616308 0 1.40308)" stroke="#767676"/>
                                    <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(-0.787505 0.616308 -0.787505 -0.616308 8 7.14221)" stroke="#767676"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div><!-- #rechRess -->


            </div>

            <div class="sec_search_btns mb-l">
                <div class="tax-filters flex filter-format">
                    <div class="checkbox">
                        <input type="checkbox" class="s_checkbox <?php if ( $args['format'] === '' && !isset($_GET['outils']) ) { echo 'checked'; } ?>" id="tous" value="" name="format[]"/> 
                        <label for="tous">Tous</label>
                    </div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'pdf') !== false) { echo 'checked'; } ?> class="s_checkbox" id="doc" value="pdf"  name="format[]"/> <label for="doc">Document</label></div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'video') !== false) { echo 'checked'; } ?> class="s_checkbox" id="vids" value="video"  name="format[]"/> <label for="vids">Vidéo</label></div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'audio') !== false) { echo 'checked'; } ?> class="s_checkbox" id="audio" value="audio"  name="format[]"/> <label for="audio">Audio</label></div>
                    <div class="check-item"><input type="checkbox" <?php if ( isset($_GET['outils']) && $_GET['outils'] === '1') { echo 'checked'; } ?> class="s_checkbox" id="outils" value="outils" name="outils"/> <label for="outils">Outils <span class="icon-boite"></span></label></div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'lien') !== false) { echo 'checked'; } ?> class="s_checkbox" id="lien" value="lien" name="format[]"/> <label for="lien">Lien vers un site</label></div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'diapo') !== false) { echo 'checked'; } ?> class="s_checkbox" id="diapo" value="diapo" name="format[]"/> <label for="diapo">Diaporama</label></div>
                    <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'img') !== false) { echo 'checked'; } ?> class="s_checkbox" id="img" value="img" name="format[]"/> <label for="img">Image / visuel</label></div>
                </div>
                  
                <input type="hidden" name="totalcat" value="<?php echo $args['category_name'];?>" />
                <input type="hidden" name="totalpays" value="<?php echo $args['pays_assoc'];?>" />
                <input type="hidden" name="totalregions" value="<?php echo $args['region'];?>" />
                <input type="hidden" name="boites" value="<?php echo $args['boiteoutils'];?>" />

                <input type="hidden" name="struct" value="<?php if(isset($structure_id)) { echo $structure_id; } ?>" />
                <input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo $args['posts_per_page'];?>" />
            </div>

            <div class="sec_search_actions flex gap-m">
                <a id="btnerase" class="btn btn--secondary btn--small" href="/recherche-documentaire">Effacer tous les critères</a>
                <!-- <input type="submit" id="formatbtn" class="btn" value="Filtrer"> -->
            </div>

        </div>
    </section>

<!--     
    <section class="sec_search-pagination on-desktop">
        <div class="wrapper">
            <?php if($wp_query->found_posts > 0) :?>
              <div class="container flex space start-y">
                <div class="is-relative">
                    <select class="input select" id="pager1">
                        <option value="10" <?php if($post_per_page == '10') echo 'selected="selected"' ?>>10 résultats par page</option>
                        <option value="20" <?php if($post_per_page == '20') echo 'selected="selected"' ?>>20 résultats par page</option>
                        <option value="50" <?php if($post_per_page == '50') echo 'selected="selected"' ?>>50 résultats par page</option>
                        <option value="-1" <?php if($post_per_page == '-1') echo 'selected="selected"' ?>>Tous les résultats</option>
                    </select>
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(0.787505 0.616308 -0.787505 0.616308 0 1.40308)" stroke="#767676"/>
                        <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(-0.787505 0.616308 -0.787505 -0.616308 8 7.14221)" stroke="#767676"/>
                    </svg>
                </div>
                <div class="search-pagination">
                    <?php cnLib::pagination($totalpages); ?>
                </div>
              </div>
            <?php endif;?>
        </div>
    </section> -->

    <section class="sec_search-results">
        <div id="search-results_wrapper" class="flex column gap-xl wrapper">

            <div id="foundPosts" style="display:none" data-posts="<?php echo $wp_query->found_posts; ?>"></div>

            <?php if ( $wp_query->have_posts() ) : ?>
                <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                    <?php get_template_part('template-parts/parts/part', 'ressource'); ?>

                <?php endwhile; ?>
            <?php else : ?>
                <p>Désolé, il n'y a pas de résultats sur les critères sélectionnés</p>
            <?php endif; ?>
        </div>
    </section>


    <section class="sec_search-more is-hidden">
        <div class="wrapper">
            <button id="load_more" class="btn btn--primary">
                <span>Charger plus de ressources <br>(encore <span id="load_more_rest_to_go">0</span> ressources)</span>
            </button>
        </div>
    </section>


    <section class="sec_search-pagination">
        <div class="wrapper">
            <?php if($wp_query->found_posts > 0) :?>
              <div class="container flex space start-y">
                <div class="is-relative">
                    <select class="input select" id="pager">
                        <option value="10" <?php if($post_per_page == '10') echo 'selected="selected"' ?>>10 résultats par page</option>
                        <option value="20" <?php if($post_per_page == '20') echo 'selected="selected"' ?>>20 résultats par page</option>
                        <option value="50" <?php if($post_per_page == '50') echo 'selected="selected"' ?>>50 résultats par page</option>
                        <option value="-1" <?php if($post_per_page == '-1') echo 'selected="selected"' ?>>Tous les résultats</option>
                    </select>
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(0.787505 0.616308 -0.787505 0.616308 0 1.40308)" stroke="#767676"/>
                        <line y1="-0.5" x2="10.1587" y2="-0.5" transform="matrix(-0.787505 0.616308 -0.787505 -0.616308 8 7.14221)" stroke="#767676"/>
                    </svg>
                </div>
                <div class="search-pagination">
                    <?php cnLib::pagination($totalpages); ?>
                </div>
              </div>
            <?php endif;?>
        </div>
    </section>

</main>


<?php  
    wp_reset_query();
    wp_reset_postdata(); 
    $args = null; 
?>

<?php get_footer(); ?>
