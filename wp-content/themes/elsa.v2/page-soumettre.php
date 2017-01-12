<?php 
/*
 * Page formulaire de soumission d'un document
 * Template Name: Formulaire de soumission de document
 */

acf_form_head(); 
get_header(); ?>

  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">

      <div class="wrap">

      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>

      <?php /* The loop */ ?>
      <?php while ( have_posts() ) : the_post(); ?>

        <?php acf_form(array(
          'post_id'     => 'new_post',
          'new_post'    => array(
            'post_type'     => 'post',
            'post_status'   => 'draft'
          ),
          'post_title'  => true,
          'field_groups' => array('7822'),
          'updated_message' => __("Post updated", 'acf'),
          'submit_value'    => 'Soumettre la ressource'
        )); ?>

      <?php endwhile; ?>

</div>
      

    </div><!-- #content -->
  </div><!-- #primary -->


<?php get_footer(); ?>

