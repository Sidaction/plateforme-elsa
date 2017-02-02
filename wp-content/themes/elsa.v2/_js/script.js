



jQuery(document).ready(function($){

  console.log('let\'s begin');

  var line_height = 21;

  var dropdowns_trigger = $('.js-dropdown-trigger');
  var header = $('.site-header');
  var header_height = header.outerHeight();

  var empty_modal = $('#empty_modal');
  var empty_modal_content = empty_modal.find('.modal_content');

  var popin = $('.js-popin');



/*
 * Popins
 */

  if( popin.length > 0 ) {
  
    popin.click(function(event){
      event.preventDefault();

      var this_url = $(this).attr('href');

      $.ajax({
        url : myAjax.ajaxurl,
        method : 'post',
        data : {
          action: "load_popin",
          this_url : this_url
        },
  
        beforeSend: function( response ) {
          empty_modal.show();
        },
        success : function( response ) {
          empty_modal_content.html( response );
          // $('#loading-msg').hide();
        },

        error : function( data ) { // en cas d'échec
          // Sinon je traite l'erreur
          console.log( 'Erreur…' );
        }

      });

    });
  }




/*
 * Fix page media margin on ressource title
 */

  var ressource_title = $('.ressource_title');
  var page_media = $('.page_media');

  if( ressource_title.length > 0 && page_media.length > 0 ) {
    var ressource_title_height = ressource_title.outerHeight();
    var page_media_height = page_media.outerHeight();

    console.log(ressource_title_height);
    console.log(page_media_height);

    if( ressource_title_height >= line_height * 8 && page_media_height > ressource_title_height / 2 ) {
      page_media.css('margin-top', - ( ressource_title_height / 2 + line_height * 4) );
    }

  }


/*
 * VALIDATE 
 */

  jQuery("#contact").validate({
      rules: {
        contname: "required",
        contfirtname: "required",
        title: "required",
        desc: "required",
        contemail: {
          required: true,
          email: true
        },
        contemail2: {
          required: true,
          equalTo: "#contemail",
        },
        check: {
          required: true,
           range:[4,4]
        },
    }
  });
  
  jQuery.extend(jQuery.validator.messages, {
    minlength: 'Merci de saisir un numéro à 10 chiffres',
    maxlength: 'Merci de saisir un numéro à 10 chiffres',
    number: 'Merci de saisir un numéro à 10 chiffres',
    required: 'Ce champ est obligatoire',
    range: 'Merci de renseigner le chiffre exact ( = 4)',
    email: 'Merci de renseigner un mail valide',
    equalTo: 'Merci de saisir le même email'
  });




  /*
   * STICKY MENU
   */

  header.css('position', 'fixed');
  $('.site-content').css('padding-top', header_height);

  $( window ).resize(function() {
    header.css('position', 'fixed');
    $('.site-content').css('padding-top', header_height);
  });

  $( window ).scroll(function() {
    var $win = $(window);

    if ($win.scrollTop() > 250) {
      header.addClass( "is-reduced" );
    }

    if ($win.scrollTop() === 0) {
      header.removeClass( "is-reduced" );
    }
  });


  var main_nav_trigger = $('.main_nav-trigger');
  main_nav_trigger.on('click', function() {
    $('.main-navigation').toggle();
    $('.top-nav-outer').toggle();
    $(this).toggleClass('e-open');
    $('body').toggleClass('no-scroll');

    if( dropdowns_trigger.hasClass('e-open') ) {
      dropdowns_trigger.removeClass('e-open');
      $('body').removeClass('no-scroll');
      $('#site-content').removeClass('dd-open');
    }
  });



  
  /*
   * BOOKMARKS / SELECTION STUFFS
   */
   
  var item_selection = $('.item-selection');
  item_selection.append('<span id="gema75_wc_wc_count_badge"></span>');

//  $('.selection_count').html(gema75_how_many_items_in_ril());




  /*
   * MODALS
   */

  $('.js-newsletter-trigger a').on('click', function(event) {
    event.preventDefault();

    $('.modal-newsletter').show();
    $('body').addClass('no-scroll');
  });

  $('.js-sharebymail').on('click', function(event) {
    event.preventDefault();

    $('.modal-sharebymail').show();
    $('body').addClass('no-scroll');
  });


  $('.modal_close').on('click', function(event) {
    event.preventDefault();

    $('body').removeClass('no-scroll');
    $('.modal').hide();
  });




  /*
   * DROPDOWNS
   */

  dropdowns_trigger.on('click', function(event) {

    event.preventDefault();

    var header = $('.site-header');
    var viewportHeight = $(window).height();
    var headerHeight = header.outerHeight();

    var dropdownHeight = viewportHeight - headerHeight;
    var dropdownHeightPourcentage = ( dropdownHeight * 100 ) / viewportHeight - 12;

    if( dropdowns_trigger.hasClass('e-open') ) {
    
      if( $(this).hasClass('e-open') ) {
        $(this).removeClass('e-open');
        $('#site-content').removeClass('dd-open');

        if( main_nav_trigger.hasClass('e-open') ) {

        }
        else {
          $('body').removeClass('no-scroll');
        }
      }
      else {
        dropdowns_trigger.removeClass('e-open');
        $(this).addClass('e-open');
        $('#site-content').addClass('dd-open');
        $('body').addClass('no-scroll');
        $(this).siblings('.dropdown-item').css('max-height', dropdownHeightPourcentage + 'vh');
      }
    }
    else {
      $(this).addClass('e-open');
      $('#site-content').addClass('dd-open');
      $('body').addClass('no-scroll');
      $(this).siblings('.dropdown-item').css('max-height', dropdownHeightPourcentage + 'vh');
    }
  });




  /*
   * BX SLIDERS
   */

  var bxslider_markup = $('.bxslider').clone();

  if( bxslider_markup.length > 0) {

    $('.bxslider').bxSlider({
      pager: false,
      adaptiveHeight: true,
      nextText: '',
      prevText: '',
      onSliderLoad: function(){
        $('.slider_outer').css('opacity', '1');
      },
    });

    $('#js-sliderfull').on('click', function() {
      
      var slider_clone = bxslider_markup;
      var bxslider = $('#empty_modal > .modal_inner .bx-wrapper');
      
      $('body').addClass('no-scroll');

      if( bxslider.length === 0 ) {
        $('#empty_modal .modal_content').append(slider_clone);
        $('#loading-msg').hide();
        $('#empty_modal').show();
        $('#empty_modal .modal_content > ul').bxSlider({
          pager: false,
          adaptiveHeight: false,
          nextText: '',
          prevText: ''
        });

      } else {
        $('#empty_modal').show();
      }

    });
  }
  


  /*
   * SMOOTH SCROLLING
   * Add smooth when clicking an anchor
   */

  var hashTagActive = "";
  $(".scroll").click(function (event) {
      if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
          event.preventDefault();
          //calculate destination place
          var dest = 0;
          if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
              dest = $(document).height() - $(window).height() - 200;
          } else {
              dest = $(this.hash).offset().top - 250;
          }

          //go to destination
          $('html,body').animate({
              scrollTop: dest
          }, 1000, 'swing');
          hashTagActive = this.hash;
      }
  });



  /*
   * FILTRES ASSOCIATIONS
   */

  $(".js-selectBox").change(function(event){
    
    // $('#assos_filters').submit();



      event.preventDefault();

      var select_val = $(this).val();
      var select_name = $(this).attr("name");

      console.log(select_val);
      console.log(select_name);

      $.ajax({
        url : myAjax.ajaxurl,
        method : 'post',
        data : {
          action: "load_assos",
          select_val : select_val,
          select_name : select_name
        },
  
        beforeSend: function( response ) {
        },
        success : function( response ) {
          $('.search_list').html( response );
          // $('#loading-msg').hide();
          $('.js-selectBox').not(this).prop('selectedIndex', 0);
        },

        error : function( data ) { // en cas d'échec
          // Sinon je traite l'erreur
          console.log( 'Erreur…' );
        }

      });



  });




  /*
   * FILTRES SEARCH
   */

  var search = $('.search-results');


  if( search.length > 0 ) {

    console.log('Begin search scripts');

    getSearchFields();


    // XX RESULTS PER PAGE
    $("#pager1").change(function(){
      $('#posts_per_page').val( $(this).val() );
      submitAdvancedSearch();
    });

    // XX RESULTS PER PAGE
    $("#pager2").change(function(){
      $('#posts_per_page').val( $(this).val() );
      submitAdvancedSearch();
    });


    $("#select-category").change(function(e) {

      if($(this).val() !== ""){

        var ok = true;

        for(var i=0; i<$("li","#listThemes").length; i++){

          if($("li","#listThemes").eq(i).attr("data-value") == $(this).val()){
            ok = false;
          }
        }

        if(ok){

          var tmpItem = $('<li class="filters_list_item" data-value="'+$(this).val()+'"></li>');
          
          tmpItem.append('<a href="#" class="icon-close btndel" alt="supprimer ce thème des filtres" title="supprimer ce thème des filtres"></a>');
          tmpItem.append("<span>"+$("option:selected", this).text()+"</span>");
          $(this).val("");

          $("#listThemes").append(tmpItem);
                   
          $(".btndel",tmpItem).click(function(event) {
            event.preventDefault();
            $(this).parent().remove();
          });
        }
      }
    });


    $("#select-pays_assoc").change(function(e) {
      if($(this).val() !== ""){

        var ok = true;
        for(var i=0; i<$("li","#listRegions").length; i++){
          if($("li","#listRegions").eq(i).attr("data-value") == $(this).val()){
            ok = false;
          }
        }
        if(ok){
          var tmpItem;
          tmpItem = $("option:selected",this).attr("name")=="region[]" ? $('<li class="filters_list_item" data-value="'+$(this).val()+'" data-type="region"></li>'):$('<li class="filters_list_item" data-value="'+$(this).val()+'"></li>');
          tmpItem.append('<a href="#" class="icon-close btndel" alt="supprimer ce pays des filtres" title="supprimer ce pays des filtres"></a>');
          tmpItem.append("<span>"+$("option:selected", this).text()+"</span>");
          $("#listRegions").append(tmpItem);

          $(".btndel",tmpItem).click(function(event) {
            event.preventDefault();
            $(this).parent().remove();
          });
        }
      }
    });


    $("#btnerase").click(function(event) {
      event.preventDefault();
      deleteAS();
    });


    $("#recherche button, #formatbtn").click(function(event) {
      if($("#advancedSearch").css("display")=="none"){
        
      }else{
        event.preventDefault();
        submitAdvancedSearch();
      }
    });



  }
  // End if search




