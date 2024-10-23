<footer class="site-footer">
    <div class="wrapper">
        
        <?php the_field('elsa_text', 'options'); ?>
        
        <div class="bottom flex gap-xl">
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-sidaction-white.png" width="auto" height="auto" alt="logo ELSA"></a>
            </div>

            <!-- <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'tertiary-menu' ) ); ?> -->
            <ul class="footer-menu no-bullets">
                <li class="menu-item"><a href="/soumettre-une-ressource" class="btn-inline">Nous soumettre une ressource</a> </li>
                <li class="menu-item"><a href="/contactez-nous" class="btn-inline">Nous écrire</a> </li>
                <li class="menu-item social_links">
                    <span href="#" class="btn-inline">Nous suivre sur les réseaux</span>
                    <a href="<?php the_field('url_facebook', 'options'); ?>" target="_blank" class="social_icon icon-facebook"></a>
                    <a href="<?php the_field('url_twitter', 'options'); ?>" target="_blank" class="social_icon icon-twitter"></a>
                </li>

                <li class="menu-item js-newsletter-trigger"><a href="#" class="btn-inline">Recevoir notre newsletter</a> </li>

            </ul>

            <?php wp_nav_menu( array( 
                'theme_location'    => 'bottom', 
                'menu_id'           => 'bottom-menu',   
                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s <a href="#" id="tarteaucitronManager" class="menu-item"> Cookies</a></ul>', 
            )); ?>


        <div>
    </div>
                
    <?php wp_footer();?>
</footer>


<!--     
<div class="modal modal-newsletter">
    <div class="modal_inner wrap">

        <a href="#" id="" class="modal_close">
            <span class="icon-close"></span>
        </a>

        <div class="row newsletter_form_outer">

            <iframe  src="https://98f84544.sibforms.com/serve/MUIEAEzCau08VkSdGHDLsYBELXiA_5dcmKKc4raKEO7I1p9mkrx824BxAv4TSBpWDH1I58zndg9EtIYN9tpZX4owo15WdAaobEi8nzczqLWEECna3_b2lCkKJZx2BsoryM4HFchbS_V2ZXTGpI5m9KQHSrfoCAz0DdV29cnz0LLB0HxKcex0UpPRHKqrtlrMWlScnYk8oAkmXEX0" frameborder="0" scrolling="auto" allowfullscreen style="height: 90vh; margin-bottom: 0; display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>            

        </div>
        
    </div>  
</div> -->


<!-- <div id="empty_modal" class="modal modal-empty">
    <div class="modal_inner wrap">
        <a href="#" id="" class="modal_close">
            <span class="icon-close"></span>
        </a>
        <div class="modal_content">

            <div id="loading-msg" class="loading-msg">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/bx_loader.gif">
                <p>Nous cherchons le contenu demandé....</p>
            </div>

        </div>
    </div>
</div> -->


<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>
<script>
 WebFont.load({
    google: {
      families: ['Work Sans:300,400,600']
    }
  });
</script>




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