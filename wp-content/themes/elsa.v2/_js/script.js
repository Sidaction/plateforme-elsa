



jQuery(document).ready(function($){

  console.log('let\'s begin');


  /*
   * STICKY MENU
   */

   // TODOS
   // -> Problème au scroll des dropdowns

  var header = $('.site-header');
  var header_height = header.outerHeight();
  // header.css('position', 'fixed');
  // $('.site-content').css('padding-top', header_height);

  $( window ).scroll(function() {
    var $win = $(window);

    if ($win.scrollTop() > 250) {
      header.addClass( "is-reduced" );
    }

    if ($win.scrollTop() === 0) {
      header.removeClass( "is-reduced" );
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

  $('#js-close').on('click', function(event) {
    event.preventDefault();

    $('.modal').hide();
  });




  /*
   * DROPDOWNS
   */

  var dropdowns_trigger = $('.js-dropdown-trigger');
  dropdowns_trigger.on('click', function(event) {
    event.preventDefault();

    if( dropdowns_trigger.hasClass('open') ) {
    
      if( $(this).hasClass('open') ) {
        $(this).removeClass('open');
        $('#site-content').removeClass('dd-open');
      }
      else {
        dropdowns_trigger.removeClass('open');
        $(this).addClass('open');
        $('#site-content').addClass('dd-open');
      }
    }
    else {
      $(this).addClass('open');
      $('#site-content').addClass('dd-open');
    }
  });



  /*
   * BX SLIDERS
   */

  $('.bxslider').bxSlider({
    pager: false,
    adaptiveHeight: true,
  });



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

    // XX RESULTS PER PAGE
    $("#pager1").change(function(){
      console.log(  $(this).val() );

      $('#posts_per_page').val( $(this).val() );
      submitAdvancedSearch();
    });

    // XX RESULTS PER PAGE
    $("#pager2").change(function(){
      $('#posts_per_page').val( $(this).val() );
      submitAdvancedSearch();
    });

  }






function checkAS(){
  if($("li","#advancedSearch").length===0) $("#advancedSearch").slideUp();
}

function deleteAS(){
  $("li","#advancedSearch").remove();
  $("#advancedSearch").slideUp();
}

function getSearchFields(){

  var arrtags=[], arrcat=[], arrpays=[], arrregions=[];

  if($("input[name=totaltags]", "#recherche").val()!=="") arrtags = $("input[name=totaltags]", "#recherche").val().split(",");
  if($("input[name=totalcat]" , "#recherche").val()!=="") arrcat  = $("input[name=totalcat]", "#recherche").val().split(",");
  if($("input[name=totalpays]", "#recherche").val()!=="") arrpays = $("input[name=totalpays]", "#recherche").val().split(",");
  if($("input[name=totalregions]", "#recherche").val()!=="") arrregions = $("input[name=totalregions]", "#recherche").val().split(",");
  
  $("input[name=totaltags]", "#recherche").val("");
  $("input[name=totalcat]" , "#recherche").val("");
  $("input[name=totalpays]", "#recherche").val("");
  $("input[name=totalregions]", "#recherche").val("");
  
  if(arrtags.length!==0 || arrcat.length!==0 || arrpays.length!==0 || arrregions.length!==0) $("#advancedSearch").slideDown();

  if(arrtags.length!==0){
    for(var i=0; i<arrtags.length;i++){
      var tmpItem = $('<li data-value="'+arrtags[i]+'"></li>');
      tmpItem.append('<div class="btndel"></div>');
      tmpItem.append("<span>"+arrtags[i]+"</span>");
      $("#listKeywords").append(tmpItem);
      $(".btndel",tmpItem).hover(function(e){
        showTooltip("Supprimer", e.pageX, e.pageY);
      },function(e){
        hideTooltip();
      });
      $(".btndel",tmpItem).click(function(e) {
        hideTooltip();
        $(this).parent().remove();
        checkAS();
      });
    }
  }

  if(arrcat.length!==0){
    for(var i=0; i<arrcat.length;i++){
      var label = getLabel('cat',arrcat[i]);
      var tmpItem = $('<li data-value="'+arrcat[i]+'"></li>');
      tmpItem.append('<div class="btndel"></div>');
      tmpItem.append("<span>"+label+"</span>");
      
      $("#listThemes").append(tmpItem);
      $(".btndel",tmpItem).hover(function(e){
        showTooltip("Supprimer", e.pageX, e.pageY);
      },function(e){
        hideTooltip();
      });
      
      $(".btndel",tmpItem).click(function(e) {
        hideTooltip();
        $(this).parent().remove();
        checkAS();
      });
    }
  }

  if(arrpays.length!==0){
    for(var i=0; i<arrpays.length;i++){
      var label = getLabel('pays',arrpays[i]);
      var tmpItem = $('<li data-value="'+arrpays[i]+'"></li>');
      tmpItem.append('<div class="btndel"></div>');
      tmpItem.append("<span>"+label+"</span>");
      
      $("#listRegions").append(tmpItem);
      $(".btndel",tmpItem).hover(function(e){
        showTooltip("Supprimer", e.pageX, e.pageY);
      },function(e){
        hideTooltip();
      });
      
      $(".btndel",tmpItem).click(function(e) {
        hideTooltip();
        $(this).parent().remove();
        checkAS();
      });
    }
  }

  if(arrregions.length!==0){
    for(var i=0; i<arrregions.length;i++){
      var label = getLabel('pays',arrregions[i]);
      var tmpItem = $('<li data-value="'+arrregions[i]+'" data-type="region"></li>');
      tmpItem.append('<div class="btndel"></div>');
      tmpItem.append("<span>"+label+"</span>");
      
      $("#listRegions").append(tmpItem);
      $(".btndel",tmpItem).hover(function(e){
        showTooltip("Supprimer", e.pageX, e.pageY);
      },function(e){
        hideTooltip();
      });
      
      $(".btndel",tmpItem).click(function(e) {
        hideTooltip();
        $(this).parent().remove();
        checkAS();
      });
    }
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


function showTooltip(txt, x, y){

  var tt = $("#toolTip");

  tt.html(txt);
  TweenMax.to(tt, 0, {autoAlpha:0, left:x+15, top:y+30});
  TweenMax.to(tt, 0.7, {autoAlpha:1,left:x+15,top:y+15, ease:Power2.easeOut});
}

function hideTooltip(){

  var tt = $("#toolTip");

  TweenMax.to(tt, 0.5, {autoAlpha:0});
}







  console.log('this is the end my friend');

});





 
  /*SEARCH*/
  if($("#advancedSearch").length){
    
    getSearchFields();
    
    var hasFocus = false;
    
    $(".btnerase","#advancedSearch").click(function(e) {
      deleteAS();
    });
    
    $("#recherche button, #formatbtn").click(function(e) {
      if($("#advancedSearch").css("display")=="none"){
        
      }else{
        e.preventDefault();
        //submitAdvancedSearch();
      }
    });

    $("input[type=text]", "#recherche").hover(function(e){
      if(!hasFocus) showTooltip("Vous pouvez saisir plusieurs mots clés<br/>en les séparant par une virgule.", e.pageX, e.pageY);
      },function(e){
      hideTooltip();
    });
    
    $("input[type=text]", "#recherche").focusin(function(e) {

      $(this).keypress(function(e) {

        var str = $("input[type=text]", "#recherche").val();

        if(e.which == 44){// || e.which==13){

          e.preventDefault();

          if(str !== ""){

            $("#advancedSearch").slideDown(500);
            var tmpItem = $('<li data-value="'+str+'"></li>');
            tmpItem.append('<div class="btndel"></div>');
            tmpItem.append("<span>"+str+"</span>");
            $("#listKeywords").append(tmpItem);

            $(".btndel",tmpItem).hover(function(e){
              showTooltip("Supprimer", e.pageX, e.pageY);
            },function(e){
              hideTooltip();
            });

            $(".btndel",tmpItem).click(function(e) {
              hideTooltip();
              $(this).parent().remove();
              checkAS();
            });

            $("input[type=text]", "#recherche").val("");
          }
        }
        
        if(e.which == 13){
          if(str !== "") submitAdvancedSearch();
        }
      });

      hideTooltip();
      hasFocus = true;

    });

    $(this).focusout(function(e) {
      hasFocus = false;
    });

    $("#select-category").change(function(e) {
      if($(this).val() !== ""){
        $("#advancedSearch").slideDown(500);
        var ok = true;
        for(var i=0; i<$("li","#listThemes").length; i++){
          if($("li","#listThemes").eq(i).attr("data-value") == $(this).val()){
            ok = false;
          }
        }
        if(ok){
          var tmpItem = $('<li data-value="'+$(this).val()+'"></li>');
          tmpItem.append('<div class="btndel"></div>');
          tmpItem.append("<span>"+$("option:selected", this).text()+"</span>");
          $(this).val("");
          $("#listThemes").append(tmpItem);
          $(".btndel",tmpItem).hover(function(e){
            showTooltip("Supprimer", e.pageX, e.pageY);
          },function(e){
            hideTooltip();
          });
          
          $(".btndel",tmpItem).click(function(e) {
            hideTooltip();
            $(this).parent().remove();
            checkAS();
          });
        }
      }
    });
    
    $("#select-pays_assoc").change(function(e) {
      if($(this).val() !== ""){
        $("#advancedSearch").slideDown();
        var ok = true;
        for(var i=0; i<$("li","#listRegions").length; i++){
          if($("li","#listRegions").eq(i).attr("data-value") == $(this).val()){
            ok = false;
          }
        }
        if(ok){
          var tmpItem;
          tmpItem = $("option:selected",this).attr("name")=="region[]" ? $('<li data-value="'+$(this).val()+'" data-type="region"></li>'):$('<li data-value="'+$(this).val()+'"></li>');
          tmpItem.append('<div class="btndel"></div>');
          tmpItem.append("<span>"+$("option:selected", this).text()+"</span>");
          $("#listRegions").append(tmpItem);
          $(".btndel",tmpItem).hover(function(e){
            showTooltip("Supprimer", e.pageX, e.pageY);
          },function(e){
            hideTooltip();
          });
          $(".btndel",tmpItem).click(function(e) {
            hideTooltip();
            $(this).parent().remove();
            checkAS();
          });
        }
      }
    });
    

    $("#period").change(function(){
      if($("#advancedSearch").css("display")=="none"){
        $('#rechRess').submit();
      }else{
        submitAdvancedSearch();
      }
    });
    


    
  }





