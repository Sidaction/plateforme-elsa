<?php global $cnSite; ?>
<footer>
	<div id="partenaires">
    	<div class="titreSoul"><span>Les membres de la plateforme ELSA</span></div>
        <ul>
        <?php 
				$args = array(
						 'post_type' => 'structure',
						 'posts_per_page' => -1,
						 'orderby' => 'title',
						 'order' => 'ASC',
						 'type_structure' => 'associations-membres'
					);
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ) :
					while ($wp_query->have_posts()) : $wp_query->the_post();
				 ?>
					<li><a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/"><?php the_post_thumbnail('medium');?></a></li>
				  <?php endwhile;endif;wp_reset_postdata(); $args=null; ?>
        
                </ul>
        <div class="clear"></div>
    </div>
    
    <div id="footer">
    	<div id="footerWrapper">
            <div id="leftBottom">
            <div id="logo"></div>
    
            <?php $cnSite->get_footer_text();?>
			<div class="clear"></div>
            <hr />
            <h2>RESTONS EN CONTACT VIA</h2>
            <div class="clear"></div>
            <div class="contactvia">
            Notre newsletter
                <form class="newsletter footer">
                    <input type="text" placeholder="votre email">
                    <button>OK</button>
                </form>
                <div class="clear"></div>
            </div>
            <div>
            Les réseaux sociaux / rss
            <ul id="reseaux">
            	<li><a href="https://www.facebook.com/pages/Plateforme-ELSA/843936832288790" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/_img/facebook-footer.png" width="20" height="20"></a></li>
                <li><a href="https://twitter.com/PlateformeELSA" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/_img/twitter-footer.png" width="20" height="20"></a></li>
                <li><a href="#"><img src="<?php echo $cnSite->templatelink; ?>/_img/youtube-footer.png" width="20" height="20"></a></li>
                <li><a href="/rss-plateforme-elsa" target="_blank"><img src="<?php echo $cnSite->templatelink; ?>/_img/rss-footer.png" width="20" height="20"></a></li>
            </ul>
            <div class="clear"></div>
            </div>
            <hr />
            <!-- AddThis Button BEGIN -->
            <h2>PARTAGER</h2>
            <div class="addthis_toolbox addthis_default_style" id="shareFooter">
                <a class="addthis_button_preferred_1"></a>
                <a class="addthis_button_preferred_2"></a>
                <a class="addthis_button_preferred_3"></a>
                <a class="addthis_button_preferred_4"></a>
                <a class="addthis_button_compact"></a>
                <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-52fcab66343ea4ed"></script>
            <!-- AddThis Button END -->
			</div>
            <div id="colsBottom"> 
                <div class="colFooter">
                    <h2>THÉMATIQUES</h2>
                    <ul>
                        <?php wp_list_categories('orderby=name&exclude=1&title_li='); ?> 

                    </ul>
                </div>
                <div class="colFooter">
                <h2>PAYS D'AFRIQUE<br>
                FRANCOPHONE</h2> 
                    <ul>
                        <?php 
						$args = array('post_type' => array('pays'), 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC',);
			$wp_query = new WP_Query($args);
			
			if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
				echo '<li><a href="/pays/'. $post->post_name .'" title="'. get_the_title() .'">' . get_the_title() .'</a></li>';
				endwhile; wp_reset_postdata(); $args=null;?>
                    </ul>
              </div>
                 <div class="colFooter">
                 <h2>ELSA</h2>
                    <ul>
                        <li><a href="/plateforme-elsa/qui-sommes-nous/">Qui sommes-nous ?</a></li>
                        <li><a href="/plateforme-elsa/fonctionnement-et-activites-delsa/">Activités</a></li>
                        <li><a href="/associations-africaines-du-reseau-elsa/">Associations partenaires</a></li>
                        <li><a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/">Associations membres</a></li>
                        <li><a href="http://www.plateforme-elsa.org/extranet/" target="_blank">Accès intranet (membres ELSA)</a></li>
                    </ul>
                 <h2>SERVICES</h2>   
                    <ul>
                        <li><a href="/soumettre-une-ressource">Soumettre une ressource</a></li>
                        <li><a href="/recherche-documentaire">Rechercher une ressource</a></li>
                        <li><a href="/foire-aux-questions/">FAQ</a></li>
                        <li><a href="/nous-contacter/">Contact</a></li>
                        <li><a href="/nous-contacter/">Signaler un lien cassé</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
        		<div id="credits">Réalisation du site : <a href="http://www.clair-et-net.com/" target="_blank">Clair et Net.</a> / <a href="/conditions-generales-dutilisation/">CGU</a>  / <a href="/mentions-legales/">Mentions légales</a>  /© Plateforme ELSA 2014</div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
     <?php wp_footer();?>
</footer>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43730500-1', 'plateforme-elsa.org');
  ga('send', 'pageview');

</script>
<div id="toolTip"></div>

</body>
</html>