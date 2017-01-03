<?php get_header(); ?>
<!-- Diaporama -->

<ul id="slides">
  <?php
        $args = array('post_type' => 'diaporama', 'posts_per_page' => 4, 'order' => 'ASC');
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts())
            while ($wp_query->have_posts()) : $wp_query->the_post();
                $large_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

                ?>
  <li data-img="<?php echo $large_thumb[0]; ?>" data-title="<?php echo get_the_title(); ?>" data-rub="<?php echo  get_post_meta($post->ID, 'surtitre', true);;?>" data-url="<?php echo get_post_meta($post->ID, 'link', true); ?>"></li>
  <?php  endwhile; wp_reset_query(); wp_reset_postdata(); $args = null; ?>
</ul>
<!-- Diaporama -->
<!-- Nouvelles ressources -->
<div>
  <?php 	$args = array('post_type' => array('post'), 'posts_per_page' => 5);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();?>
  <div> <a href="<?php the_permalink();?>">
    <?php the_post_thumbnail('medium');?>
    <?php echo get_the_date('j M Y');?> - <?php echo cnLib::get_related_post($post->ID, 'first_org');?><br />
    <?php echo cnLib::get_main_term($post->ID, 'category');?> - <?php echo cnLib::get_main_term_slug($post->ID, 'pays_assoc');?><br />
    <?php the_title();?>
    <br />
    <?php cnLib::the_excerpt_max_charlength(50); ?>
    <br />
    <?php echo cnLib::get_main_term_slug($post->ID, 'format');?><br />
    </a> </div>
  <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
</div>
<!-- Nouvelles ressources -->
<!-- Prochain événement -->
<div>
  <?php 	$args = array('post_type' => array('agenda'), 'posts_per_page' => 1);
			$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) while ($wp_query->have_posts()) : $wp_query->the_post();
				 $date_debut = get_post_meta($post->ID, 'date-start', true);
                $date_fin = get_post_meta($post->ID, 'date-end', true);?>
  <div> <a href="<?php the_permalink();?>">
    <?php the_post_thumbnail('medium');?>
    <?php echo cnDates::getPeriode($date_debut, $date_fin); ?>
    <?php the_title();?>
    <br />
    <?php cnLib::the_excerpt_max_charlength(50); ?>
    </a> </div>
  <?php endwhile; wp_reset_query();wp_reset_postdata(); $args=null; ?>
</div>
<!-- Prochain événement -->
<?php get_footer(); ?>
