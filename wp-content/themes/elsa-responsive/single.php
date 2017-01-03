<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
  Fiche ressource
 //////////////////////////////////////////////////////////////*/
  $cnSite->page_type='ressource';	
  $format=cnLib::get_main_term_slug($post->ID, 'format');
  $category=cnLib::get_main_term_slug($post->ID, 'category');
  $link=get_post_meta($post->ID, 'link', true);
   $link_crips=get_post_meta($post->ID, 'link_crips', true);
  $date_edition=get_post_meta($post->ID, 'date-start', true);
  $auteurs=$cnSite->get_authors_withlink($post->ID);

   get_header(); 
 ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<section id="contentSite" class="vert">
  <div id="breadcrumb">
    <div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#"> <?php echo cnStrings::stripString(get_the_title(),80);?></a></div>
  </div>
  <div id="contentWrapper">
    <div id="navTop">
      <?php $cnSite->get_fiche_nav();?> 
    </div>
    <div class="shadowLeft"></div>
    <div class="shadowRight"></div>
    <article class="noback">
      <h1>
        <?php the_title();?>
      </h1>
      <div class="auteurs"><?php if(!empty($auteurs)) echo 'Auteur(s) : '.$auteurs;?> </div>
      <div id="logoAuteur">
        <?php 
		$main_authors= get_post_meta($post->ID, 'first_org', false);
		
		if(!empty($main_authors)){
			foreach($main_authors as $main_author){
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($main_author), 'thumbnail' );
				$url = $thumb['0'];
				$permalink = get_permalink( $main_author );
				if(!empty($url)) echo "<a href='{$permalink}'><img src='{$url}'  /></a>";
			}
		}	
		?>
      </div>
      <div class="clear"></div>
      <div class="thumbLeft">
        <?php the_post_thumbnail('large'); ?>
      </div>
      <div class="contentLeft">
        <div class="contentDetails">
          <?php $tools= get_post_meta($post->ID, 'outil', true);
					if(!empty($tools) && $tools==1):?>
          <div class="tools"></div>
          <?php endif ?>
          <div class="detailName"><?php if(cnLib::get_main_term($post->ID, 'category','Général') !='' ) echo 'Thème(s) :'?></div>
          <div class="detail">
            <?php if(cnLib::get_main_term($post->ID, 'category','Général') !='' )  the_category(', '); ?>
          </div>
          <div class="clear"></div>
          
            <?php echo get_the_tag_list('<div class="detailName"> Mots clés :</div><div class="detail">',', ','</div>');	?>
          
          <div class="clear"></div>
          <div class="detailName"><?php if( count(wp_get_object_terms( $post->ID, 'pays_assoc')) > 0 ) echo 'Pays :'?></div>
          <div class="detail"><?php echo cnLib::get_term_list_link( $post->ID, 'pays_assoc', '/pays/' ); ?> </div>
          <div class="clear"></div>
          <div class="detailName"><?php if(!empty($date_edition)) echo 'Date d’édition :';?> </div>
          <div class="detail"><?php echo $date_edition;?></div>
          <div class="clear"></div>
        </div>
        <?php the_content();?>
        <?php 
			
				if($format=='video' && !empty($link)) echo wp_oembed_get($link);?>
        
      </div>
      <div class="clear"></div>
      <div class="datepost">mis en ligne le
        <?php the_date( 'd F Y' ); ?>
      </div>
      <div class="clear"></div>
      <?php if($format=='link' && !empty($link)) echo "<div class='dlDoc'>{$link}<a href='{$link}' title='Voir le site' target='_blank'><div class='bttDL'>Voir le site</a></div><div class='clear'></div></div>"?>
       <?php if($format!='link' && $format!='video' && !empty($link)) echo "<div class='dlDoc'>Télécharger le document<a href='{$link}' title='Télécharger le document' target='_blank'><div class='bttDL'>Télécharger</a></div><div class='clear'></div></div>"?>
       <?php if(!empty($link_crips)) echo "<div class='dlDoc crips'>Notice issue du CRIPS<a href='{$link_crips}' title='Accéder au document sur le site du CRIPS' target='_blank'><div class='bttDL'>Accéder au document sur le site du CRIPS</a></div><div class='clear'></div></div>"?>
       
      <?php  $files = rwmb_meta( 'file', 'type=file' );
				foreach ( $files as $info )	{
			
					$size = filesize( $info['path'] );
           			 $kind = pathinfo($info['path'], PATHINFO_EXTENSION);
           			 $size = false === $size ? 0 : size_format( $size, 2 );
					echo "<div class='dlDoc'>{$info['title']} ({$kind} -{$size} )<a href='{$info['url']}' title='{$info['title']}' target='_blank'><div class='bttDL'>Télécharger</a></div></div>";
				}?>
      <?php $cnSite->share_links();?>
      <div class="clear"></div>
      <hr class="shadowBottom" />
      <div id="headerComments">
        <div id="nbComments">Vos commentaires</div>
        <div id="bubbleComments"><span>
          <?php comments_number( '0', '1', '% ' ); ?>
          </span></div>
        <div id="docPertinent"><a href="#votebtn" class="liked" id="votebtn"></a><span>Document pertinent</span><span id="nbLike"><?php echo get_post_meta($post->ID, 'like', true);?></span></div>
        
        <script src="<?php echo $cnSite->templatelink; ?>/_js/jquery.cookie.js"></script>    
        <script>
        jQuery(document).ready(function(){
            var hasLiked=false;
            hasLiked = (jQuery.cookie('like-<?php echo $post->ID;?>')==undefined)?false:jQuery.cookie('like-<?php echo $post->ID;?>');
            
            
            if(!hasLiked){
                jQuery("#votebtn").click( function (e) {
                                                    
                        e.preventDefault();
                                
                         var data = {};
                         data.postID = <?php echo $post->ID;?>;
                         data.action = "doc_like";
                         $.post(ajaxurl, data, onSuccess);
                         function onSuccess(data) {
                            jQuery("#nbLike").html(data.substring(0,data.length-1));
                            jQuery.cookie('like-<?php echo $post->ID;?>', true, {expire : 300, path : '/'});	
                            jQuery("#votebtn").unbind('click');
                            
                        };
                });
            }else{
                       jQuery("#votebtn").unbind('click');

            
            }
        })
        
        </script>
        
        
      </div>
      <?php comments_template( '', true ); ?>
      <hr class="shadowTop" />
       <?php $cnSite->get_fiche_nav();?> 
      <hr class="shadowBottom" />
    </article>
    <aside id="sidebarCms">
        	<div class="shadowRight"></div>
    
            <?php 	

			$args = array('post_type' => array('post'), 'posts_per_page' => 6, 'category_name'=> $category, 'post__not_in'=>array($post->ID));
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()):?>
				
				  <div class="titreTheme"><span>Sur</span> le même thème</div>
      <div id="memethemeWrapper">
      <ul id="memetheme">
				
<?php 
		 while ($wp_query->have_posts()) : $wp_query->the_post();?>
                
                 <li><a href="<?php the_permalink();?>"><div class="thumbImg"> <?php the_post_thumbnail('thumbnail');?></div>
              <span><?php the_title();?></span></a></li>
                                 
                 
             <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
             
              </ul>
      <div class="clear"></div>
      </div>
      <?php endif;?>             
       

     <?php get_template_part( '_blocs/rss', 'feeds' ); ?>
        <?php get_template_part( '_blocs/side', 'adecouvrir' ); ?>  
      <?php get_template_part( '_blocs/side', 'ressources' ); ?>
    </aside>
    <div class="clear"></div>
  </div>
</section>
<?php endwhile; ?>
<?php get_footer(); ?>
