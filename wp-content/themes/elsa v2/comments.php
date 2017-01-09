<?php /**COMMENTAIRES ***/ 

    function elsa_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
       <li class="comment">
         
            <em><?php comment_author(); ?> - le <?php comment_date(); ?> à   <?php comment_time(); ?></em>
                <p><?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation">Votre commentaire est en attente de validation.</em>
                        <br />
        <?php endif; ?>
                    <?php comment_text(); ?></p>
          
            <a href="?replytocom=<?php comment_ID(); ?>#leaveComment" class="links">» répondre</a>
            <a href="#" class="links">» signaler un abus</a><div class="clear"></div>
        </li>




        <?php
    }
?>

        
         <div id="comments">
          
              <?php if ( have_comments() ) : ?>
			 <ul id="blockComments">
				<?php
					wp_list_comments(array( 'callback' => 'elsa_comment' ));
				?>
			</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
                    <div class="navigation">
                        <div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Plus anciens', '' ) ); ?></div>
                        <div class="nav-next"><?php next_comments_link( __( 'Plus récents <span class="meta-nav">&rarr;</span>', '' ) ); ?></div>
                    </div><!-- .navigation -->
        <?php endif; ?>
<?php else : 
		if ( ! comments_open() ) :
	?>
		<p class="nocomments">Les commentaires sont fermés.</p>
	<?php endif;  ?>
<?php endif; ?>
          
  
  
  
  
   <span class="interet">Votre avis nous intéresse !</span>
           
           <form  action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="leaveComment">

           		<div><input type="text" placeholder="Votre nom"  name="author" id="author" value="<?php echo esc_attr($comment_author); ?>"/>
                <input type="text" placeholder="Votre email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>"/></div>
                <div><textarea placeholder="Votre commentaire" name="comment" id="comment"></textarea></div>
                <button>publier</button>
			    <?php comment_id_fields(); ?>
				<?php do_action('comment_form', $post->ID); ?>
			</form>






   </div>
    














   

