<?php 

get_header(); ?>

<main class="flex center-y">
    <div class="wrapper flex column center-y h-full gap-m">
        <h1>404</h1>
        <h4 class="txt-center">La page que vous cherchez n'existe pas.</h4>
        <a href="<?php echo get_home_url(); ?>" class="btn">Accueil</a>
    </div>
</main>

<?php get_footer(); ?>
