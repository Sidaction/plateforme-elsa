<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Fiche structure
 //////////////////////////////////////////////////////////////*/
  $cnSite->page_type='structure';	
 get_header(); ?>
 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
 $structure=$post->post_name;
 $structure_id=$post->ID;
 $pays=cnLib::get_main_term_slug($post->ID, 'pays_assoc');
 $link=get_post_meta($post->ID, 'link', true);
 $link2=get_post_meta($post->ID, 'link2', true);
 $email=get_post_meta($post->ID, 'email', true);
 $ligne=get_post_meta($post->ID, 'ligne', true);
 $rapport_activite=get_post_meta($post->ID, 'rapport_activite', true);
 ?>
 <?php 	
			$antennes=array();
			$coord=get_post_meta($post->ID, 'loc', true);
			list( $lat, $lng ) = explode( ',', $coord);
			$antennes[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>$slug, 'title'=>get_the_title());
			$antennes_lib=array();
			$args = array('post_type' => array('antenne'), 'posts_per_page' => -1, 'meta_query' => array(
							array(
								'key' => 'struct',
								'value' =>  $structure_id,
							))
			
			
			);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
                        $coord=get_post_meta($post->ID, 'loc', true);
						list( $lat, $lng ) = explode( ',', $coord);
						$antennes_lib[]=get_the_title();
						$antennes[] = array('lat'=> $lat, 'lng'=> $lng, 'slug'=>$slug, 'title'=>get_the_title());
						endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
 
 
