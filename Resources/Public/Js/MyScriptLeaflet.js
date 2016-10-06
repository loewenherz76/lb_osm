var marker = [];
var map = null;

function init(lat,lon,zoom,maxZoom,MapTyp){

	/*
	 var styles = [
	 {
	 featureType: 'all',
	 stylers: [{hue: '#ff0000'}]
	 }
	 ];
	 var ggl = new L.Google('ROADMAP', {
	 mapOptions: {
	 styles: styles
	 }
	 });
	 */

	if(MapTyp == 1){
		var latlng = L.latLng(lat, lon);
		map = L.map('mapid').setView(latlng, zoom);

		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="http://www.openstreetmap.org/" target="_blank">OpenStreetMap</a>',
			maxZoom: maxZoom,
		}).addTo(map);
	}

	if(MapTyp == 2){
		map = new L.Map('mapid', {center: new L.LatLng(lat, lon), zoom: zoom});
		var ggl = new L.Google('ROADMAP');
		map.addLayer(ggl);
	}
}

$(document).on('click', '#route',
	function(evt) {
		evt.preventDefault();
		var start = jQuery(this).attr('title');
		var win = window.open("https://maps.google.de/maps?f=d&hl=de&daddr=&saddr="+start,'Routenplaner','width=1024,height=768');
		win.focus();
	}
);

function createPois(tmp){

	if(tmp.length > 0){
		for(var i=0;i<tmp.length;i++){

				var _lat = tmp[i]['lat'];
				var _lon = tmp[i]['lon'];
				var latlng = L.latLng(_lat, _lon);

				var _popup = "";
				var _routenplanner = "";

				_popup += '<span class="popup">';

				if(tmp[i]['image']){
					_popup += '<img src="' + tmp[i]['image'] + '">';
				}

				_popup += '<h5>' + tmp[i]['title'] + '</h5>';

				if(tmp[i]['street']){
					_popup += tmp[i]['street'] + '<br/>';
				}

				if(tmp[i]['zip']){
					_popup += tmp[i]['zip'] + ' ';
				}

				if(tmp[i]['location']){
					_popup += tmp[i]['location'] + '<br/>';
				}

				if(tmp[i]['phone']){
					_popup += tmp[i]['phone'] + '<br/>';
				}

				if(tmp[i]['telefax']){
					_popup += tmp[i]['telefax'] + '<br/>';
				}

				if(tmp[i]['email']){
					_popup += tmp[i]['email'] + '<br/>';
				}

				if(tmp[i]['routeplanner'] == 1){

					_routenplanner = tmp[i]['zip'] + ' ' + tmp[i]['location']+','+tmp[i]['street'];

					_popup += '<a href=\"#\" class=\"btn btn-default\" title=\"'+_routenplanner+'\" id=\"route\">Routenplaner</a><br/>';
				}

				_popup += '</span>';


				if(tmp[i]['icon'] != "" && tmp[i]['icon-shadow'] != ""){

					var _icon = new Image();
					_icon.src = tmp[i]['icon'];

					var _iconShadow = new Image();
					_iconShadow.src = tmp[i]['icon-shadow'];

					var _h = _icon.height;
					var _w = _icon.width;
					var _hS = _iconShadow.height;
					var _wS = _iconShadow.width;

					var myIcon = L.icon({
						iconUrl: tmp[i]['icon'],
						shadowUrl: tmp[i]['icon-shadow'],
						iconSize:     [_w, _h],
						iconAnchor:   [(_w/2), _h],
						popupAnchor:  [0, -_h],
						shadowSize:   [_wS, _hS],
						shadowAnchor: [(_w/2), _hS]
					});

					var _marker = L.marker(latlng, {icon: myIcon}, {opacity: 1}).addTo(map).bindPopup(_popup);

				}else if(tmp[i]['icon'] != "" && tmp[i]['icon-shadow'] == ""){

					var _icon = new Image();
					_icon.src = tmp[i]['icon'];

					var _h = _icon.height;
					var _w = _icon.width;

					var myIcon = L.icon({
						iconUrl: tmp[i]['icon'],
						iconSize:     [_w, _h],
						iconAnchor:   [(_w/2), _h],
						popupAnchor:  [0, -_h]
					});

					var _marker = L.marker(latlng, {icon: myIcon}, {opacity: 1}).addTo(map).bindPopup(_popup);

				}else{
					var _marker = L.marker(latlng, {opacity: 1}).addTo(map).bindPopup(_popup);
				}


				var _i = marker.length;

				marker[_i] = [];
				marker[_i]['marker'] = _marker;

				// marker.push(_marker);

				var _i = (marker.length-1);

				map.addLayer(marker[_i]['marker']);
			}

	}
}
