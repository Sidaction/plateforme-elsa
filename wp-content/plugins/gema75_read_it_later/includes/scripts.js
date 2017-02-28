
(function($){



//ADD POST TO RIL
	jQuery('.addToReadItLaterButton').click(function(e){
		
		e.preventDefault();
		
		var postID = jQuery(this).attr('data-readitlater-id');
		
		
		jQuery.ajax({
		  type: 'POST',
		  url: gema75_readitlater_js_strings.admin_ajax_url,
		  data: {
			action: 'maybe_add_to_ril_ajax',
			post:  postID
		  },
		  dataType: "json",
		  success: function(response, textStatus, XMLHttpRequest){
			console.log(response);
			
			//check response 
			if(response==='postAlreadyInRIL'){
			
				//console.log('Already Exists in RIL');
				
				jQuery('.addToReadItLaterButton[data-readitlater-id="'+ postID +'"]').append('<span class="alreadyExists">' + gema75_readitlater_js_strings.AlreadyExists + '</span>');
				
				
				
			}else{
			
				//add the product as a LI child of the UL
				var newRILListHtml = '<div> <div class="gema75_ril_image"><img src="' + response.image + '"></div><p>  <a href="'+response.permalink+'"> ' + response.title + '</a></p>  <a href="#" class="removeFromRILButton" data-readitlater-id="' + postID + '" >' + gema75_readitlater_js_strings.removeFromRIL + '</a> </div>';
				
				//add new product to the slider  
				 //jQuery("#gema75_ril_list").data('owlCarousel').addItem(newRILListHtml);
				
				//replace "add to RIL" with "added to RIL"
				jQuery('.addToReadItLaterButton[data-readitlater-id="'+ postID +'"]').html(gema75_readitlater_js_strings.addedToRilList);
				//change the class
				jQuery('.addToReadItLaterButton[data-readitlater-id="'+ postID +'"]').addClass('addedToRilListButton');
				jQuery('.addToReadItLaterButton[data-readitlater-id="'+ postID +'"]').removeClass('addToReadItLaterButton');
				
				//show the "remove all" link
				hide_or_show_remove_all_link();
			 }
			
		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			console.log(errorThrown);
		  }
		});		
		

	});


//GET POSTS FROM RIL
	jQuery.ajax({
		  type: 'POST',
		  url: gema75_readitlater_js_strings.admin_ajax_url,
		  data: {
			action: 'get_ril_ajax',
		  },
		  dataType: "json",
		  success: function(response, textStatus, XMLHttpRequest){

			console.log(response);
			
			var newRILListHtml ='';
			
			for (var k in response.posts_in_ril_list){
				
				//add the post as a LI child of the UL
				newRILListHtml =  '<div> <div class="gema75_ril_image"><img src="' + response.posts_in_ril_list[k].image + '"></div> <p><a href="'+response.posts_in_ril_list[k].permalink+'"> ' + response.posts_in_ril_list[k].title + '</a></p>';

				newRILListHtml += '<a class="removeFromRILButton" data-readitlater-id="' + response.posts_in_ril_list[k].id + '" >' + gema75_readitlater_js_strings.removeFromRIL + '</a> </div>';

				//refresh the slider
				//jQuery("#gema75_ril_list").data('owlCarousel').addItem(newRILListHtml);	
				
			
				//reset
				newRILListHtml ='';
				
			}

			hide_or_show_remove_all_link();

		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			console.log(errorThrown);
		  }
	});		

	
	

//REMOVE SINGLE POST FROM RIL	

	jQuery("body").on("click",".removeFromRILButton",function(e) {
	

		e.preventDefault();
		
		var postID = jQuery(this).attr('data-readitlater-id');
		
		var elementiMeIndex = jQuery(this).parent().parent().index();
		
		jQuery.ajax({
		  type: 'POST',
		  url: gema75_readitlater_js_strings.admin_ajax_url,
		  data: {
			action: 'remove_post_from_ril_list_ajax',
			post:  postID
		  },
		  dataType: "json",
		  success: function(response, textStatus, XMLHttpRequest){
			console.log(response);

			
			location.reload();
			hide_or_show_remove_all_link();
			
		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			console.log(errorThrown);
		  }
		});		
		

	});


	
//REMOVE ALL POSTS FROM RIL	

	jQuery("body").on("click",".gema75_removeAllFromRILButton",function(e) {
		
		e.preventDefault();

		jQuery.ajax({
		  type: 'POST',
		  url: gema75_readitlater_js_strings.admin_ajax_url,
		  data: {
			action: 'remove_all_posts_from_ril_ajax'
		  },
		  dataType: "json",
		  success: function(response, textStatus, XMLHttpRequest){
			console.log(response);

			//remove all item from owl carousel
			jQuery("#gema75_ril_list div.owl-wrapper-outer div.owl-wrapper div").remove();
			
			//remove the "remove all"
			hide_or_show_remove_all_link();
			
		  },
		  error: function(MLHttpRequest, textStatus, errorThrown){
			console.log(errorThrown);
		  }
		});		
		

	});	
	



	
	//start the carousel
	//jQuery("#gema75_ril_list").owlCarousel({items : 10,});	

	// OWL Carousel avigation Events
	jQuery('.gema75_ril_owl_next').click(function(){
		jQuery("#gema75_ril_list").trigger('owl.next');
	});

	jQuery('.gema75_ril_owl_prev').click(function(){
		jQuery("#gema75_ril_list").trigger('owl.prev');
	});

	
	
	
	 /*
	 *  Get how many posts are on the RIL
	 */
	function gema75_how_many_items_in_ril(){
		var how_many = jQuery("#gema75_ril_list div.owl-wrapper-outer div.owl-wrapper div.owl-item").length;
		//console.log('aktualisht jane ' + how_many + ' posts in RIL');
		return parseInt(how_many);
	}
	
	 /*
	 *  Hide or show the "remove all" link if posts in ril is >=1
	 */
	function hide_or_show_remove_all_link(){
		if(gema75_how_many_items_in_ril()>=1){
			jQuery(".gema75_removeAllFromRILButton").show();
		}else{
			jQuery(".gema75_removeAllFromRILButton").hide();
		}
		
		gema75_update_badge_count();
	}


	 /*
	 *  Set the badge count on the RIL tab
	 */
	function gema75_update_badge_count(){
		jQuery("#gema75_wc_wc_count_badge, .selection_count").html(gema75_how_many_items_in_ril());
	}	
	
	
	//are we using an image or text for the slideout tab
	if(gema75_readitlater_js_strings.ril_tab_text_or_image=='image'){
		var image_or_text ='image';
	}else{
	
		var image_or_text ='text';
	}
	
	//add the slideout on the page
	// jQuery('.slide-out-div').tabSlideOut({
 //            tabHandle: '.handle',                     //class of the element that will become your tab
	// 		imageOrText: image_or_text,
 //            pathToTabImage: '' + gema75_readitlater_js_strings.slider_tab_image_url + '', //path to the image for the tab //Optionally can be set using css
 //            imageHeight: gema75_readitlater_js_strings.slider_tab_image_height + 'px',                     //height of tab image           //Optionally can be set using css
 //            imageWidth: gema75_readitlater_js_strings.slider_tab_image_width + 'px',                       //width of tab image            //Optionally can be set using css
 //            tabLocation: '' + gema75_readitlater_js_strings.position +'',                      //side of screen where tab lives, top, right, bottom, or left
 //            speed: 300,                               //speed of animation
 //            action:  '' + gema75_readitlater_js_strings.open_ril_tab_with +'',                          //options: 'click' or 'hover', action to trigger animation
 //            topPos: '200px',                          //position from the top/ use if tabLocation is left or right
 //            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
 //            fixedPosition: true ,                     //options: true makes it stick(fixed position) on scroll
	// 		bgcolor :  '' + gema75_readitlater_js_strings.readitlater_bg_color +''
 //        });	

		
	//CSS from admin options
	jQuery('.slide-out-div').css('background-color', '' + gema75_readitlater_js_strings.readitlater_bg_color +'');
	
		
})(jQuery);
