<?php global $cnSite; ?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php wp_head();?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $cnSite->templatelink; ?>/_img/favicon.png" />
  
    <!--[if lt IE 9]>
    	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
  
</head>
<body>

<header class="site-header">

    <div class=" subheader">
        <div class="row wrap">

            <div class="m-3col site-branding">
                <a href="#" class="btn-secondary main_nav-trigger">Menu </a>
                <a href="<?php echo get_bloginfo('url') ?>"><img src="<?php echo get_template_directory_uri() ?>/_img/logo-elsa.png" alt="logo ELSA" class="site-logo"></a>
                <div class="site-title">
                    <h1><a href="<?php echo get_bloginfo('url') ?>">Plateforme ELSA</a></h1>
                    <p class="site-resume">Centre de ressources francophones sur le VIH/sida en Afrique</p>
                </div>
            </div>

            <div class="m-5col top-nav-outer">
                <div class="top-navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>
                </div>
            </div>
        </div>
    </div><!-- .wrap -->


    <div class="main-navigation clearfix">
        <div class="wrap row">

            <section id="rechercheThema" class="main_nav-search">
                <form id="rechRess" action="/recherche-documentaire/" class="main_nav_searchform">   
                    <div id="recherche">

                        <input type="text" id="main_search" class="main_search_input main_nav_item" placeholder="Taper un terme ou laisser vide pour tout voir" name="totaltags" value=""/>


                        <input type="hidden" name="totalpays" value="" />
                        <input type="hidden" name="totalregions" value="" />
                        <button class="main_search_btn main_nav_item"><span class="icon-loupe"></span>Rechercher</button>
                    </div>
                </form>  
            </section>
    
            <div class="main_nav-dropdowns">
                <?php $walker = new Menu_With_Description; ?>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => $walker ) ); ?>
            </div>
            
        </div>
    </div>       

</header>
