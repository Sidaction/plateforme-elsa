 <?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
 Page tag
 //////////////////////////////////////////////////////////////*/
 $tag = get_queried_object();
 $slug = str_replace("-", "%20", $tag->slug);
 wp_redirect( '/recherche-documentaire/?tag='.$slug); 
 exit;
?>