function deleteAS(){
  $("li","#advancedSearch").remove();
}

function getSearchFields(){

  var arrtags=[], arrcat=[], arrpays=[], arrregions=[];

  if($("input[name=totalcat]").val()!=="") arrcat  = $("input[name=totalcat]").val().split(",");
  if($("input[name=totalpays]").val()!=="") arrpays = $("input[name=totalpays]").val().split(",");
  if($("input[name=totalregions]").val()!=="") arrregions = $("input[name=totalregions]").val().split(",");
  
  $("input[name=totalcat]").val("");
  $("input[name=totalpays]").val("");
  $("input[name=totalregions]").val("");
  


  if( arrtags.length !== 0 ){

    jQuery.each( arrtags, function( i, val ) {

      var tmpItem = $('<li class="filters_list_item" data-value="'+arrtags[i]+'"></li>');
      
      tmpItem.append('<a href="#" class="icon-close btndel" alt="supprimer ce mot clef des filtres" title="supprimer ce mot clef des filtres"></a>');
      tmpItem.append("<span>"+arrtags[i]+"</span>");
      
      $("#listKeywords").append(tmpItem);
      
      $(".btndel",tmpItem).click(function(event) {
        event.preventDefault();
        $(this).parent().remove();
        checkAS();
      });

    });
  }



  if(arrcat.length!==0){

    jQuery.each( arrcat, function( i, val ) {

      var label = getLabel('cat',arrcat[i]);
      var tmpItem = $('<li class="filters_list_item" data-value="'+arrcat[i]+'"></li>');
      
      tmpItem.append('<a href="#" class="icon-close btndel" alt="supprimer cette thématique des filtres" title="supprimer cette thématique des filtres"></a>');
      tmpItem.append("<span>"+label+"</span>");
      
      $("#listThemes").append(tmpItem);
      
      $(".btndel",tmpItem).click(function(event) {
        event.preventDefault();
        $(this).parent().remove();
        checkAS();
      });

    });
  }

  if(arrpays.length!==0){

    jQuery.each( arrpays, function( i, val ) {

      var label = getLabel('pays',arrpays[i]);
      var tmpItem = $('<li class="filters_list_item" data-value="'+arrpays[i]+'"></li>');
      
      tmpItem.append('<a href="#" class="icon-close btndel" alt="supprimer ce pays des filtres" title="supprimer ce pays des filtres"></a>');
      tmpItem.append("<span>"+label+"</span>");
      
      $("#listRegions").append(tmpItem);
      
      $(".btndel",tmpItem).click(function(event) {
        event.preventDefault();
        $(this).parent().remove();
        checkAS();
      });

    });

  }

}


