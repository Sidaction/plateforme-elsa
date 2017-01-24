

<footer id="mastfooter" class="site-footer">

    <div class="wrap row">
        <div class="m-4col">
            <img src="<?php echo get_template_directory_uri() ?>/_img/logo-elsa.png" alt="logo ELSA" class="site-logo">
            <h3 class="site-title">Plateforme ELSA</h3>
        </div>

        <div class="m-4col">
            <ul class="no-bullets clearfix table">
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

                        <li class="table-cell "><a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/"><?php the_post_thumbnail('medium');?></a></li>
                    
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

        <div class="m-5col">
            <?php the_field('elsa_text', 'options'); ?>
        </div>

        <div class="m-3col">
            <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'tertiary-menu' ) ); ?>

            <h5 class="h2">Rester en contact</h5>

            <ul class="no-bullets">
                <li><a href="#" class="btn-inline">Nous soumettre une ressource</a> </li>
                <li><a href="#" class="btn-inline">Nous écrire</a> </li>
                <li><a href="#" class="btn-inline">Nous suivre sur les réseaux</a> </li>
                <li><a href="#" class="btn-inline">Recevoir notre newsletter</a> </li>
            </ul>

            <form>
                <input type="email" class="plain text-on-center" placeholder="exemple@domaine.fr">
                <input type="submit" class="btn-secondary plain text-on-center" value="S'inscrire à la newsletter">
            </form>
        </div>

    </div>

    <div class="wrap row">
        <?php wp_nav_menu( array( 'theme_location' => 'bottom', 'menu_id' => 'bottom-menu' ) ); ?>
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

    
<div class="modal modal-newsletter">
    <div class="modal_inner wrap">

        <a href="#" id="js-close" class="modal_close">
            <span class="icon-close"></span>
        </a>

        <div class="modal_title">
            <h4>Inscription à la Newsletter de la Plateforme ELSA</h4>
        </div>
    
        <form class="modal_form">
            <input type"text" placeholder="ex : nom@domaine.fr">
            <input type="submit" value="ok" class="btn-primary">
        </form>


    </div>  
</div>

</body>
</html>