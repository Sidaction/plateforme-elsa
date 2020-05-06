

<footer id="mastfooter" class="site-footer">

    <div class="wrap row">
        <div class="m-4col">
            <img src="<?php echo get_template_directory_uri() ?>/_img/Logo_ELSA-Version2019_500px.png" width="86" height="auto" alt="logo ELSA" class="site-logo">
            <h3 class="site-title">Plateforme ELSA</h3>
        </div>
 
        <div class="m-4col">
            <?php 
                $logos_membres = get_field('logos_membres', 'options');
               
                if( $logos_membres ) : ?>

                    <ul class="no-bullets clearfix table is-on-right">
                    <?php foreach( $logos_membres as $image ): ?>
                        <li class="table-cell ">
                            <a href="/plateforme-elsa/associations-membres-de-la-plateforme-elsa/">
                                <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>" class=" is-on-right" />
                            </a>
                        </li>
                    <?php endforeach; ?>
                    </ul>

                    <p style="margin-top: 10px; margin-bottom: 0;" class="clearfix text-on-right"><strong><?php the_field('logos_membres_title', 'options'); ?></strong></p>
                    
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
                <li><a href="/soumettre-une-ressource" class="btn-inline">Nous soumettre une ressource</a> </li>
                <li><a href="/contactez-nous" class="btn-inline">Nous écrire</a> </li>
                <li class="social_links">
                    <span href="#" class="btn-inline">Nous suivre sur les réseaux</span>
                    <a href="<?php the_field('url_facebook', 'options'); ?>" target="_blank" class="social_icon icon-facebook"></a>
                    <a href="<?php the_field('url_twitter', 'options'); ?>" target="_blank" class="social_icon icon-twitter"></a>
                </li>

                <li class="js-newsletter-trigger"><a href="#" class="btn-inline">Recevoir notre newsletter</a> </li>

            </ul>


            <?php //echo do_shortcode('[wysija_form id="1"]'); ?>

        </div>

    </div>

    <div class="wrap row">
        <?php wp_nav_menu( array( 'theme_location' => 'bottom', 'menu_id' => 'bottom-menu' ) ); ?>
    </div>
    

    <?php wp_footer();?>
</footer>


    
<div class="modal modal-newsletter">
    <div class="modal_inner wrap">

        <a href="#" id="" class="modal_close">
            <span class="icon-close"></span>
        </a>

        <div class="row newsletter_form_outer">

            <iframe  src="https://98f84544.sibforms.com/serve/MUIEAEzCau08VkSdGHDLsYBELXiA_5dcmKKc4raKEO7I1p9mkrx824BxAv4TSBpWDH1I58zndg9EtIYN9tpZX4owo15WdAaobEi8nzczqLWEECna3_b2lCkKJZx2BsoryM4HFchbS_V2ZXTGpI5m9KQHSrfoCAz0DdV29cnz0LLB0HxKcex0UpPRHKqrtlrMWlScnYk8oAkmXEX0" frameborder="0" scrolling="auto" allowfullscreen style="height: 90vh; margin-bottom: 0; display: block;margin-left: auto;margin-right: auto;max-width: 100%;"></iframe>            

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