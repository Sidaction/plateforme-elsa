


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

				<div class="event_practical_group">
						<div class="event_date">
							<?php the_field('date_evenement'); ?> 
						</div>
						<div class="event_type">
							<?php $type = get_field('type_evenement'); echo $type ? $type[0]->name : '' ; ?>
						</div>
						<div class="event_place">
							<?php $place = get_field('lieu_evenement'); 
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

