jQuery( document ).ready(function() {
	
	
	if($("#menuResp").length>0){
		$('#menuResp').click(function(e){
			e.preventDefault();
			if($('#menuWrapper').hasClass("menuOuvert")) {
				$('#menuWrapper').slideUp(200).removeClass("menuOuvert");
			}
			else {
					$('#menuWrapper').slideDown(200).addClass("menuOuvert");
			}
		});
	}
	
		
		
	if($(".programmesWrapper").length>0){
		$('.programmesWrapper').freetile();
	}
	
	if($(".fancybox").length>0){
		$(".fancybox").fancybox({
			openEffect	: 'none',
			closeEffect	: 'none'
		});	
	}
	
	if($(".iframe-fancybox").length>0){
		$(".iframe-fancybox").fancybox({
		'width': 600,
        'height': 450,
        'autoSize': false,
		'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'type'				: 'iframe',
		'fitToView' : false  
		});	
	}
	
	$('#btnallvideos').click(function(e){
		e.preventDefault();
		$(this).hide();
		$('#allvideos').slideDown(200);
	});
	
	$('#btnallaudios').click(function(e){
		e.preventDefault();
		$(this).hide();
		$('#allaudios').slideDown(200);
	});
	
	if($("#acteursLocauxcontent").length) {
		$("#acteursLocauxcontent").children().each(function(index, element) {
			$(element).wrap("<div></div>");
		});
		var totalp = $("#acteursLocauxcontent").children().length;
		
		var maxp = 6;
		var moreText = "En savoir plus";
		var lessText = "Réduire";
		if(totalp>maxp){
			var morediv = $('<div class="readmore"></div>');
			$("#acteursLocaux").append(morediv);
			$("#acteursLocaux").append('<a href="#" class="adjust"></a>');
			$("a.adjust").show();
			$("a.adjust").text(moreText);
			for(var i=maxp;i<totalp;i++){
				$("#acteursLocauxcontent").children().eq(maxp).appendTo(morediv);
			}
			morediv.hide();
			$(".adjust").click(function(e){
				e.preventDefault();
			})
			$(".adjust").toggle(function() {
					morediv.slideDown()
					$(this).text(lessText);
				}, function() {
					morediv.slideUp()
					$(this).text(moreText);
			});
		}
		/*
		var adjustheight = 798;
		
		$("#acteursLocauxcontent").css('height', adjustheight).css('overflow', 'hidden');
		
		*/
	}				
					
								  
	$("#newsletterTop").hide();
				
	$(".newsletterTop").click(function() {
		if (
			$("#newsletterTop").hasClass("displayNewsletter")) {
			$("#newsletterTop").slideUp(200).removeClass("displayNewsletter");
		}
		else {
			$('#newsletterTop').slideDown(200).addClass("displayNewsletter");
		}
	});
		
	/* SELECT */
	if(jQuery(".selectBox").length) {
		$(function () {
			$(".selectBox").selectbox();
		});
	}
	
	
	/*MINI SEARCH*/
	if($(".minisearch").length){
		$("#select-pays_assoc").change(function(e) {
			var sep = ",";
			if($(this).val()!=""){
				if($("option:selected",this).attr("name")=="region[]"){
					valRegions=($("input[name=totalregions]").val()=="")?$(this).val():$("input[name=totalregions]").val()+sep+$(this).val();
					$("input[name=totalregions]").val(valRegions);		
				}else{
					valPays=($("input[name=totalpays]").val()=="")?$(this).val():$("input[name=totalpays]").val()+sep+$(this).val();
					$("input[name=totalpays]").val(valPays);
				}
			}
		});
	}
	
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
				submitAdvancedSearch();
			}
		});
		$("input[type=text]", "#recherche").hover(function(e){
			if(!hasFocus) showTooltip("Vous pouvez saisir plusieurs mots clés<br/>en les séparant par une virgule.", e.pageX, e.pageY)
			},function(e){
			hideTooltip()
		})
		
		$("input[type=text]", "#recherche").focusin(function(e) {
			$(this).keypress(function(e) {
				var str = $("input[type=text]", "#recherche").val();
				if(e.which == 44){// || e.which==13){
					e.preventDefault();
					if(str!=""){
						$("#advancedSearch").slideDown(500);
						var tmpItem = $('<li data-value="'+str+'"></li>');
						tmpItem.append('<div class="btndel"></div>');
						tmpItem.append("<span>"+str+"</span>");
						$("#listKeywords").append(tmpItem);
						$(".btndel",tmpItem).hover(function(e){
							showTooltip("Supprimer", e.pageX, e.pageY)
						},function(e){
							hideTooltip()
						})
						$(".btndel",tmpItem).click(function(e) {
							hideTooltip()
							$(this).parent().remove();
							checkAS()
						});
						$("input[type=text]", "#recherche").val("")
					}
				}
				if(e.which == 13){
					if(str!="") submitAdvancedSearch();
				}
			});
			hideTooltip();
			hasFocus = true;
		});
		$(this).focusout(function(e) {
			hasFocus = false;
		});

		$("#select-category").change(function(e) {
			if($(this).val()!=""){
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
					$(this).val("")
					$("#listThemes").append(tmpItem);
					$(".btndel",tmpItem).hover(function(e){
						showTooltip("Supprimer", e.pageX, e.pageY)
					},function(e){
						hideTooltip()
					})
					
					$(".btndel",tmpItem).click(function(e) {
						hideTooltip()
						$(this).parent().remove();
						checkAS()
					});
				}
			}
		});
		
		$("#select-pays_assoc").change(function(e) {
			if($(this).val()!=""){
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
						showTooltip("Supprimer", e.pageX, e.pageY)
					},function(e){
						hideTooltip()
					})
					$(".btndel",tmpItem).click(function(e) {
						hideTooltip()
						$(this).parent().remove();
						checkAS()
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
		
		$("#pager1").change(function(){
			$('#posts_per_page').val($(this).val());
			if($("#advancedSearch").css("display")=="none"){
				$('#rechRess').submit();
			}else{
				submitAdvancedSearch();
			}					 
		});	
		$("#pager2").change(function(){
			$('#posts_per_page').val($(this).val());
			if($("#advancedSearch").css("display")=="none"){
				$('#rechRess').submit();
			}else{
				submitAdvancedSearch();
			}					 
		});	
		
		
	}
	
});

