<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
  Resulstats Recherche
  Template Name: Page Resultats Recherche
 //////////////////////////////////////////////////////////////*/
  global $cnSite;
  $step=(empty($_GET))?'start':'';
  if(empty($_GET['totaltags'])) { 
  	$args['tag'] = $_GET['tag'];
	//$args['s'] =  $_GET['tag'];
  }else{
  	$args['tag'] =  $_GET['totaltags'];
	//$args['s'] =  $_GET['totaltags'];
	}

	$args['pays_assoc'] =  $_GET['totalpays'];
	$args['region'] =  $_GET['totalregions'];
	$args['category_name'] = $_GET['totalcat'];
	if($_GET['outils']==1){
		$args['meta_query'] = array(
			array(
				'key' => 'outil',
				'value' => 1
			)
		);
	}

  /// période
  if(isset($_GET['period'])){
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
   
  ///format
  if(isset($_GET['format'])) $args['format']= implode(",", $_GET['format']);
  
  $args['post_type']='post';
  $post_per_page=10;
  if(!empty($_GET['posts_per_page']))  $post_per_page=$_GET['posts_per_page'];
  $args['posts_per_page']= $post_per_page;
  $currentpage=get_query_var('paged');
  $args['paged']=$currentpage;

	
 if($_GET['ref']=='search')	$args=$_SESSION['args'];
  $_SESSION['args']=$args;

  $results=array();
  $wp_query = new WP_Query();
  $wp_query->query($args);

  $totalpages= $wp_query->max_num_pages;
  
  
  
  function get_valuelist($values, $args){
  	if(!empty($args[$values]))  {
		$values=explode(",", $args[$values]);
		
		foreach($values as $value){
			echo '<li>'.strtoupper($value).'</li>';
		}
	}
  
  }
  
  ///

  
  get_header(); 
 ?>

<section id="contentSite" class="vert">
  <div id="breadcrumb">
    <div id="breadcrumbWrapper">Vous êtes ici » <a href="#">Accueil</a> » <a href="#"> <?php the_title();?></a></div>
  </div>
  <div id="contentWrapper">
    <div class="shadowLeft"></div>
    <div class="shadowRight"></div>
      
    
    <section id="rechercheThema" class="searchPage">
        <form id="rechRess" action="/recherche-documentaire/">
        <div id="titleRechRess">Rechercher une ressource sur le VIH / Sida</div>
        <div class="clear"></div>
            <div id="recherche">
            
            <input type="text" placeholder="Mot clé ou titre de document" name="tag" value=""/>
            <?php  cnLib::custom_taxonomy_dropdown('category','selectBox','Thématique','','',false);?>
            <?php //cnLib::custom_taxonomy_dropdown("pays_assoc", "selectBox", "Pays",'','',false,'','pays_assoc'); ?>
            <?php cnLib::custom_taxonomies_dropdown("region, pays_assoc", "selectBox", "Pays",'','',false,'','pays_assoc',array(351,131,161,126,278)); ?>
            <input type="hidden" name="totaltags" value="<?php echo $args['tag'];?>" />
            <input type="hidden" name="totalcat" value="<?php echo $args['category_name'];?>" />
            <input type="hidden" name="totalpays" value="<?php echo $args['pays_assoc'];?>" />
            <input type="hidden" name="totalregions" value="<?php echo $args['region'];?>" />

            <button>OK</button>
            <div class="clear"></div>
				<div id="advancedSearch">
					<div class="barre"></div>
					<ul id="listKeywords">
					</ul>
					<ul id="listThemes">
					</ul>
					<ul id="listRegions">
					</ul>
	        <div class="clear"></div>
					<a class="btnerase">&raquo; effacer les critères</a>
	        <div class="clear"></div>
				</div>
            </div>
       
        <div class="clear"></div>
    </section>
    
    
    <div id="filtres">
        <div><strong>Filtrer par date de mise en ligne :</strong></div>
        <div>
            <select class="selectBox" name="period" id="period">
            <option value="debut">Depuis le début</option>
            <option value="1semaine">Moins d'une semaine</option>
            <option value="1mois">Moins d'un mois</option>
            <option value="3mois">Moins de 3 mois</option>
            <option value="6mois">Moins de 6 mois</option>
            <option value="1an">Moins d'un an</option>

        </select>
       </div>
        <div class="clear"></div>
        
        
        <div><strong>Par format :</strong></div>
        <div class="check"><input type="checkbox" id="tous" value="tous" name="format[]"/> <label for="tous">Tous</label></div>
        <div class="check"><input type="checkbox" id="doc" value="doc"  name="format[]"/> <label for="doc">Document</label></div>
        <div class="check"><input type="checkbox" id="vids" value="video"  name="format[]"/> <label for="vids">Vidéo</label></div>
        <div class="check"><input type="checkbox" id="audio" value="audio"  name="format[]"/> <label for="audio">Audio</label></div>
        <div class="check"><input type="checkbox" id="outils" value="1" name="outils"/> <label for="outils">Outils <img src="<?php echo $cnSite->templatelink; ?>/_img/tools.png" width="18" height="17" /></label></div>
        <div class="check"><input type="checkbox" id="lien" value="link" name="format[]"/> <label for="lien">Lien vers un site</label></div>
        <div class="check"><input type="checkbox" id="diapo" value="diapo" name="format[]"/> <label for="diapo">Diaporama</label></div>
        <div class="check"><input type="checkbox" id="img" value="img" name="format[]"/> <label for="img">Image / visuel</label></div>
        <div><button>Filtrer</button></div>
        <div class="clear"></div>
    </div>
             

    <div class="clear"></div>
    <hr class="shadowBottom">
    <?php if($wp_query->found_posts>0) :?>
    <div class="navDlSearch">
    	<div class="dlResult"><a href="../extract">Télécharger la liste des résultats / <?php echo $wp_query->found_posts;?></a></div>
        <select class="selectBox" id="pager1">
            <option value="10">10 résultats par page</option>
            <option value="20">20 résultats par page</option>
            <option value="50">50 résultats par page</option>
            <option value="-1">Tous les résultats</option>
        </select>
        	<?php cnLib::pagination($total_page); ?>
        <div class="clear"></div>
    </div>
    <?php endif;?>
		
    <div id="listResultats">
    	<ul>
        <?php if ( $wp_query->have_posts() ) : ?>
        
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
		$results[]=$post->ID;?>
        	<li>
			 <?php $tools= get_post_meta($post->ID, 'outil', true);
			if(!empty($tools) && $tools==1):?>
              <div class="tools"></div>
              <?php endif ?>            	<a href="<?php the_permalink();?>?ref=search" class="linkProg">
                <div class="leftProg">
					 <?php the_post_thumbnail('thumbnail');?>
                     <div class="bubbleComments"><span><?php comments_number( '0', '1', '% ' ); ?></span></div>
                     <div class="likes"><?php echo get_post_meta($post->ID, 'like', true);?></div>
              	</div>
                <div class="rightProg">
                    <span class="first_org"><?php echo cnLib::get_main_term($post->ID, 'category','Général');?>  - <?php echo cnLib::get_main_term_slug($post->ID, 'pays_assoc');?></span><br />
                    <span class="title"><?php the_title();?></span><br />
                    <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(50); ?></span>
                </div>
                <div class="clear"></div>
                </a>
                <div id="dlRight">
                    <div class="logoProg">
                        <?php $main_authors= get_post_meta($post->ID, 'first_org', false);
                            if(!empty($main_authors)){
                                foreach($main_authors as $main_author){
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($main_author), 'thumbnail' );
                                    $url = $thumb['0'];
                                    $permalink = get_permalink( $main_author );
                                    if(!empty($url)) echo "<a href='{$permalink}'><img src='{$url}'  /></a>";
                                }
                            }else{
							echo '<span>'.$cnSite->get_authors($post->ID).'</span>';
							}	
                            ?>
                    </div>
                    <div class="pubProg">
                    <strong>Mis en ligne le :</strong><br />
                   <?php echo get_the_date('j M Y');?>
                    </div>
                    <div class="dlProg">
                        <a href="<?php the_permalink();?>?ref=search"></a>
                    </div>
                </div>
              <div class="clear"></div>
            </li>
            <?php endwhile; ?>
            <?php else : ?>
            <p>Désolé, il n'y a pas de résultats sur les critères sélectionnés</p>
             <?php endif; 
			  $_SESSION['results']=$results;
			
			 
			 ?>

        </ul>
    </div>
   <?php if($wp_query->found_posts>0) :?> 
    <div class="navDlSearch">
    	<div class="dlResult"><a href="../extract">Télécharger la liste des résultats / <?php echo $wp_query->found_posts;?></a></div>
        <select class="selectBox" id="pager2">
            <option value="10">10 résultats par page</option>
            <option value="20">20 résultats par page</option>
            <option value="50">50 résultats par page</option>
            <option value="-1">Tous les résultats</option>
        </select>
        <?php cnLib::pagination($total_page); ?>
        <div class="clear"></div>
    </div><?php endif;?>
    
  </div>
  
  
  </form>
  
</section>
<script>

$(window).ready(function(){

		$("#period").change(function(){$('#rechRess').submit()});	
		$("#pager1").change(function(){$('#rechRess').submit()});	
		$("#pager2").change(function(){$('#rechRess').submit()});	

 })
</script>

<?php get_footer(); ?>
