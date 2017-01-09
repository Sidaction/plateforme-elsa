

<footer id="mastfooter" class="site-footer">

    <div class="wrap row">
        <div class="m-6col">
            logo
            Plateforme ELSA
        </div>

        <div class="m-6col">
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
                    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

                        <li><a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/"><?php the_post_thumbnail('medium');?></a></li>
                    
                    <?php endwhile;
                endif;
                wp_reset_postdata(); 
                $args=null; 
            ?>
            
            </ul>
        </div>
    </div>

    <div class="footer-divider clearfix"></div>

    <div class="wrap row">

        <div class="m-8col">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>

        <div class="m-4col">
            menus.
        </div>

    </div>

    <div class="wrap row">
        Mentions légales - Crédits
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

</body>
</html>