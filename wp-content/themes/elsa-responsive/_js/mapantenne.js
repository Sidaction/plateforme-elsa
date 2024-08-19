
$(document).ready(function() {
	var myMap;
	var markers=[];
    var bounds = new google.maps.LatLngBounds ();	
    init();	

	function init(request)  {
          initMap(); 
	}

	function initMap()  {
	  var latlng = new google.maps.LatLng(47.68, 9.29);
	  var options = {
		zoom: 5,
		minZoom: 3,
		maxZoom: 17,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.MAP,
		streetViewControl:false,
		zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.MEDIUM,
				position: google.maps.ControlPosition.LEFT_TOP

			},

		panControl:false,
		mapTypeControl:false,

	 };

	var mapdiv;
	mapdiv=document.getElementById("mapPays");
  	myMap = new google.maps.Map(mapdiv, options);

		var styles2 = [
  {
    "featureType": "water",
    "stylers": [
      { "gamma": 1.61 },
      { "saturation": -36 },
      { "hue": "#0EA8C3" },
      { "lightness": -40 }
    ]
  },{
    "featureType": "transit",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "road.highway",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "road.local",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi",
    "stylers": [
      { "visibility": "off" }
    ]
  },{
    "featureType": "poi.park",
    "stylers": [
      { "visibility": "simplified" },
      { "saturation": -27 },
      { "color": "#55c258" },
      { "lightness": 39 }
    ]
  },{
    "featureType": "landscape",
    "stylers": [
      { "gamma": 1.49 },
      { "saturation": -8 },
      { "lightness": 20 }
    ]
  },{
    "featureType": "administrative",
    "elementType": "geometry.fill",
    "stylers": [
      { "visibility": "on" },
      { "color": "#6b737d" },
      { "lightness": 1 },
      { "weight": 0.1 }
    ]
  },{
    "featureType": "administrative",
    "elementType": "labels.text.fill",
    "stylers": [
      { "visibility": "on" },
      { "color": "#5b6280" }
    ]
  },
  {
    "featureType": "administrative",
    "elementType": "labels.text",
    "stylers": [
      { "weight": 1.6 },
      { "lightness": 38 },
      { "visibility": "simplified" }
    ]
  },{
    "featureType": "administrative.locality",
    "stylers": [
      { "visibility": "off" }
    ]
  },
  {
        "featureType": "administrative",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#A7A7A6"
            },
            {
                "lightness": 14
            },
            {
                "weight": 1.4
            }
        ]
    }

]
 	 // myMap.setOptions({styles: styles2});
	  showMarkers();

	}





function showMarkers() {

  markers=[];
  var panel = $('#markerlist');
  panel.html('');
  var numMarkers = datas.length;
  var latlng_pos=[];

  for (var i = 0; i < numMarkers; i++) {
    var latLng = new google.maps.LatLng(datas[i].lat,datas[i].lng);
	bounds.extend(latLng); 
   var imageUrl = imgdir+'/assets/img/map_marker.png';
   var markerImage = new google.maps.MarkerImage(imageUrl,new google.maps.Size(25, 40));

    var marker = new google.maps.Marker({
      'position': latLng,
	  map: myMap,
	  slug:datas[i].slug,
      'icon': markerImage
    });

	markers.push(marker);
    latlng_pos[i] = latLng
	
  }
	/// Zoom et centre de la carte
	if(numMarkers>1){
	  myMap.fitBounds (bounds);
	}else{
	  myMap.setCenter(markers[0].getPosition());
	}

};

	


 function clearMap() {
  for (var i = 0, marker; marker = markers[i]; i++) {
    marker.setMap(null);
  }
};






});