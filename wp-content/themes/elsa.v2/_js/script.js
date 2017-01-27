



jQuery(document).ready(function($){

  console.log('let\'s begin');

  var dropdowns_trigger = $('.js-dropdown-trigger');
  var header = $('.site-header');
  var header_height = header.outerHeight();

  var empty_modal = $('#empty_modal');

 
  /*
   * STICKY MENU
   */

   // TODOS
   // -> Problème au scroll des dropdowns


  header.css('position', 'fixed');
  $('.site-content').css('padding-top', header_height);

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
  item_selection.append('<span id="gema75_wc_wc_count_badge" class="selection_count"></span>');



  /*
   * MODALS
   */

  $('.js-newsletter-trigger a').on('click', function(event) {
    event.preventDefault();

    $('.modal-newsletter').show();
    $('body').addClass('no-scroll');
  });

  $('.modal_close').on('click', function(event) {
    event.preventDefault();

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
  console.log(bxslider_markup);

  if( bxslider_markup.length > 0) {

    $('.bxslider').bxSlider({
      pager: false,
      adaptiveHeight: true,
      nextText: '',
      prevText: ''
    });

    $('.bx-wrapper').on('click', function() {
      
      var slider_clone = bxslider_markup;

      $('#empty_modal > .modal_inner').append(slider_clone);
      $('#empty_modal').show();
      $('#empty_modal > .modal_inner > ul').bxSlider({
        pager: false,
        adaptiveHeight: false,
        nextText: '',
        prevText: ''
      });
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

  $(".js-selectBox").change(function(){
    $('#assos_filters').submit();
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

  if($("input[name=totaltags]").val()!=="") arrtags = $("input[name=totaltags]").val().split(",");
  if($("input[name=totalcat]").val()!=="") arrcat  = $("input[name=totalcat]").val().split(",");
  if($("input[name=totalpays]").val()!=="") arrpays = $("input[name=totalpays]").val().split(",");
  if($("input[name=totalregions]").val()!=="") arrregions = $("input[name=totalregions]").val().split(",");
  
  $("input[name=totaltags]").val("");
  $("input[name=totalcat]").val("");
  $("input[name=totalpays]").val("");
  $("input[name=totalregions]").val("");
  
  

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





