<div>
	
	<p> 
		<div style="height:250px;">
				<div style="width: 20%;float: left;padding:1% 2%;"> <a href="<?php  the_permalink(); ?>">   
				<?php  the_post_thumbnail(); ?> </a></div>
				<div style="width: 75%;float: left;padding: 3% 0%;"><p> <a href="<?php  the_permalink(); ?>"> <?php echo the_title(); ?></a></p>
				<?php the_excerpt(); ?>
				<a href="#" class="removeFromRILButton" data-readitlater-id="<?php echo $post_id ;?>" ><?php echo $gema75_read_it_later->remove_from_readitlater_text ;?></a></div>
				
				 
				

			</div>
	</p>

</div>