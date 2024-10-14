<?php global $cnSite; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php wp_head();?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $cnSite->templatelink; ?>/assets/img/favicon.png" />



    <script src="<?php echo get_bloginfo('stylesheet_directory');?>/assets/js/tarteaucitron/tarteaucitron.js"></script>

        <script>
        tarteaucitron.init({
            "privacyUrl": "", /* Privacy policy url */

            "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
            "cookieName": "tarteaucitron", /* Cookie name */

            "orientation": "bottom", /* Banner position (top - bottom - middle - popup) */

            "groupServices": true, /* Group services by category */

            "showAlertSmall": false, /* Show the small banner on bottom right */
            "cookieslist": false, /* Show the cookie list */
            
            "showIcon": false, /* Show cookie icon to manage cookies */
            // "iconSrc": "", /* Optionnal: URL or base64 encoded image */
            "iconPosition": "BottomRight", /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

            "adblocker": false, /* Show a Warning if an adblocker is detected */

            "DenyAllCta" : true, /* Show the deny all button */
            "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
            "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */

            "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

            "removeCredit": true, /* Remove credit link */
            "moreInfoLink": true, /* Show more info link */
            "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

            "readmoreLink": "", /* Change the default readmore link pointing to tarteaucitron.io */
            
            "mandatory": true /* Show a message about mandatory cookies */
        });


        tarteaucitron.services.sendinblue = {
          "key": "sendinblue",
          "type": "api",
          "name": "SendInBlue",
          "needConsent": true,
          "cookies": ['PHPSESSID'],
          "readmoreLink": "https://fr.sendinblue.com/legal/cookies/", // If you want to change readmore link
          "js": function () {
            "use strict";
            // When user allow cookie
          },
          "fallback": function () {
            "use strict";
            // when use deny cookie
          }
        };


        tarteaucitron.user.gajsUa = 'UA-43730500-1';
        tarteaucitron.user.gajsMore = function () { /* add here your optionnal _ga.push() */ };
        (tarteaucitron.job = tarteaucitron.job || []).push('gajs');
        (tarteaucitron.job = tarteaucitron.job || []).push('youtube');
        (tarteaucitron.job = tarteaucitron.job || []).push('facebook');
        (tarteaucitron.job = tarteaucitron.job || []).push('twitter');
        (tarteaucitron.job = tarteaucitron.job || []).push('sendinblue');


</script>



    <!--[if lt IE 9]>
    	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
  
</head>
<body>

<header class="site-header">

    <div class=" subheader">
        <div class="row wrap">

            <div class="m-4col l-3col site-branding">
                <a href="#" class="btn-secondary main_nav-trigger">Menu </a>
                <a href="<?php echo esc_url( home_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/Logo_ELSA-Version2019_500px.png" width="86" height="auto" alt="logo ELSA" class="site-logo"></a>
                <div class="site-title">
                    <h1><a href="<?php echo esc_url( home_url() ) ?>">Plateforme ELSA</a></h1>
                    <p class="site-resume">Centre de ressources francophones sur le VIH/sida en Afrique</p>
                </div>
            </div>

            <div class="m-4col l-5col top-nav-outer">
                <div class="top-navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
                   
                </div>
            </div>
        </div>
    </div><!-- .wrap -->


    <div class="main-navigation clearfix">
        <div class="wrap row">

            <section id="" class="main_nav-search">
                <form id="" action="/recherche-documentaire/" class="main_nav_searchform">   
                        <input type="text" id="main_search" class="main_search_input main_nav_item" placeholder="Rechercher un terme" name="totaltags" value=""/>

                        <button class="main_search_btn main_nav_item"><span class="icon-loupe"></span></button>
                        <li class="main_nav_item search-all"><span> ı </span><a href="/recherche-documentaire">Tout voir</a></li>
                </form>  

            </section>
    
            <div class="main_nav-dropdowns">
                <?php $walker = new Menu_With_Description; ?>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => $walker ) ); ?>

                <div class="">
                    <?php wp_nav_menu( array( 'theme_location' => 'headright', 'menu_id' => 'primary-menu', 'walker' => $walker ) ); ?>
                </div>

            </div>
            
        </div>
    </div>       

</header>
