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


  /// SI STRUCTURE IS SET

  if( empty($_GET['totaltags']) && !empty($_GET['tag']) ) { 
  	$keyword = $_GET['tag'];

  	$args['totaltags']=$_GET['tag'];
  	$structure_id= (string)(cnLib::search_ID_by_title($_GET['tag'], 'structure'));
  	
  }
  elseif( !empty($_GET['totaltags']) ) {
    $keyword = $_GET['totaltags'];
    $args['totaltags']=$_GET['totaltags'];
    $structure_id= (string)(cnLib::search_ID_by_title($_GET['totaltags'], 'structure'));
  }

	$args['pays_assoc'] = (isset($_GET['totalpays']))?$_GET['totalpays']:'';
	$args['region'] = (isset($_GET['totalregions']))?$_GET['totalregions']:'';
	$args['category_name'] = (isset($_GET['totalcat']))?$_GET['totalcat']:'';
	
  $args['category_name'] = (isset($_GET['category']))?$_GET['category']:'';
  $args['region'] = (isset($_GET['totalregions']))?$_GET['totalregions']:'';


  /// SI OUTILS IS CHECK
  if(isset($_GET['outils']) && $_GET['outils']==1){
		$args['meta_query'] = array(
			array(
				'key' => 'outil',
				'value' => 1
			)
		);
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
	  add_filter( 'posts_search', 'cn_tags_search', 500, 2 );
	  //add_filter('posts_where','tag_search_where');
    //add_filter('posts_join', 'tag_search_join');
 		//add_filter('posts_groupby', 'tag_search_groupby');
  }


  // SI PERIODE  IS SET
  if( isset($_GET['period']) ) {

  	$period=$_GET['period'];
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
  if(isset($_GET['format'])) $args['format'] = implode(",", $_GET['format']);
  


  // SETTINGS FOR QUERY

  if(!empty($_GET['posts_per_page'])) {
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

  var_dump($args);

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
        <div class="page_title archives_title">

          <div class="wrap">
              <h1 class="h1">
                  Votre recherche
              </h1>
              Vous avez <?php echo $wp_query->found_posts;?> résultats...
          </div>     
        
        </div>

        <div class="search_filters bg-cut blocs_group">

          <div class="wrap row">
            
            <div class="group_title m-2col dark">
              
              <h4 class="h4">Affiner votre recherche</h4>

              <ul class="no-bullets">
                <li><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» que chercher ?</a> </li>
                <li><a href="<?php echo $cnSite->rootlink; ?>/aide-a-la-recherche/">» Consulter la FAQ</a></li>
                <li><a href="../extract">» Télécharger la liste des résultats</a></li>
              </ul>

            </div>
            

            <div class="m-6col group_content">

              <form id="rechRess" action="">
              
                <div id="filtres" class="search-filters">

                  <div class="row">
                    <input type="search" placeholder="Mots clés, titre ou auteurs" name="tag" value="<?php echo $keyword; ?>"/>
                  </div>
                  
                  <div class="row">
                    <div class="filter-thematique m-2col">
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

                  <div class="row">
                    <div class="filter-format">
                      <div class="check-item"><input type="checkbox" id="tous" value="" name="format[]"/> <label for="tous">Tous</label></div>
                      <div class="check-item"><input type="checkbox" id="doc" value="pdf"  name="format[]"/> <label for="doc">Document</label></div>
                      <div class="check-item"><input type="checkbox" id="vids" value="video"  name="format[]"/> <label for="vids">Vidéo</label></div>
                      <div class="check-item"><input type="checkbox" id="audio" value="audio"  name="format[]"/> <label for="audio">Audio</label></div>
                      <div class="check-item"><input type="checkbox" id="outils" value="1" name="outils"/> <label for="outils">Outils </label></div>
                      <div class="check-item"><input type="checkbox" id="lien" value="lien" name="format[]"/> <label for="lien">Lien vers un site</label></div>
                      <div class="check-item"><input type="checkbox" id="diapo" value="diapo" name="format[]"/> <label for="diapo">Diaporama</label></div>
                      <div class="check-item"><input type="checkbox" id="img" value="img" name="format[]"/> <label for="img">Image / visuel</label></div>
                    </div>
                  </div>
                  

                  <input type="hidden" name="totaltags" value="<?php echo $args['totaltags'];?>" />
                  <input type="hidden" name="totalcat" value="<?php echo $args['category_name'];?>" />
                  <input type="hidden" name="totalpays" value="<?php echo $args['pays_assoc'];?>" />
                  <input type="hidden" name="totalregions" value="<?php echo $args['region'];?>" />
                  <input type="hidden" id="posts_per_page" name="posts_per_page" value="<?php echo $args['posts_per_page'];?>" />


                  <div id="advancedSearch">
                    <div class="barre"></div>
                    <ul id="listKeywords"></ul>
                    <ul id="listThemes"></ul>
                    <ul id="listRegions"></ul>
                    <a class="btnerase" href="#">&raquo; effacer les critères</a>
                  </div>

                  <div><button id="formatbtn" class="btn-primary">Filtrer</button></div>

                </div>

              </form>


            </div>
          </div>

        </div>


      <div class="search_list bg-cut">
        <div class="wrap ">

            <?php if($wp_query->found_posts > 0) :?>
            <div class="navDlSearch results_nav clearfix">
              
                <select class="selectBox" id="pager1">
                    <option value="10">10 résultats par page</option>
                    <option value="20">20 résultats par page</option>
                    <option value="50">50 résultats par page</option>
                    <option value="-1">Tous les résultats</option>
                </select>

                <?php cnLib::pagination($totalpages); ?>

            </div>
            <?php endif;?>
            

              <ul class="no-bullets">

                <?php if ( $wp_query->have_posts() ) : ?>
                
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                
                  <?php $results[]=$post->ID;?>
                    <li class="search-item">
                        <a href="<?php the_permalink();?>?ref=search" class="linkProg">
                        
                          <span class="title"><?php the_title();?></span>
                          
                          <?php
                            $cat = cnLib::get_terms_withoutlink($post->ID, 'category');
                            $pays = cnLib::get_main_term_slug($post->ID, 'pays_assoc');

                            if(!empty($cat) or !empty($pays)) : ?>
                              <span class="first_org">
                                <?php if(!empty($cat)) echo $cat ;?><?php if(!empty($cat) && !empty($pays)) echo  ' - ';?><?php echo $pays;?></span>
                            <?php endif; ?>

                        </a>

                        <?php
                          $main_author= get_post_meta($post->ID, 'first_org', true);
                                
                          if(!empty($main_author)){
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($main_author), 'thumbnail' );
                            $url = $thumb['0'];
                            $permalink = get_permalink( $main_author );
                            if(!empty($url)) echo "<a href='{$permalink}'><img src='{$url}'  /></a>";
                          }
                          else {
                            echo '<span>'.$cnSite->get_authors($post->ID).'</span>';
                          } ?>
                      
                            <strong>Mis en ligne le :</strong><br />
                           <?php echo get_the_date('j M Y');?>


                            <div class="dlProg">
                                <a href="<?php the_permalink();?>?ref=search"><img src="<?php echo $cnSite->templatelink; ?>/_img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" /></a>
                            </div>
                        </div>

                    </li>
                    <?php endwhile;?>
                    <?php else : ?>
                    <p>Désolé, il n'y a pas de résultats sur les critères sélectionnés</p>
                     <?php endif; 
                $_SESSION['results'] = $results; ?>

              </ul>


            <?php if($wp_query->found_posts > 0) :?>
            <div class="navDlSearch results_nav clearfix">
              
                <select class="selectBox" id="pager1">
                    <option value="10">10 résultats par page</option>
                    <option value="20">20 résultats par page</option>
                    <option value="50">50 résultats par page</option>
                    <option value="-1">Tous les résultats</option>
                </select>

                <?php cnLib::pagination($totalpages); ?>

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



  <script type="text/javascript">
  $(window).ready(function(){
    $('#pager1 option[value="<?php echo $args['posts_per_page'];?>"]').prop('selected', true);
    $('#pager2 option[value="<?php echo $args['posts_per_page'];?>"]').prop('selected', true);
  })
  </script>




<?php get_footer(); ?>
