<?php
/**
 * Created by Khang Nguyen.
 * Email: khang.nguyen@banvien.com
 * Date: 7/30/2017
 * Time: 4:58 PM
 */
?>
<div id="mapDetail" class="row no-margin">
	<div id="map" class="col-md-6 col-xs-12"></div>
	<div id="mapInfo" class="col-md-6 col-xs-12 no-padding"></div>
	<div class="clear-both"></div>
</div>

<script type="text/javascript">
	var map;
	var infoWindow;
	var uluru = {lat: <?=$product->Latitude?>, lng: <?=$product->Longitude?>};
	var markers = [];
	function initMap() {
		initMapNearBy('', 17);
	}

	function initMapNearBy(nearBy, zoomLevel){
		infoWindow = new google.maps.InfoWindow;
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: zoomLevel,
			center: uluru
		});

		var marker = new google.maps.Marker({
			position: uluru,
			map: map,
			label: 'K',
			icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
		});

		var infowincontent = document.createElement('div');
		var strong = document.createElement('strong');
		strong.textContent = '<?=$product->Address?>';
		infowincontent.appendChild(strong);
		infowincontent.appendChild(document.createElement('br'));

		marker.addListener('click', function() {
			infoWindow.setContent(infowincontent);
			infoWindow.open(map, marker);
		});

		// Searvices
		if(nearBy != null && nearBy != undefined && nearBy.length > 0) {
			var service = new google.maps.places.PlacesService(map);
			service.nearbySearch({
				location: uluru,
				radius: 500,
				type: [nearBy]
			}, callbackService);
		}else{
			// Open by default
			infoWindow.setContent(infowincontent);
			infoWindow.open(map, marker);
		}
	}

	function callbackService(results, status) {
		var str = '<span class="no-data">Không có dữ liệu</span>';
		if (status === google.maps.places.PlacesServiceStatus.OK) {
			if(results.length > 0) {
				str = '<ul class="nearme">';
				for (var i = 0; i < results.length; i++) {
					var marker = createMarker(results[i]);
					markers[i] = marker;
					var lat2 = results[i].geometry.location.lat();
					var lon2 = results[i].geometry.location.lng();
					var R = 6371e3; // metres
					var φ1 = toRadians(uluru.lat);
					var φ2 = toRadians(lat2);
					var Δφ = toRadians(lat2 - uluru.lat);
					var Δλ = toRadians(lon2 - uluru.lng);

					var a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
						Math.cos(φ1) * Math.cos(φ2) *
						Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
					var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

					var d = (R * c).toFixed(0);
					str += '<li><span class="serviceName"><a onclick="showMe('+i+');">' + results[i].name + '</a></span><span class="distance">' + d + " m</span><div class=\"clear-both\"></div>" + '</li>';
				}
				str += "</ul>";
			}
		}
		$("#mapInfo").html(str);
		$(".nearme").mCustomScrollbar({axis:"y"});
	}

	function showMe(index){
		google.maps.event.trigger(markers[index], 'click');
	}

	function toRadians (angle) {
		return angle * (Math.PI / 180);
	}

	function createMarker(place) {
		var placeLoc = place.geometry.location;
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location
		});

		google.maps.event.addListener(marker, 'click', function() {
			infoWindow.setContent(place.name);
			infoWindow.open(map, this);
		});
		return marker;
	}

	$(document).ready(function(){
		$('#mapTabs a').click(function(){
			var thisTitle = $(this).text();
			var type = $(this).data('type');
			if(type != null && type != undefined){
				$("#mapDetail").addClass('hasInfo');
				initMapNearBy(type, 16);
			}else{
				$("#mapDetail").removeClass('hasInfo');
				initMapNearBy('', 17);
			}
			ga('send', {
				hitType: 'event',
				eventCategory: 'Bản Đồ',
				eventAction: thisTitle
			});
		});
	});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_KEY?>&callback=initMap&libraries=places"></script>

