<?php 
/*
 * Resultats Recherche
 * Template Name: Page Resultats Recherche
 */


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
	  add_filter( 'posts_search', 'cn_tags_search', 500, 2 );
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
  			$after='5 years ago';
  		break;
  	}
  	$args['date_query'] = array(
  		array(
  			'column' => 'post_date_gmt',
  			'after' => $after,
  			'before' => 'today',
  			'inclusive'         => true,
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

  <section id="site-content" class="site-content search-results">


    <article class="main-content clearfix noback">
        <div class="page_title ressource_title">

          <div class="wrap row">
              <div class="m-5col m-2col-push">
                <h1 class="h1">
                    Votre recherche
                </h1>
                Vous avez <?php echo $wp_query->found_posts;?> résultats...
              </div>
          </div>
        </div>


        <div id="" class="search_filters bg-cut blocs_group">

          <div class="wrap row">
            
            <div class="group_title m-2col dark">
              
              <h3 class="h3_alt">Affiner votre recherche</h3>

              <ul class="no-bullets">
                <li><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/" class="btn-inline">que chercher ?</a> </li>
                <li><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/" class="btn-inline">Consulter la FAQ</a></li>
                <li><a href="../extract" class="btn-inline">Télécharger la liste des résultats</a></li>
              </ul>

            </div>


            <div class="m-6col group_content">

              <form id="rechRess" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
              
                <div id="filtres" class="search-filters">

                  <div class="row">
                    <input type="search" class="plain input-bg" name="filter_totaltags" placeholder="Mots clés, titre ou auteurs" name="tag" value="<?php echo $keyword; ?>"/>
                  </div>
                  
                  <div class="row filter_group">
                    <div class="filter-thematique m-2col m-clearfix">
                      <?php cnLib::custom_taxonomy_dropdown('category','selectBox','Thématique','','',false);?>
                    </div>
                    
                    <div class="filter-date m-2col">
                        <select class="selectBox" name="period" id="period">
                          <option value="debut">Depuis le début</option>
                          <option value="1semaine">Moins d'une semaine</option>
                          <option value="1mois">Moins d'un mois</option>
                          <option value="3mois">Moins de 3 mois</option>
                          <option value="6mois">Moins de 6 mois</option>
                          <option value="1an">Moins d'un an</option>
                        </select>
                    </div>

                    <div class="filter-pays m-2col">
                      <?php cnLib::custom_taxonomies_dropdown("region, pays_assoc", "selectBox", "Pays",'','',false,'','pays_assoc',array(351,131,161,126,278)); ?>
                    </div>
                  </div>

                  <div class="row filter_group">
                    <div class="filter-format">
                      <div class="check-item"><input type="checkbox" <?php if ( $args['format'] === '' ) { echo 'checked'; } ?>  class="s_checkbox" id="tous" value="" name="format[]"/> <label for="tous">Tous</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'pdf') !== false) { echo 'checked'; } ?> class="s_checkbox" id="doc" value="pdf"  name="format[]"/> <label for="doc">Document</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'video') !== false) { echo 'checked'; } ?> class="s_checkbox" id="vids" value="video"  name="format[]"/> <label for="vids">Vidéo</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'audio') !== false) { echo 'checked'; } ?> class="s_checkbox" id="audio" value="audio"  name="format[]"/> <label for="audio">Audio</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'outils') !== false) { echo 'checked'; } ?> class="s_checkbox" id="outils" value="1" name="outils"/> <label for="outils">Outils </label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'lien') !== false) { echo 'checked'; } ?> class="s_checkbox" id="lien" value="lien" name="format[]"/> <label for="lien">Lien vers un site</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'diapo') !== false) { echo 'checked'; } ?> class="s_checkbox" id="diapo" value="diapo" name="format[]"/> <label for="diapo">Diaporama</label></div>
                      <div class="check-item"><input type="checkbox" <?php if (strpos($args['format'], 'img') !== false) { echo 'checked'; } ?> class="s_checkbox" id="img" value="img" name="format[]"/> <label for="img">Image / visuel</label></div>
                    </div>
                  </div>
                  

                  <input type="hidden" name="totaltags" value="<?php echo $args['totaltags'];?>" />
                  <input type="hidden" name="totalcat" value="<?php echo $args['category_name'];?>" />
                  <input type="hidden" name="totalpays" value="<?php echo $args['pays_assoc'];?>" />
                  <input type="hidden" name="totalregions" value="<?php echo $args['region'];?>" />
                  <input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo $args['posts_per_page'];?>" />


                  <div class="row">

                    <div id="advancedSearch" class="filter_group m-4col m-clearfix">
                      <div class="clearfix filter_subgroup">
                        <span class="meta">Mot(s) clefs filtré(s) : </span>
                        <ul id="listKeywords" class="filters_list no-bullets">
                        </ul>
                      </div>

                      <div class="clearfix filter_subgroup">
                        <span class="meta">Thématique(s) filtrée(s) : </span>
                        <ul id="listThemes" class="filters_list no-bullets">
                        </ul>
                      </div>

                      <div class="clearfix filter_subgroup">
                        <span class="meta">Pays filtré(s) : </span>
                        <ul id="listRegions" class="filters_list no-bullets">
                        </ul>
                      </div>

                      <a id="btnerase" class="btn-inline" href="#">Effacer tous les critères</a>
                    </div>

                    <div class="m-2col search_submit">
                      <input type="submit" id="formatbtn" class="btn-primary plain" value="Filtrer">

                    </div>

                  </div>
                  
                </div>

              </form>


            </div>
          </div>

        </div>


      <div class="search_list bg-cut">
        <div class="wrap ">

            <?php if($wp_query->found_posts > 0) :?>
              <div class="results_nav clearfix row">
                  <div class="nav_postperpage m-3col">
                      <select class="selectBox" id="pager1">
                          <option value="10" <?php if($post_per_page == '10') echo 'selected="selected"' ?>>10 résultats par page</option>
                          <option value="20" <?php if($post_per_page == '20') echo 'selected="selected"' ?>>20 résultats par page</option>
                          <option value="50" <?php if($post_per_page == '50') echo 'selected="selected"' ?>>50 résultats par page</option>
                          <option value="-1" <?php if($post_per_page == '-1') echo 'selected="selected"' ?>>Tous les résultats</option>
                      </select>
                  </div>
                  <div class="nav_pager-top m-5col m-last">
                      <?php cnLib::pagination($totalpages); ?>
                  </div>
              </div>
            <?php endif;?>
            

              <ul id="search_list_container" class="no-bullets">

                <?php if ( $wp_query->have_posts() ) : ?>
                
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                
                    <?php 
                      $results[] = $post->ID;
                      $cat = cnLib::get_terms_withoutlink($post->ID, 'category');
                      $pays = cnLib::get_main_term_slug($post->ID, 'pays_assoc');
                      $main_author = get_post_meta($post->ID, 'first_org', true);
                      $format = cnLib::get_main_term_slug($post->ID, 'format');

                      set_query_var( 'cat', $cat );
                      set_query_var( 'pays', $pays );
                      set_query_var( 'main_author', $main_author );
                      set_query_var( 'format', $format );
                      set_query_var( 'cnSite', $cnSite );

                      get_template_part('template-parts/parts/part', 'listitem'); ?>


                    <?php endwhile;?>
                    <?php else : ?>
                    <p>Désolé, il n'y a pas de résultats sur les critères sélectionnés</p>
                     <?php endif; 
                $_SESSION['results'] = $results; ?>

              </ul>


            <?php if($wp_query->found_posts > 0) :?>
              <div class="results_nav clearfix row">
                  <div class="nav_postperpage m-3col">
                      <select class="selectBox" id="pager2">
                          <option value="10" <?php if($post_per_page == '10') echo 'selected="selected"' ?>>10 résultats par page</option>
                          <option value="20" <?php if($post_per_page == '20') echo 'selected="selected"' ?>>20 résultats par page</option>
                          <option value="50" <?php if($post_per_page == '50') echo 'selected="selected"' ?>>50 résultats par page</option>
                          <option value="-1" <?php if($post_per_page == '-1') echo 'selected="selected"' ?>>Tous les résultats</option>
                      </select>
                  </div>
                  <div class="nav_pager-bottom m-5col m-last">
                      <?php cnLib::pagination($totalpages); ?>
                  </div>
              </div>
            <?php endif;?>
            


      <?php  
        wp_reset_query();
        wp_reset_postdata(); 
        $args = null; 
      ?>


      </div><!-- search_list -->
    </div>
     
  </section><!-- .site-content -->





<?php get_footer(); ?>
