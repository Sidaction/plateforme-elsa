<?php
wp_enqueue_script('tac-src');
wp_enqueue_script('tac-init');
global $cnSite; ?>

<!doctype html>
<html lang="fr">
<head>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PMFBHMZ4');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <?php wp_head();?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $cnSite->templatelink; ?>/assets/img/favicon.png" />
  
    <!-- Matomo 
        <script>
        var _paq = window._paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(["setExcludedReferrers", ["sidaction.org","secure.ogone.com","2022.sidaction.org","legs.sidaction.org","2024.sidaction.org","sendibm3.com"]]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://matomo.sidaction.org/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '5']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
        </script>
    End Matomo Code -->
 


</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PMFBHMZ4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="site-header">
    <div class="wrapper flex space gap-l center-y">

        <div class="flex gap-l center-y site-brand">
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-sidaction.png" width="90" height="90" alt="logo Sidaction"></a>
            </div>
            
            <h1 class="site-title on-mobile"><a href="<?php echo esc_url( home_url() ) ?>">Centre de ressources</a></h1>

        </div>

        <input type="checkbox" class="burger-input on-mobile" id="burger">
        <label class="burger on-mobile" for="burger">
            <span></span>
            <span></span>
            <span></span>
        </label>

        <nav class="flex wrap center-y">
            <h1 class="site-title on-desktop"><a href="<?php echo esc_url( home_url() ) ?>">Centre de ressources</a></h1>
            
            <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'flex end-x gap-m' ) ); ?>  

            <?php $walker = new Menu_With_Description; ?>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'flex gap-l', 'walker' => $walker ) ); ?>
            

            <form id="" action="/recherche-documentaire/" class="search-form">   
                <input type="text" id="main_search" class="search-form__input" placeholder="Rechercher un terme" name="totaltags" value=""/>

                <button class="search-form__button" type="submit" aria-label="Rechercher une ressource">
                    <?php get_template_part('svg/svg', 'arrow', array( 'fill' => '#FFF' )); ?>
                </button>
            </form>
        </nav>

    </div>
</header>   


<?php get_template_part('svg/svg', 'all'); ?>