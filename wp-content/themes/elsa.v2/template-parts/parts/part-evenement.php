


<div class="evenement-item">

  <a href="<?php the_permalink(); ?>">

		<div class="ratio">
			<div class="ratio_inner">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
  	

  	<div class="inner">
			<p><?php the_field('date_evenement'); ?> <span class="event_type"><?php $type = get_field('type_evenement'); echo $type ? '| ' . $type[0]->name : '' ; ?></span> | 
				<?php $place = get_field('lieu_evenement'); 
				echo $place ? $place[0]->name : 'lieu non précisé' ; ?>
			</p>

	  	<h3><?php the_title(); ?></h3>
	  	<p><?php the_field('description_courte'); ?></p>

	  	<span>Plus d'informations -></span>
  	</div>

  </a>

</div>

