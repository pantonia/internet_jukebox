
<!DOCTYPE html>
<html>
<head>
  <title>Leaflet Basic Map Example</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.css" />
	<!--[if lte IE 8]><link rel="stylesheet" href="http://leafletjs.com/dist/leaflet.ie.css" /><![endif]-->
</head>
<body>
	<div id="map" style="width:100%; height: 500px"></div>

	<script src="http://leafletjs.com/dist/leaflet.js"></script>
	<script>
    //create map
		var map = L.map('map').setView([51.505, -0.09], 13);

   // add tile layer
		L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
		}).addTo(map);

    //add marker 
		L.marker([51.5, -0.09]).addTo(map)
			.bindPopup("<b>Hello world!</b><br />I am a popup.").openPopup();

   //add circle
		L.circle([51.508, -0.11], 500, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
		}).addTo(map).bindPopup("I am a circle.");

   // add polygon
		L.polygon([
			[51.509, -0.08],
			[51.503, -0.06],
			[51.51, -0.047]
		]).addTo(map).bindPopup("I am a polygon.");

   //add popup
		var popup = L.popup();

    //on map click event
		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(map);
		}

   //attach on mapclick even to the map
		map.on('click', onMapClick);

	</script>
</body>
</html>

