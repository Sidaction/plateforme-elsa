


<?php get_template_part('components/pdfPopin'); ?>



<footer class="site-footer">
    <div class="wrapper">
        
        <div class="footer-text grid gap-l">
            <div class="t-10col m-6col">
                <?php the_field('elsa_text', 'options'); ?>
            </div>
            <div class="t-10col m-1col"></div>
            <div class="t-10col m-5col">
                <h3 class="h4"><?php the_field('logos_membres_title', 'options'); ?></h3>
                <?php 
                    $images = get_field('logos_soutiens', 'options');
                    $size = 'full'; // (thumbnail, medium, large, full or custom size)
                    if( $images ): ?>
                        <ul>
                            <?php foreach( $images as $image ): ?>
                                <li>
                                    <?php echo wp_get_attachment_image( $image['id'], $size ); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
            </div>
        </div>
        
        <div class="bottom flex gap-xl">
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-sidaction-white.png" width="90" height="90" alt="logo Sidaction"></a>
            </div>

            <!-- <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'tertiary-menu' ) ); ?> -->
            <ul class="footer-menu no-bullets">
                <li class="menu-item"><a href="/soumettre-une-ressource" class="btn-inline">Nous soumettre une ressource</a> </li>
                <li class="menu-item"><a href="/contactez-nous" class="btn-inline">Nous écrire</a> </li>                
                <li class="menu-item js-newsletter-trigger"><a href="#" class="btn-inline">Recevoir notre newsletter</a> </li>
                <li class="menu-item">
                    <span class="btn-inline">Nous suivre sur les réseaux :</span>

                    <ul class="social-links flex gap-s">

                        <?php if( get_field('url_facebook', 'options')) :  ?>
                            <li><a href="<?php echo wp_kses_post( get_field('url_facebook', 'options')); ?>" target="_blank" aria-label="Voir notre page Facebook">
                                <?php get_template_part('svg/svg-facebook'); ?>
                            </a></li>
                        <?php endif; ?>

                        <?php if( get_field('url_twitter', 'options')) :  ?>
                            <li><a href="<?php echo wp_kses_post( get_field('url_twitter', 'options')); ?>" target="_blank" aria-label="Voir notre page X (Twitter)">
                                <?php get_template_part('svg/svg-twitter'); ?>
                            </a></li>
                        <?php endif; ?>

                        <?php if( get_field('url_instagram', 'options')) :  ?>
                            <li><a href="<?php echo wp_kses_post( get_field('url_instagram', 'options')); ?>" target="_blank" aria-label="Voir notre page Instagram">
                                <?php get_template_part('svg/svg-instagram'); ?>
                            </a></li>
                        <?php endif; ?>

                        <?php if( get_field('url_youtube', 'options')) :  ?>
                            <li><a href="<?php echo wp_kses_post( get_field('url_youtube', 'options')); ?>" target="_blank" aria-label="Voir notre chaine Youtube">
                                <?php get_template_part('svg/svg-youtube'); ?>
                            </a></li>
                        <?php endif; ?>

                        <?php if( get_field('url_linkedin', 'options')) :  ?>
                            <li><a href="<?php echo wp_kses_post( get_field('url_linkedin', 'options')); ?>" target="_blank" aria-label="Voir notre page Linkedin">
                                <?php get_template_part('svg/svg-linkedin'); ?>
                            </a></li>
                        <?php endif; ?>

                    </ul>
                    
                </li>


            </ul>

            <?php wp_nav_menu( array( 
                'theme_location'    => 'bottom', 
                'menu_id'           => 'bottom-menu',   
                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s <li><a href="#" id="tarteaucitronManager" class="menu-item"> Cookies</a><li></ul>', 
            )); ?>


        <div>
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