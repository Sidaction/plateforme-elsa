


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
			  	<p><?php the_field('description_courte'); ?></p>
				</div>

				<div class="page_practical_group">
						<div class="event_date">
							<?php the_field('date_evenement'); ?> 
						</div>
						<div class="event_type">
							<?php $type = get_the_terms( $post->ID, 'evenement_type' ); echo $type ? $type[0]->name : '' ; ?>
						</div>
						<div class="event_place--short">
							<?php $place = get_the_terms( $post->ID, 'evenement_lieu' ); 
							echo $place ? $place[0]->name : 'lieu non précisé' ; ?>
						</div>
				</div>

			</div>


	  	<div class="item_action_group">
	  		<span class="icon_plus">Plus d'informations</span>
	  	</div>

  	</div>

  </a>

</div>

