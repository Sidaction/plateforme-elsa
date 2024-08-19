<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Fiche pays
 //////////////////////////////////////////////////////////////*/
 $cnSite->page_type='pays';
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
 $pays=$post->post_name;
 $format=cnLib::get_main_term_slug($post->ID, 'format');
 $poi=array();
 $coord=get_post_meta($post->ID, 'loc', true);
list( $lat, $lng ) = explode( ',', $coord);
$poi[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>'', 'title'=>get_the_title());
 ?>

<section id="contentSite" class="marron pays">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="/pays-dafrique/">Pays d'afrique</a> » <a href="#"><?php the_title();?></a></div>
    </div>
     <div id="contentWrapper">
     	<div id="navTop">
           <?php $cnSite->get_fiche_nav();?> 
        </div>
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="noback">
        <h1><?php the_title();?> <span><?php echo cnLib::get_main_term($post->ID, 'region');?> </span></h1>
        
        <!-- ZONE IMAGE -->
        <div id="flagWrapper">
            <div class="flagLeft">
                <?php the_post_thumbnail('medium');?>
            </div>
            <?php $ligne_ecoute= get_post_meta($post->ID, 'ligne_ecoute', true);
				if(!empty($ligne_ecoute)):
			?><p><strong>Numéro de ligne d'écoute :</strong><br />
			<?php echo $ligne_ecoute;?></p>
            <?php endif;?>
        </div>
 		<!-- ZONE IMAGE -->
        
       <!-- INFOS GENERALES -->
        <div class="contentDetails">
        <h2>Informations générales</h2>
            <?php echo get_post_meta($post->ID, 'infos', true);?>
            <?php echo get_post_meta($post->ID, 'liens', true);?>
        </div> 
        <div class="clear"></div>
 		<!-- INFOS GENERALES -->
        <div class="contentDetails"><?php echo get_post_meta($post->ID, 'rapport', true);?></div> 
           <div class="clear"></div>
        
        
           
        <!-- ACTEURS LOCAUX -->
        <div id="acteursLocaux">
        <h2>Acteurs locaux</h2>
        <div id="acteursLocauxWrapper">
            <div class="blockActeurs left">
            <?php echo get_post_meta($post->ID, 'infoscomp', true);?>
            <!--
            <ul>
             <?php 	
             $a_cat=array(			
                    array('name' => 'Instances gouvernementales','slug' => 'instances-gouvernementales'),
                    array('name' => 'Partenaires multilatéraux & bilatéraux','slug' => 'partenaires-multilateraux-bilateraux'),
                );
                foreach($a_cat as $cat) {
                    $i = 0;
                    $args = array(
                         'post_type' => 'structure',
                         'posts_per_page' => -1,
                         'type_structure' => $cat['slug'],
                         'orderby' => 'slug',
                         'order' => 'ASC',
                         'pays_assoc' =>  $pays
                    );
                    $wp_query = new WP_Query($args);
                    if( $wp_query->have_posts() ) :
                    echo '<h3>'.$cat['name'].'</h3>';
					 $i ++;
                    while ($wp_query->have_posts()) : $wp_query->the_post();
					
                 ?>
                    <li><a href="<?php echo get_post_meta($post->ID, 'link', true);?>" target="_blank"><?php the_title();?></a></li>
                  <?php endwhile;endif;wp_reset_query();wp_reset_postdata(); $args=null; 
              } 
            ?>
            </ul>-->
            </div>
            <div class="blockActeurs" id="assoc_loc">
                <h3>Associations locales</h3>
                 <ul>
             <?php 	
             $a_cat=array(			
                    array('name' => 'Associations du réseau Elsa','slug' => 'partenaires-elsa-associations-du-reseau-elsa','orderby'=>'title'),
                    array('name' => 'Réseaux d’ONG','slug' => 'reseaux-dong', 'orderby'=>'slug'),
                    array('name' => 'Plus de contacts sur','slug' => 'plus-de-contacts-sur', 'orderby'=>'slug'),
                    array('name' => 'Réseaux de journalistes','slug' => 'reseaux-de-journalistes', 'orderby'=>'slug'),
                );
				$assos=array();
                foreach($a_cat as $cat) {
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
                    echo '<li class="titleAsso '.$cat['slug'].'"><h4>'.$cat['name'].'</h4></li>';
                    while ($wp_query->have_posts()) : $wp_query->the_post();
						$link=($cat['slug']=='partenaires-elsa-associations-du-reseau-elsa')?get_permalink():get_post_meta($post->ID, 'link', true);
						$target=($cat['slug']=='partenaires-elsa-associations-du-reseau-elsa')?'':'_blank';
						if($cat['slug']=='partenaires-elsa-associations-du-reseau-elsa') $assos[]=	$post->ID;				
                 ?>
                    <li><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php the_title();?></a></li>
                  <?php endwhile;endif;wp_reset_query();wp_reset_postdata(); $args=null; 
              } 
            ?>
            </ul>
            <script>
			jQuery( document ).ready(function() {
					if(!$('#assoc_loc li.partenaires-elsa-associations-du-reseau-elsa').length)	$('#assoc_loc h3').hide();					  
			
			})
			</script>
            </div>
            <div class="clear"></div>
        </div>
         
         
        </div> 
 		<!-- ACTEURS LOCAUX -->
        
       <!-- DOCUMENTS -->
       <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 4, 'pays_assoc' =>  $pays);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
        <div id="autresProgs">
        	<div class="titreSoulG"><h2>Documents du centre de ressources</h2></div>
            <a href="/recherche-documentaire/?totalpays=<?php echo $pays;?>" class="allDocs">» tous les documents</a>
            <div class="programmesWrapper">
            
			<?php  while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                
                
                 <div class="programmes">
					
                    <a href="<?php the_permalink();?>">
                    
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" /></div>
                    <!-- <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/video.png" /></div>
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/lien.png" /></div>
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/document.png" /></div> -->
                    
					<div class="leftProg">
						 <?php the_post_thumbnail('medium');?>
                         <div class="bubbleComments"><span><?php comments_number( '0', '1', '% ' ); ?></span></div>
						 <div class="likes"><?php echo get_post_meta($post->ID, 'like', true);?></div>
                    </div>
                    <div class="rightProg">
                        <span class="first_org"><?php echo $auteurs=$cnSite->get_authors($post->ID);?></span><br />
                        <span class="category"><?php echo cnLib::get_terms_withoutlink($post->ID, 'category');?></span><br />
                        <span class="title"><?php the_title();?></span><br />
                        <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(80); ?></span><br />
                        <!-- <?php echo cnLib::get_main_term_slug($post->ID, 'format');?> -->
                    </div>
                    </a>  
                </div> 
             <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
        	<div class="clear"></div>
            </div>
            
        </div>
         <?php endif;?> 
 		<!-- DOCUMENTS -->
        
            
       <!-- VIDEO -->
        <div id="mediasWrapper">
        <div id="videoPays">
            <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => 1, 'orderby'=>'rand', 'pays_assoc' =>  $pays, 'format'=>'video');
			$postID=array();
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
				 <h2>VIDEOS <span>EN LIGNE</span></h2>
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();
				$postID[]=$post->ID;?>
                
                 <div class="contentMedias">
				<a href="/popup-video?id=<?php echo $post->ID;?>" class='iframe-fancybox'><div class="play"></div><div class="videothumb"><?php the_post_thumbnail('medium');?></div>
					<p class="title"><?php the_title();?></p>
                    </a>  
                </div> 
             <?php endwhile;  ?>
             <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
             
             <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => -1, 'post__not_in'=>$postID,'orderby'=>'rand', 'pays_assoc' =>  $pays, 'format'=>'video');
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
                <a href="#" class="allMedias" id="btnallvideos">» toutes les vidéos</a>
             <div id="allvideos">
             <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                 <div class="contentMedias">
				<a href="/popup-video?id=<?php echo $post->ID;?>" class='iframe-fancybox'><div class="play"></div><div class="videothumb"><?php the_post_thumbnail('medium');?></div>
					<p class="title"><?php the_title();?></p>
                    </a>  
                </div> 
             <?php endwhile;  ?>
             
             
             
             </div>
             <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
             
             
              
        </div> 
 		  <!-- VIDEO -->  
          
           <!-- AUDIO -->
        <div id="podcastPays">
            <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => 1, 'pays_assoc' =>  $pays, 'format'=>'audio');
			$wp_query = new WP_Query($args);
			$postID=array();
			$asongs=array();
				if ($wp_query->have_posts()) :?>
                   <link href="<?php echo $cnSite->templatelink; ?>/_css/jplayer.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/jquery.jplayer.min.js"></script>
                
				 <h2>PODCASTS</h2>
				<?php 
				
				while ($wp_query->have_posts()) : $wp_query->the_post();
				$postID[]=$post->ID;?>
                 <div class="contentMedias">
					<?php $files = rwmb_meta( 'file', 'type=file' );
					foreach ( $files as $info )	{
						$asongs[]=$info['url'];
					};?>
                   
                   
            
            <div  class="jp-jplayer" id="podcastplayer1"></div>

            <div id="jp_container_1" class="jp-audio">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                            <!-- <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> -->
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time"></div>
                            <div class="jp-duration"></div>
                        </div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
                      
					<?php the_title();?><br />
                </div> 
             <?php endwhile; ?>
             <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>

             <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => -1, 'post__not_in'=>$postID,'orderby'=>'rand', 'pays_assoc' =>  $pays, 'format'=>'audio');
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
             
             
             <a href="#" class="allMedias" id="btnallaudios">» tous les podcasts</a>
              <div id="allaudios">
             <?php $i=1;
			 while ($wp_query->have_posts()) : $wp_query->the_post();
			 $i++;?>
                
                 <div class="contentMedias">
					
                  <?php $files = rwmb_meta( 'file', 'type=file' );				
					foreach ( $files as $info )	{
						$asongs[]=$info['url'];
					}
					?>
              <div  class="jp-jplayer" id="podcastplayer<?php echo $i; ?>"></div>              
        
            <div id="jp_container_<?php echo $i; ?>" class="jp-audio">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                            <!-- <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li> -->
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar">
                            <div class="jp-volume-bar-value"></div>
                        </div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time"></div>
                            <div class="jp-duration"></div>
                        </div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
				  
                    
					<?php the_title();?><br />
                </div> 
             <?php endwhile;  ?>
             
             </div>
             <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
             
                   <script type="text/javascript">
            //<![CDATA[
            $(document).ready(function(){
			<?php  
				 $i=0;
				 foreach( $asongs as $song ) { 
				 $i++;
			?>
            
                $("#podcastplayer<?php echo $i;?>").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {
                            mp3:"<?php echo $song;?>",
                        });
                    },
                    swfPath: "<?php echo $cnSite->templatelink; ?>/_swf",
                    solution: "flash, html",
					cssSelectorAncestor: "#jp_container_<?php echo $i;?>",
                    supplied: "mp3",
                    wmode: "window",
                    smoothPlayBar: true,
                    keyEnabled: true,
					 play: function() {
						$(".jp-jplayer").not(this).jPlayer("stop");
					},
                });
				
				 <?php  } ?>
            });
            //]]>
            </script>
             
             
             
             
             
             
             
             
        </div> 
 		  <!-- AUDIO -->  
        <div class="clear"></div>
        </div>
        
        
        <?php $cnSite->share_links();?>
               <div class="clear"></div>
        
        <hr class="shadowTop" />
          <?php $cnSite->get_fiche_nav();?> 
          <hr class="shadowBottom" />
        
        