<section id="contentSite" class="marronclair structure">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="/associations-africaines-du-reseau-elsa/">Associations</a> » <a href="#"><?php the_title();?></a></div>
    </div>
     <div id="contentWrapper">
     	<div id="navTop">
             <?php $cnSite->get_fiche_nav();?> 
        </div>
     	<div class="shadowLeft"></div>
        <div class="shadowRight"></div>
        <article class="noback">
        <h1><?php the_title();?></h1>
        
        <!-- ZONE IMAGE -->
        <div id="infosStructure">
        	<div class="thumbStructure"><?php the_post_thumbnail('medium');?></div>
            <strong><?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?></strong><br /><br />
           
          
            <?php if(!empty($link)):?><a href="<?php echo $link;?>" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/_img/i_web.png" /></a><?php endif;?>
            <?php if(!empty($link2)):?><a href="<?php echo $link2;?>" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/_img/i_fb.png" /></a><?php endif;?>
             <?php if(!empty($email)):?><a href="mailto:<?php echo $email;?>"><img src="<?php echo $cnSite->templatelink; ?>/_img/i_mail.png" /></a><?php endif;?>
              
        </div> 
 		<!-- ZONE IMAGE -->
        
        
       <!-- INFOS GENERALES -->
       
       	<div class="contentDetails">
        <span><?php if( count(wp_get_object_terms( $post->ID, 'activites')) > 0 ) echo 'Activité(s) :'?></span> <?php echo  cnLib::get_terms_withoutlink($post->ID, "activites",", ");?><br />
        <span><?php if( count(wp_get_object_terms( $post->ID, 'public_cibles')) > 0 ) echo 'Publics cibles :'?></span> <?php echo  cnLib::get_terms_withoutlink($post->ID, "public_cibles", ", ");?><br />
        
        <?php if(!empty($rapport_activite)): ?><a href="<?php echo $rapport_activite;?>" target="_blank">» consulter le rapport d'activité</a><?php endif;?>
        </div> 
        
           <div class="contentDetails2">
         <span>Contact Siège :</span> <?php echo get_post_meta($post->ID, 'adresse', true);?> <?php echo get_post_meta($post->ID, 'cp', true);?> <?php echo get_post_meta($post->ID, 'ville', true);?><br />
  <span>Tel. :</span> <?php echo get_post_meta($post->ID, 'tel', true);?>
  <?php if(!empty($antennes_lib)):?><br /><span>Antennes : </span> <?php echo implode(', ', $antennes_lib);?><br /><?php endif;?>
  <?php if(!empty($ligne)):?><br /><span>Ligne d'écoute :</span> <?php echo($ligne);?><?php endif;?></div> 
        <div class="clear"></div>
     
 		<!-- INFOS GENERALES -->
        
        <!-- CONTENU -->
        <div id="acteursLocaux">
        <h2>Présentation</h2>
		<div id="acteursLocauxcontent"><?php the_content();?> </div>
        </div>
        <!-- CONTENU -->
                
       <!-- DOCUMENTS -->
        <div id="autresProgs">
        	
            <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 4, 
						'meta_query' => array(
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
							))
			);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
				
				<div class="titreSoulG"><h2>Documents du centre de ressources</h2></div>
        	<a href="/recherche-documentaire/?struct=<?php echo $structure_id;?>" class="allDocs">» tous les documents</a>
            
            <div class="programmesWrapper">
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                 <div class="programmes">
					<a href="<?php the_permalink();?>">
                    
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/<?php echo cnLib::get_main_term_slug($post->ID, 'format');?>.png" /></div>
                    <!-- <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/video.png" /></div>
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/lien.png" /></div>
                    <div class="format"><img src="<?php echo $cnSite->templatelink; ?>/_img/document.png" /></div> -->
                    
                   <div class="leftProg">
						 <?php the_post_thumbnail('medium');?>
                         <div class="bubbleComments"><span><?php comments_number( '0', '1', '% ' ); ?></span></div>
						 <div class="likes"><?php echo get_post_meta($post->ID, 'like', true);?></div>
                    </div>
                    <div class="rightProg">
                        <span class="first_org"><?php echo $auteurs=$cnSite->get_authors($post->ID);?></span><br />
                        <span class="category"><?php echo cnLib::get_terms_withoutlink($post->ID, 'category');?></span><br />
                        <span class="title"><?php the_title();?></span><br />
                        <span class="excerpt"><?php cnLib::the_excerpt_max_charlength(50); ?></span><br />
                        <!-- <?php echo cnLib::get_main_term_slug($post->ID, 'format');?> -->
                    </div>
                    </a>  
                </div> 
             <?php endwhile; ?> <div class="clear"></div>
             
            
            </div>
             <?php endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
             
        </div> 
 		<!-- DOCUMENTS -->
        
        
       
        
            
       <!-- VIDEO -->
        <div id="mediasWrapper">
        <div id="videoPays">
       
            <?php 	
					$args = array('post_type' => array('contenu'), 'posts_per_page' => 1, 'orderby'=>'rand' ,  'format'=>'video','meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
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
							
							)
					);
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
                 <?php endwhile; endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
                
                 
             <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => -1, 'post__not_in'=>$postID,'orderby'=>'rand', 'format'=>'video','meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
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
							
							));
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
                <a href="#" class="allMedias" id="btnallvideos">» toutes les vidéos</a>
                <div class="clear"></div>
             <div id="allvideos">
             <?php while ($wp_query->have_posts()) : $wp_query->the_post();
				$postID=$post->ID;?>
                
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
            <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => 1, 'format'=>'audio','meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'first_org',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'second_org',
								'value' =>  $structure_id,
							)));
			$postID=array();				
			$wp_query = new WP_Query($args);
			$asongs=array();
				if ($wp_query->have_posts()) :?>
                <link href="<?php echo $cnSite->templatelink; ?>/_css/jplayer.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/jquery.jplayer.min.js"></script>
				  <h2>PODCASTS</h2>
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();
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

             <?php 	$args = array('post_type' => array('contenu'), 'posts_per_page' => -1, 'post__not_in'=>$postID,'orderby'=>'rand', 'format'=>'audio', 'meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'first_org',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'second_org',
								'value' =>  $structure_id,
							)));
			$wp_query = new WP_Query($args);
			$i=1;
				if ($wp_query->have_posts()) :
				 $i++;?>
             
             
             <a href="#" class="allMedias" id="btnallaudios">» tous les podcasts</a>
              <div id="allaudios">
             <?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
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
          <hr class="shadowBottom" />

         <section id="rechercheThema">
           <?php get_template_part( '_blocs/form', 'search' ); ?>
            <div class="clear"></div>
        </section>  
      
        </article>      
        
        
        <aside id="sidebarCms" class="noMargin">
        	<div class="shadowRight"></div>
          <!-- ANTENNES -->

       
  <div class="antennes">
             
             	<div id="mapPays" class="fichePays"></div>
               <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
               <?php if(!empty($antennes)):?>
			  <script type="text/javascript">
			  var imgdir=' <?php echo $cnSite->templatelink;?>';
            <?php echo 'var datas ='.json_encode($antennes);?>
            </script>
  			<script type="text/javascript" src="<?php echo  $cnSite->templatelink; ?>/_js/mapantenne.js"></script>
             <?php endif;?>
        </div> 
 		  <!-- ANTENNES -->  
          
           <!-- PARTENAIRES -->  
           <div class="partAsso">
           <h2>PARTENAIRES</h2>
            <ul>
			<?php $parts_elsa= get_post_meta($post->ID, 'first_org');
            if(!empty($parts_elsa)) {
				$args = array(
						 'post_type' => 'structure',
						 'posts_per_page' => -1,
						 'orderby' => 'title',
						 'order' => 'ASC',
						 'post__in' => $parts_elsa
					);
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ) :
					while ($wp_query->have_posts()) : $wp_query->the_post();
				 ?>
					<li><a href=""><?php the_post_thumbnail('medium');?></a></li>
				  <?php endwhile;endif;wp_reset_query();wp_reset_postdata(); $args=null; 
			  }?>
              
              
              <?php $parts_elsa2= get_post_meta($post->ID, 'second_org');
            if(!empty($parts_elsa2)) {
				$args = array(
						 'post_type' => 'structure',
						 'posts_per_page' => -1,
						 'orderby' => 'title',
						 'order' => 'ASC',
						 'post__in' => $parts_elsa2
					);
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ) :
					while ($wp_query->have_posts()) : $wp_query->the_post();
				 ?>
					<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
				  <?php endwhile;endif;wp_reset_query();wp_reset_postdata(); $args=null; 
			  }?>
			          
           </ul>
           <div class="clear"></div>
           </div>
            <!-- PARTENAIRES -->  
          
          
          
          
          
           <!-- VIE ASSOC -->
        
       
            <?php 	$args = array('post_type' => array('post','contenu'), 'posts_per_page' => 1, 'format'=>'vie-associative','meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'first_org',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'second_org',
								'value' =>  $structure_id,
							)));
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) :?>
			<div class="vieAsso">
            	 <h2>VIE ASSOCIATIVE</h2>
				<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                 <div>
					<?php the_post_thumbnail('medium');?>
                    <div class="dateAsso"><?php echo get_the_date();?></div>
					 <div class="titreAsso"><?php the_title();?></div>
                    <div class="excerptAsso"><?php the_content(); ?></div>
                 
                </div> 
                </div> 
             <?php endwhile; endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
        
 		  <!-- VIE ASSOC --> 
          
           <!-- PHOTOS -->
         
            <?php 	/*$args = array('post_type' => array('post','contenu'), 'posts_per_page' => 4,'format'=>'photo','meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'structure',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'first_org',
								'value' =>  $structure_id,
							),
							array(
								'key' => 'second_org',
								'value' =>  $structure_id,
							)));*/
							
		?>
         <?php
		$diapo = get_post_field('diaporama', $structure_id);
			if($diapo != '') { ?>
        
				 <div class="galPhotos">
                 <h2><span>GALERIE</span> PHOTO</h2>
                 <ul>
				 <?php 
					$images = get_post_meta($structure_id, 'diaporama', false );
					$images = implode( ',' , $images );
					$images = $wpdb->get_col( "
						SELECT ID FROM {$wpdb->posts}
						WHERE post_type = 'attachment'
						AND ID in ({$images})
						ORDER BY menu_order ASC
					" );
					$i=0;
					function array_random($arr, $num = 1) {
						shuffle($arr);
						
						$r = array();
						for ($i = 0; $i < $num; $i++) {
							$r[] = $arr[$i];
						}
						return $num == 1 ? $r[0] : $r;
					}
					if(!empty($images)) $images = array_random($images, 7);
					
					foreach ( $images as $imgid )	{
				
						$src = wp_get_attachment_image_src( $imgid, 'large' );
						$src = $src[0];
						$title=get_the_title($imgid);
						$class=($i==0)?'class="first"':'';
						echo "<li ".$class."><div><a href='{$src}' class='fancybox' rel='diaporama' title='{$title}'><img src='{$src}' /></a></div>";
			
						echo  "</li>";
						$i++;
				}
					
					?>
             
			 </ul>
             <div class="clear"></div>
        </div>
        <?php } ?>
		
               
 	
         <!-- PHOTOS -->
         
         
         
          <!-- SUR LE WEB -->
            <div class="webAsso">
           <?php $web= get_post_meta($post->ID, 'web', true);
		   if(!empty($web)) echo '<h2>SUR LE WEB</h2>'.$web
		   
		   ?>
            </div> 
         <!-- SUR LE WEB -->
         
         
          <!-- AUTRES ASSOC -->
            <div class="autresAsso">
           <?php 	$args = array(
						 'post_type' => 'structure',
						 'posts_per_page' => -1,
						 'orderby' => 'title',
						 'order' => 'ASC',
						 'type_structure' => 'partenaires-elsa-associations-du-reseau-elsa',
						 'pays_assoc' => $pays,
						 'post__not_in' =>array($structure_id)
					);
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ) :?>
                    <h2>Autres associations du réseau Elsa</h2>
                    <ul>
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
				  <?php endwhile;endif;wp_reset_query();wp_reset_postdata(); $args=null; ?>
                  </ul>
            </div> 
         <!-- AUTRES ASSOC -->
         
         
        <?php get_template_part( '_blocs/side', 'ressources' ); ?>
         
        
         </aside>
        <div class="clear"></div>
        
     </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>