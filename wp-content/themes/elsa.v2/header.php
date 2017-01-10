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
    
    <!--[if (gte IE 6)&(lte IE 8)]>
    	<script type="text/javascript" src="<?php echo $cnSite->templatelink; ?>/_js/selectivizr.js"></script>
    	<noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
    <![endif]-->
  
</head>
<body>

<header class="site-header">

    <div class="row wrap subheader">

        <div class="m-3col site-branding">
            <img src="<?php echo get_template_directory_uri() ?>/_img/logo-elsa.png" alt="logo ELSA" class="site-logo">
            <div class="site-title">
                <h1><a href="<?php echo get_bloginfo('url') ?>">Plateforme ELSA</a></h1>
                <p>Centre de ressources francophones sur le VIH/sida en Afrique</p>
            </div>
        </div>
        <div class="m-5col">
            <div class="top-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu' ) ); ?>

            </div>
        </div>

    </div><!-- .wrap -->


    <div class="main-navigation clearfix">
        <div class="wrap">

            <section id="rechercheThema" class="main_nav-search">
                <form id="rechRess" action="/recherche-documentaire/" class=" ">   
                    <div id="recherche">
                        <input type="text" placeholder="Taper un terme ou laisser vide pour tout voir" name="totaltags" value=""/>
                        <input type="hidden" name="totalpays" value="" />
                        <input type="hidden" name="totalregions" value="" />
                        <button>Rechercher</button>
                    </div>
                </form>  
            </section>
    
            <div class="main_nav-dropdowns">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </div>
            
        </div>
    </div>       

</header>
