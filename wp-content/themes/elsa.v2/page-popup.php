<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Template Name: Page pop up
 //////////////////////////////////////////////////////////////*/
$id=sanitize_text_field($_GET['id']);
$args = array('post_type' => array('contenu'), 'p' => $id);
$wp_query = new WP_Query($args);


 ?>
 
 <html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name='robots' content='noindex,follow' />
   <link href="<?php echo get_bloginfo( 'template_url' ); ?>/_css/reset.css" rel="stylesheet" type="text/css">
  <link href="<?php echo get_bloginfo( 'template_url' ); ?>/_css/global.css" rel="stylesheet" type="text/css">
  
</head>
<body>


 <div style="margin:0 auto; text-align:center">
<?php if ( $wp_query->have_posts() ) while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
$link=get_post_meta($post->ID, 'link', true);?>
      <?php echo wp_oembed_get($link);?>

<?php endwhile; ?>
</div>
</body>
</html>
