<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>



<div style="float:right;">
<ul id="gema75_ril_social_icons">

	<?php if(isset($social_links['twitter_link']) && isset($social_links['twitter_icon'])){ ?>
		<li>
			<a href="<?php echo $social_links['twitter_link'];?>" target="blank"><img src="<?php echo $social_links['twitter_icon'];?>"></a>
		</li>
	<?php } ?>
	
	
	<?php if(isset($social_links['facebook_link']) && isset($social_links['facebook_icon'])){ ?>
		<li>
			<a href="<?php echo $social_links['facebook_link'];?>" target="blank"><img src="<?php echo $social_links['facebook_icon'];?>"></a>
		</li>
	<?php } ?>	
	
	
	<?php if(isset($social_links['pinterest_link']) && isset($social_links['pinterest_icon'])){ ?>
		<li>
			<a href="<?php echo $social_links['pinterest_link'];?>" target="blank"><img src="<?php echo $social_links['pinterest_icon'];?>"></a>
		</li>
	<?php } ?>
	
	<?php if(isset($social_links['googleplus_link']) && isset($social_links['googleplus_icon'])){ ?>
		<li>
			<a href="<?php echo $social_links['googleplus_link'];?>" target="blank"><img src="<?php echo $social_links['googleplus_icon'];?>"></a>
		</li>
	<?php } ?>
	
	<?php if(isset($social_links['email_link']) && isset($social_links['email_icon'])){ ?>
		<li>
			<a href="<?php echo $social_links['email_link'];?>" target="blank"><img src="<?php echo $social_links['email_icon'];?>"></a>
		</li>
	<?php } ?>	
	
	
</ul></div>