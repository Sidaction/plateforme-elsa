<?php
wp_enqueue_script('tac-src');
wp_enqueue_script('tac-init');
global $cnSite; ?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php wp_head();?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $cnSite->templatelink; ?>/assets/img/favicon.png" />
  
</head>
<body>


<header class="site-header">
    <div class="wrapper flex space gap-l center-y">

        <div class="flex gap-l center-y site-brand">
            <div class="site-logo">
                <a href="<?php echo esc_url( home_url() ) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/img/logo-sidaction.png" width="auto" height="auto" alt="logo ELSA"></a>
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

                <button class="search-form__button" type="submit">
                    <?php get_template_part('svg/svg', 'arrow', array( 'fill' => '#FFF' )); ?>
                </button>
            </form>
        </nav>

    </div>
</header>   


<?php get_template_part('svg/svg', 'all'); ?>