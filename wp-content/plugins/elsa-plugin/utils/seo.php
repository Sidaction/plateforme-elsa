<?php
	//// GENERATION DU TITLE
	function generate_title(){  
		echo '<title>';
		global $post, $paged, $type;  
		if(is_single() || is_page()){ 
			$title =get_the_title($post->ID);
			$title .='  - ' . get_bloginfo('name');
			echo $title;		
		}elseif( is_archive() || is_category()) {		
			wp_title( '|', true, 'right' );
			if (isset($type)) echo ucfirst($type) . ' | ';
			if ($paged >= 2 ) echo'Page ' . $paged . ' | ';
			echo get_bloginfo('name');
			
		}else{
			wp_title( '|', true, 'right' );
			echo get_bloginfo('name');
		}
		echo "</title> \r\n";
    }
	
	
	
	
	
	/// GENERATION DE LA DESCRIPTION
	function excerpt_to_description(){  
		global $post;  
		if(is_single() || is_page()){  
			$excerpt = substr(strip_tags(get_the_excerpt()), 0, 300).'...'; 
			$excerpt=preg_replace( "/\r|\n/", "", $excerpt );
			if(has_excerpt()) {
				echo '<meta name="description" content="'.$excerpt.'" />'."\r\n";
			}else{
				echo '<meta name="description" content="'.substr(strip_tags($post->post_content), 0, 160).'..." />'."\r\n";
			};  
		}  elseif( is_archive() || is_category()) {
			echo '<meta name="description" content="'.strip_tags(category_description()).'" />'."\r\n";
		}
		
		 
		else{  
			echo '<meta name="description" content="'.get_bloginfo('description').'" />'."\r\n";
		}  
	}  
	
	
	// GENERATION DES MOTS CLES
	function tags_to_keywords(){
		global $post;
		if(is_single() || is_page()){
			$tags = wp_get_post_tags($post->ID);
			if($tags):
				foreach($tags as $tag){
					$tag_array[] = $tag->name;
				}
				$tag_string = implode(', ',$tag_array);
				if($tag_string !== ''){
					echo "<meta name='keywords' content='".$tag_string."' />\r\n";
				}
			endif;	
		}
	}

	add_action('wp_head','tags_to_keywords',3);  
	
	// AJOUT DES TAGS FB
	
	function fb_header(){
		global $post;
		if (is_single()) {
			$excerpt = substr(strip_tags(get_the_excerpt()), 0, 300).'...'; 
			$excerpt=preg_replace( "/\r|\n/", "", $excerpt );
			$large_thumb=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$fbt='<meta property="og:url" content="'. get_permalink($post->ID).'"/>'."\r\n";
			$fbt.='<meta property="og:title" content="'. get_the_title($post->ID).'" />'."\r\n"; 
			$fbt.='<meta property="og:description" content="'.$excerpt.'" />'."\r\n";  
			$fbt.='<meta property="og:type" content="article" />'."\r\n";
			$fbt.='<meta property="og:image" content="'. $large_thumb[0].'" />'."\r\n";

			 echo $fbt;
		}
		
		if (is_home()) {
			$fbt='<meta property="og:url" content="'. get_bloginfo('url').'"/>'."\r\n";
			$fbt.='<meta property="og:title" content="'. get_bloginfo('name').'" />'."\r\n"; 
			$fbt.='<meta property="og:description" content="'.get_bloginfo('description').'" />'."\r\n";								
			$fbt.='<meta property="og:image" content="http://www.plateforme-elsa.org/wp-content/themes/elsa/_img/logo-elsa.png" />'."\r\n";

			 echo $fbt;
		}
		
		
    }

