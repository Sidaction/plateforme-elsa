<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page Agenda
 Template Name: Page Agenda
 //////////////////////////////////////////////////////////////*/
 get_header(); ?>
 
<section id="contentSite" class="bleu">
	<div id="breadcrumb">
    	<div id="breadcrumbWrapper">Vous êtes ici » <a href="/">Accueil</a> » <a href="#">Agenda</a> </div>
    </div>
     <div id="contentWrapper">
     	<div class="shadowLeft"></div>
       <div class="shadowRight"></div>
       <article class="fullPage">
        <h1><img src="<?php echo $cnSite->templatelink; ?>/assets/img/agendaIco.png" width="34" height="33" /> <?php the_title();?></h1>
		 
          <div id="legende">
              <div class="conferenceEvt">Conférence</div><div class="evenementEvt">Evénement</div><br />
              <div class="financementEvt">Financement</div><br />
            <span><a href="/thematiques/financements-de-la-lutte-contre-le-sida/">Voir le dossier thématique "Mobilisation des ressources" »</a></span><br />
              <div class="formationEvt">Formation</div><br />
              <span><a href="/thematiques/formation/">Voir le dossier thématique "formation"  »</a></span>          </div>
          
          <div id="liensAg">
              <ul>
                <li class="descLiensAg">
                  	<span>Boites à outils</span><br />
                  	Des outils liés à un calendrier,<br />
                  	un agenda :
                </li>
                <li>
                	<a href="https://www.google.com/calendar/render?hl=fr" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/google.png" width="89" height="37" /></a><br />
                Créer un agenda en ligne,<br />le partager</li>
                <li> <a href="http://doodle.com/fr/" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/assets/img/doodle.png" width="100" height="21" /></a><br />
                    Trouver une date,<br />planifier un événement.
                </li>
              </ul>
         </div>
          
          <div class="clear"></div>
          
          <hr class="shadowBottom" />
          
          <a class="nextAg" href="#"></a>
          <a class="prevAg" href="#"></a>
          
          <div id="agendaWrapper">

          <ul>
          		
                
                <?php   
 add_filter( 'posts_orderby', 'my_posts_orderby_date', 10, 2 );
			function my_posts_orderby_date( $orderby, $query ) {
				global $wpdb;
				return " CAST( $wpdb->postmeta.meta_value AS DATE ) " . $query->get( 'order' );
			}
		
 $start_date=date('Y-m-d', strtotime("2 month ago"));	
 
	 $args = array(
		'post_type' => 'agenda',
		'posts_per_page' => -1,
		'meta_key' => 'date-start',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_query'=>array(
			'relation'=>'AND',
			array(
				'key' => 'date-end',
				'value' => $start_date,
				'compare' => '>=',
				'type' => 'CHAR'
			)
		)	 
	);
			$wp_query = new WP_Query($args);
			$prev_month = '';
			if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
			$date_debut = get_post_meta($post->ID, 'date-start',true); 
			$date_end = get_post_meta($post->ID, 'date-end',true); 
		 	setlocale (LC_TIME, 'fr_FR');
			$dateFormat = $date_debut;
			$debut = date_i18n('M Y' ,strtotime("$dateFormat"));
			
			$sel_mois = strftime("%m",strtotime("$dateFormat"));  // mois :  2 chiffres
			$sel_annee = strftime("%Y",strtotime("$dateFormat"));  // année : 4 chiffres
			
	
			if ($debut!=$prev_month) {
				echo '<li class="mois"><div class="moisEvt">'.$debut.'</div>';
			}
			
			?>
            	  <div class="evt <?php echo cnLib::get_main_term_slug($post->ID, 'type_date');?>">
                    	<div class="typeEvt"><?php echo cnLib::get_main_term($post->ID, 'type_date');?></div>
                   	 	<div class="imgEvt"> 
                        <?php if(get_the_content()) :?>
                        <a href="<?php the_permalink();?>" class='iframe-fancybox'><?php the_post_thumbnail('thumbnail'); ?></a>
                        <?php else : ?>
                        <?php the_post_thumbnail('thumbnail'); ?>
                        <?php endif;?></div>
                        <div class="dateEvt"><?php echo cnDates::getPeriode($date_debut, $date_end);?></div>
                        
                         <?php if(get_the_content()) :?>
                        <a href="<?php the_permalink();?>" class='iframe-fancybox'>
                        <div class="titreEvt"><?php the_title();?></div>
                        <p><?php echo get_the_excerpt();?></p>
                        
                        </a>
                        <?php else : ?>
                        <div class="titreEvt"><?php the_title();?></div>
                        <p><?php echo get_the_excerpt();?></p>
                        <?php endif;?>
                        <?php
						$shareurl='http://www.google.com/calendar/event?action=TEMPLATE&trp=false';
						$shareurl.="&text=" .urldecode(get_the_title());
						$shareurl.="&dates=".str_replace("-", "", $date_debut)."T000029Z";
						$shareurl.="/".str_replace("-", "", $date_end)."T000029Z" ;
						$shareurl.="&location=";
						$shareurl.="&details=".urldecode(get_the_excerpt());
						$shareurl.="&sprop="
					?>
				
                        
                        <div class="bttAjout"><a href="<?php echo $shareurl;?>" target="_blank">Ajouter à mon agenda</a></div>
                    </div>
                
                
           <?php 
				$prev_month = $debut;
				endwhile; 
				wp_reset_query();
				wp_reset_postdata();
				$args=null;
				remove_filter( 'posts_orderby', 'my_posts_orderby_date', 10, 2 );
			?>     
                
                
                
                
                
                
                
          </ul>
          <div class="clear"></div>
          </div>
            
         <?php $cnSite->share_links();?>
           <div class="clear"></div>
       </article>
     </div>
</section>

<?php get_footer(); ?>