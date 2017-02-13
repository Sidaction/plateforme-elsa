

<footer id="mastfooter" class="site-footer">

    <div class="wrap row">
        <div class="m-4col">
            <img src="<?php echo get_template_directory_uri() ?>/_img/logo-elsa.png" alt="logo ELSA" class="site-logo">
            <h3 class="site-title">Plateforme ELSA</h3>
        </div>

        <div class="m-4col">
            <?php 
                $logos_membres = get_field('logos_membres', 'options');
               
                if( $logos_membres ) : ?>
                    <ul class="no-bullets clearfix table">
                    <?php foreach( $logos_membres as $image ): ?>
                        <li class="table-cell ">
                            <a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/">
                                <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" />
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <p style="margin-top: 10px; margin-bottom: 0;" class="text-on-right"><strong><?php the_field('logos_membres_title', 'options'); ?></strong></p>
                    
                <?php endif; ?>
            
        </div>
    </div>

    <div class="footer-divider clearfix"></div>

    <div class="wrap row">

        <div class="m-5col footer_text">
            <?php the_field('elsa_text', 'options'); ?>
        </div>

        <div class="m-3col footer_menus">
            <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'tertiary-menu' ) ); ?>

            <h5 class="h2">Rester en contact</h5>

            <ul class="no-bullets">
                <li><a href="#" class="btn-inline">Nous soumettre une ressource</a> </li>
                <li><a href="#" class="btn-inline">Nous écrire</a> </li>
                <li class="social_links">
                    <span href="#" class="btn-inline">Nous suivre sur les réseaux</span>
                    <a href="<?php the_field('url_facebook', 'options'); ?>" class="social_icon icon-facebook"></a>
                    <a href="<?php the_field('url_twitter', 'options'); ?>" class="social_icon icon-twitter"></a>
                </li>

                <li><span class="btn-inline">Recevoir notre newsletter</span> </li>

            </ul>


            <?php echo do_shortcode('[wysija_form id="1"]'); ?>

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

        <a href="#" id="" class="modal_close">
            <span class="icon-close"></span>
        </a>

        <div class="row">

            <div class="m-4col">
                <div class="modal_title">
                    <h4>Inscription à la Newsletter de la Plateforme ELSA</h4>
                </div>
            
                <?php echo do_shortcode('[wysija_form id="1"]'); ?>
            </div>

        </div>
        
    </div>  
</div>


<div id="empty_modal" class="modal modal-empty">
    <div class="modal_inner wrap">
        <a href="#" id="" class="modal_close">
            <span class="icon-close"></span>
        </a>
        <div class="modal_content">

            <div id="loading-msg" class="loading-msg">
                <img src="<?php echo get_template_directory_uri(); ?>/_img/bx_loader.gif">
                <p>Nous cherchons le contenu demandé....</p>
            </div>

        </div>
    </div>
</div>

</body>
</html>