function checkAS(){
	if($("li","#advancedSearch").length==0) $("#advancedSearch").slideUp();
}
function deleteAS(){
	$("li","#advancedSearch").remove()
	$("#advancedSearch").slideUp();
}

function getSearchFields(){
	var arrtags=[], arrcat=[], arrpays=[], arrregions=[];
	if($("input[name=totaltags]", "#recherche").val()!="") arrtags = $("input[name=totaltags]", "#recherche").val().split(",")
	if($("input[name=totalcat]" , "#recherche").val()!="") arrcat  = $("input[name=totalcat]", "#recherche").val().split(",")
	if($("input[name=totalpays]", "#recherche").val()!="") arrpays = $("input[name=totalpays]", "#recherche").val().split(",")
	if($("input[name=totalregions]", "#recherche").val()!="") arrregions = $("input[name=totalregions]", "#recherche").val().split(",")
	
	$("input[name=totaltags]", "#recherche").val("")
	$("input[name=totalcat]" , "#recherche").val("")
	$("input[name=totalpays]", "#recherche").val("")
	$("input[name=totalregions]", "#recherche").val("")
	
	if(arrtags.length!=0 || arrcat.length!=0 || arrpays.length!=0 || arrregions.length!=0) $("#advancedSearch").slideDown();
	if(arrtags.length!=0){
		for(var i=0; i<arrtags.length;i++){
			var tmpItem = $('<li data-value="'+arrtags[i]+'"></li>');
			tmpItem.append('<div class="btndel"></div>');
			tmpItem.append("<span>"+arrtags[i]+"</span>");
			$("#listKeywords").append(tmpItem);
			$(".btndel",tmpItem).hover(function(e){
				showTooltip("Supprimer", e.pageX, e.pageY)
			},function(e){
				hideTooltip()
			})
			$(".btndel",tmpItem).click(function(e) {
				hideTooltip()
				$(this).parent().remove();
				checkAS()
			});
		}
	}
	if(arrcat.length!=0){
		for(var i=0; i<arrcat.length;i++){
			var label = getLabel('cat',arrcat[i]);
			var tmpItem = $('<li data-value="'+arrcat[i]+'"></li>');
			tmpItem.append('<div class="btndel"></div>');
			tmpItem.append("<span>"+label+"</span>");
			
			$("#listThemes").append(tmpItem);
			$(".btndel",tmpItem).hover(function(e){
				showTooltip("Supprimer", e.pageX, e.pageY)
			},function(e){
				hideTooltip()
			})
			
			$(".btndel",tmpItem).click(function(e) {
				hideTooltip()
				$(this).parent().remove();
				checkAS()
			});
		}
	}
	if(arrpays.length!=0){
		for(var i=0; i<arrpays.length;i++){
			var label = getLabel('pays',arrpays[i]);
			var tmpItem = $('<li data-value="'+arrpays[i]+'"></li>');
			tmpItem.append('<div class="btndel"></div>');
			tmpItem.append("<span>"+label+"</span>");
			
			$("#listRegions").append(tmpItem);
			$(".btndel",tmpItem).hover(function(e){
				showTooltip("Supprimer", e.pageX, e.pageY)
			},function(e){
				hideTooltip()
			})
			
			$(".btndel",tmpItem).click(function(e) {
				hideTooltip()
				$(this).parent().remove();
				checkAS()
			});
		}
	}
	if(arrregions.length!=0){
		for(var i=0; i<arrregions.length;i++){
			var label = getLabel('pays',arrregions[i]);
			var tmpItem = $('<li data-value="'+arrregions[i]+'" data-type="region"></li>');
			tmpItem.append('<div class="btndel"></div>');
			tmpItem.append("<span>"+label+"</span>");
			
			$("#listRegions").append(tmpItem);
			$(".btndel",tmpItem).hover(function(e){
				showTooltip("Supprimer", e.pageX, e.pageY)
			},function(e){
				hideTooltip()
			})
			
			$(".btndel",tmpItem).click(function(e) {
				hideTooltip()
				$(this).parent().remove();
				checkAS()
			});
		}
	}
	
}
function getLabel(type, value){
	var label = ""
	switch(type){
		case "cat":{
			$("option", "#select-category").each(function(index, element) {
				if($(this).val()==value) label = $(this).text(); 
			});
		}break;
		case "pays":{
			$("option", "#select-pays_assoc").each(function(index, element) {
				if($(this).val()==value) label = $(this).text(); 
			});
		}break;
	}
	return label
}


