<?php 
setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

?>


<div class="evenement-item">

  <a href="<?php the_permalink(); ?>" class="link_bloc">

		<div class="ratio">
			<div class="ratio_inner">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
  	

  	<div class="inner">
  		<div>
  			
  			<div class="item_title_group">
			  	<h3><?php the_title(); ?></h3>
			  	<p><strong><?php the_field('organisateur_evenement'); ?></strong></p>
				</div>

				<div class="item_description_group">
					<p><?php the_field('description_courte'); ?></p>
				</div>		
			</div>


			<div>
				<div class="page_practical_group">
						<div class="event_date">
							<?php 
								$date = get_field('date_evenement');

								$date = strtotime($date); 
								echo strftime('%A %d %B %G - %kh%M', $date );	

								if( get_field('utc_evenement') != '' ) {
									echo ' (' . get_field('utc_evenement') . ')';
								}
							?> 

						</div>
						<div class="event_type">
							<?php $type = get_the_terms( $post->ID, 'evenement_type' ); echo $type ? $type[0]->name : '' ; ?>
						</div>
						<div class="event_place--short">
							<?php $place = get_the_terms( $post->ID, 'evenement_lieu' ); 
							echo $place ? $place[0]->name : 'lieu non précisé' ; ?>
						</div>
				</div>

		  	<div class="item_action_group">
		  		<span class="icon_plus">Plus d'informations</span>
		  	</div>

			</div>	



  	</div>

  </a>

</div>

