<?php 
/*///////////////////////////////////////////////////////////////
 Plateforme Elsa by Clair et Net. / www.clair-et-net.com
  Resultats Structures extract xls
  Template Name: Page Resultats Structures extract xls
 //////////////////////////////////////////////////////////////*/
		$sitename = sanitize_key( get_bloginfo( 'name' ) );
		$filename = $sitename . '-structures-' . date( 'Y-m-d' ) . '.xls';
		header('Content-type: application/excel');
		header('Content-Disposition: attachment; filename='.$filename);
		header('Content-Type: text/html; charset=utf-8');
		$output = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
		<head>	
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
			<!--[if gte mso 9]>
			<xml>
				<x:ExcelWorkbook>
					<x:ExcelWorksheets>
						<x:ExcelWorksheet>
							<x:Name>Sheet 1</x:Name>
							<x:WorksheetOptions>
								<x:Print>
									<x:ValidPrinterInfo/>
								</x:Print>
							</x:WorksheetOptions>
						</x:ExcelWorksheet>
					</x:ExcelWorksheets>
				</x:ExcelWorkbook>
			</xml>
			<![endif]-->
		</head>
		
		<body>
		   <table><tr><td><b></b></td><td><b>Nom</b></td><td><b>Zone géographique</b></td><td><b>Public cibles</b></td><td><b>Activités</b></td><td><b>Téléphone</b></td><td><b>Site web</b></td><td><b>Email</b></td></tr>';
	   				
  		
 			if(!empty($_SESSION['argstructures'])){
				$wp_query = new WP_Query();
  				$wp_query->query( $_SESSION['argstructures']);
				if ( $wp_query->have_posts() ) while ($wp_query->have_posts()) : $wp_query->the_post(); 
			
					$output .='<tr>';
					$output .='<td><a href='.get_permalink($post->ID).'>voir en ligne</a></td>';
					$output .='<td>'.get_the_title().'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, "pays_assoc", $separ = ", ").'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, "public_cibles", $separ = ", ").'</td>';
					$output .='<td>'. cnLib::get_terms_withoutlink($post->ID, 'activites').'</td>';
					$output .='<td>'. get_post_meta($post->ID, 'tel', true).'</td>';
					$output .='<td>'. get_post_meta($post->ID, 'link', true).'</td>';
					$output .='<td>'. get_post_meta($post->ID, 'email', true).'</td>';
				
				
					$output .='</tr>';
				endwhile; 	
			
			}
													   
			$output .= '</table></body></html>';
			print $output;
			exit;

 
 ?>