function submitAdvancedSearch(){
	var ttxt = $("input[name=tag]").val()
	var fsep = $("li", "#listKeywords").length>0 ? ",":"";
	if(ttxt!="") $("input[name=totaltags]").val(ttxt+fsep);
	$("li", "#listKeywords").each(function(index, element) {
		var sep = index == $("li", "#listKeywords").length-1 ? "":","
		$("input[name=totaltags]").val($("input[name=totaltags]").val()+$(this).attr("data-value")+sep);
	});
	$("li", "#listThemes").each(function(index, element) {
		var sep = index == $("li", "#listThemes").length-1 ? "":","
		$("input[name=totalcat]").val($("input[name=totalcat]").val()+$(this).attr("data-value")+sep);
	});
	$("li", "#listRegions").each(function(index, element) {
		//var sep = index == $("li", "#listRegions").length-1 ? "":","
		var sep = ",";
		if($(this).attr("data-type")=="region") $("input[name=totalregions]").val($("input[name=totalregions]").val()+$(this).attr("data-value")+sep);
		else $("input[name=totalpays]").val($("input[name=totalpays]").val()+$(this).attr("data-value")+sep);
	});
	$("input[name=totalregions]").val($("input[name=totalregions]").val().slice(0,-1))
	$("input[name=totalpays]").val($("input[name=totalpays]").val().slice(0,-1))
	$("#rechRess").submit();
}


function showTooltip(txt, x, y){
	var tt = $("#toolTip");
	tt.html(txt);
	TweenMax.to(tt, 0, {autoAlpha:0, left:x+15, top:y+30})
	TweenMax.to(tt, 0.7, {autoAlpha:1,left:x+15,top:y+15, ease:Power2.easeOut})
}
function hideTooltip(){
	var tt = $("#toolTip");
	TweenMax.to(tt, 0.5, {autoAlpha:0})
}



