<?php 
    /* 
     * Page par défaut.
     * Conditions si pages enfants pour liste
     */

    $ancestors = get_post_ancestors($post);
    $level = count( $ancestors );

    if( $level == 0 ) {
        $root = get_the_ID();
    }
    else {
        $root = end( $ancestors );
    }

    $children_args = array(
        'post_parent' => get_the_ID(),
        'post_type'   => 'page', 
        'numberposts' => -1,
        'post_status' => 'any' 
    );
    $children = get_children( $children_args );
    wp_reset_query();

    $siblings_args = array(
        'post_parent' => $root,
        'post_type'   => 'page', 
        'numberposts' => -1,
        'post_status' => 'any' 
    );
    $siblings = get_children( $siblings_args );
    wp_reset_query();


    // IF PAGE ROOT WITH MORE THAN 1 CHILD : GOTO FIRST CHILD
    if( $level == 0 && count($children) > 1 ) {
        $firstchild = array_values($children)[0];
        wp_safe_redirect( get_permalink( $firstchild->ID ), 301);
        exit();
    }
    // IF PAGE ROOT WITH NO CHILD : STAY HERE + TITLE = CURRENT PAGE
    elseif( $level == 0 && empty( $children ) ) {
        $title = get_the_title();
        $content = get_the_content();
    }
    // IF CHILD WITH SIBLINGS : STAY HERE + TITLE = ROOT PAGE
    else {
        $title = get_the_title( $root );
        $content = get_the_content();
    }

    get_header(); 
?>

 <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

  <main>


    <section class="sec_page-hero">
        <div class="wrapper">

            <div class="page_nocover"></div>
                <?php if( $level != 0 && count($siblings) > 1 ) : ?>
                    <div class="page_title static_title">
                        <div class="wrap row">
                            <h1 class="h1 m-6col is-centered text-on-center">
                                <?php echo $title; ?>
                            </h1>  
                        </div>     
                    </div>
                <?php else : ?>
                    <div class="page_title static_title">
                        <div class="wrap row">
                            <h1 class="h1 m-6col is-centered text-on-center">
                                <?php echo $title; ?>
                            </h1>  
                        </div>     
                    </div>

                <?php endif; ?>

        </div>
    </section>

    <section class="sec_page-content">
        <div class="wrapper">
            <?php // PAGE AVEVC PARANTE ET MINIMUM 2 ENFANT ?>
            <?php if( $level != 0 && count($siblings) > 1 ) : ?>
                <nav class="navigation">
                    <?php set_query_var( 'root', $root ); ?>
                    <?php get_template_part('template-parts/loops/loop', 'childpages'); ?>
                </nav>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>


            <?php // PAGE SANS ENFANT NI PARANT ?>
            <?php elseif ( empty( $children ) && $level == 0 ) : ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>


            <?php // FALLBACK & DEFAULT ?>
            <?php else : ?>                

                <div class="entry-content">
                    <?php echo $content; ?>
                </div>

            <?php endif; ?>
        </div>
    </section>

</main>


<?php endwhile; ?>
<?php get_footer(); ?>