<section id="rechercheThema">
	 <?php get_template_part( '_blocs/form', 'search' ); ?>
</section>
        
        
        </article>      
              
        <aside id="sidebarCms" class="noMargin">
        	<div class="shadowRight"></div>
          <!-- ANTENNES -->
        <div class="antennes">
       
            <?php 	
			
			$args = array('post_type' => array('antenne','structure'), 'posts_per_page' => -1, 'pays_assoc' =>  $pays);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
                        $coord=get_post_meta($post->ID, 'loc', true);
						if(!empty($coord)){
							list( $lat, $lng ) = explode( ',', $coord);
						 	$poi[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>'');
						 }
						endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
			 <?php if(!empty($poi)):?>
             	<div id="mapPays" class="fichePays"></div>
               <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			  <script type="text/javascript">
			  var imgdir=' <?php echo $cnSite->templatelink;?>';
            <?php echo 'var datas ='.json_encode($poi);?>
            </script>
  			<script type="text/javascript" src="<?php echo  $cnSite->templatelink; ?>/_js/mapantenne.js"></script>
            <?php endif;?>
        </div> 
 		  <!-- ANTENNES -->  
          
           <!-- VIE ASSOC -->
        
       
            <?php 	$args = array('post_type' => array('post','contenu'), 'posts_per_page' => 1, 'pays_assoc' =>  $pays, 'format'=>'vie-associative');
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
				<div class="vieAsso">
                 <h2>VIE ASSOCIATIVE</h2>
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                 <div>
					<a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium');?>
                    <div class="dateAsso"><?php echo get_the_date('M Y');?></div>
					<div class="titreAsso"><?php the_title();?></div>
                    <div class="excerptAsso"><?php cnLib::the_excerpt_max_charlength(50); ?></div>
                    </a>  
                </div> 
                <div class="clear"></div>
                </div> 
             <?php endwhile; endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
        
 		  <!-- VIE ASSOC --> 
          
           <!-- PHOTOS -->
       
            <?php 	/*$args = array('post_type' => array('post','contenu'), 'posts_per_page' => 4, 'pays_assoc' =>  $pays, 'format'=>'photo');
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :*/
				/// on va chercher les galeries photos des assoc du pays
				function array_random($arr, $num = 1) {
					shuffle($arr);
					
					$r = array();
					for ($i = 0; $i < $num; $i++) {
						$r[] = $arr[$i];
					}
					return $num == 1 ? $r[0] : $r;
				}
				
				$photos=array();
				foreach($assos as $asso){
					$images = get_post_meta($asso, 'diaporama', false );		
					 $photos=array_merge($photos, $images);
				}
				if(!empty($photos)) $rand_photos = array_random($photos, 7);
			
				?>
                <?php if(!empty($rand_photos)) :?>
				  <div class="galPhotos">
                 <h2><span>GALERIE</span> PHOTO</h2>
                 <ul>
				<?php $i=0;
					foreach ( $rand_photos as $imgid )	{
				
						$src = wp_get_attachment_image_src( $imgid, 'large' );
						$src = $src[0];
						$title=get_the_title($imgid);
						$class=($i==0)?'class="first"':'';
						if(!empty($src)){
							echo "<li ".$class."><div><a href='{$src}' class='fancybox' rel='diaporama' title='{$title}'><img src='{$src}' /></a></div>";
				
							echo  "</li>";
						}
						$i++;
				}?>
           
			 </ul>
             <div class="clear"></div>
        </div>  
			 <?php endif; ?>
 		  <!-- PHOTOS --> 
          
          <?php get_template_part( '_blocs/rss', 'feeds' ); ?>
         
          <?php get_template_part( '_blocs/side', 'ressources' ); ?>
                
         </aside>
        <div class="clear"></div>
        
        
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>