function getLabel(type, value){

  var label = "";

  switch(type){

    case "cat":{
      $("option", "#select-category").each(function(index, element) {
        if($(this).val()==value) label = $(this).text();
      });
    } break;
    
    case "pays":{
      $("option", "#select-pays_assoc").each(function(index, element) {
        if($(this).val()==value) label = $(this).text();
      });
    } break;
  }

  return label;
}


function submitAdvancedSearch(){

  var ttxt = $("input[name=tag]").val();
  var fsep = $("li", "#listKeywords").length>0 ? ",":"";
  
  if(ttxt!=="") $("input[name=totaltags]").val(ttxt+fsep);
  
  $("li", "#listKeywords").each(function(index, element) {
    var sep = index == $("li", "#listKeywords").length-1 ? "":",";
    $("input[name=totaltags]").val($("input[name=totaltags]").val()+$(this).attr("data-value")+sep);
  });
  
  $("li", "#listThemes").each(function(index, element) {
    var sep = index == $("li", "#listThemes").length-1 ? "":",";
    $("input[name=totalcat]").val($("input[name=totalcat]").val()+$(this).attr("data-value")+sep);
  });
  
  $("li", "#listRegions").each(function(index, element) {
    //var sep = index == $("li", "#listRegions").length-1 ? "":","
    var sep = ",";
    if($(this).attr("data-type")=="region") $("input[name=totalregions]").val($("input[name=totalregions]").val()+$(this).attr("data-value")+sep);
    else $("input[name=totalpays]").val($("input[name=totalpays]").val()+$(this).attr("data-value")+sep);
  });
  
  $("input[name=totalregions]").val($("input[name=totalregions]").val().slice(0,-1));
  
  $("input[name=totalpays]").val($("input[name=totalpays]").val().slice(0,-1));
  
  $("#rechRess").submit();
}




  console.log('this is the end my friend');

});





