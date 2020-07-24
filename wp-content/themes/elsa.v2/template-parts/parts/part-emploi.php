


<div class="emploi-item">
  <a href="<?php the_permalink(); ?>" class="item_content">
  
  	<div class="item_title">
    	<h3><?php the_title(); ?></h3>
  		<p><?php the_field('description_courte'); ?></p>		
  	</div>

		<div class="item_organisation">
			<?php $contrat = get_field('emploi_contrat'); echo $contrat ? $contrat[0]->name : 'type de contrat non renseigné'; ?>
		</div>
		
		<div class="item_organisation">
			<?php $place = get_field('emploi_place'); echo $place ? $place[0]->name : 'lieu non renseigné'; ?>
		</div>

		<span class="btn-secondary item_action">Consulter l'offre d'emploi</span>


  </a>
</div>