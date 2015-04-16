<?php
function rms_googlemap($atts, $content= NULL)
{
    extract(shortcode_atts(array(
        'lat' => '',
		'lng' => '',
		'icon' => '',
		'zoom' => '',
		'contents' => '',
		'contents2' => ''
    ), $atts));
    ?>
    <section class="contact-map" id="contact-map">
		<h2 class="empty">RMS</h2>
        <div id="map"></div>
		<script>
		jQuery(function () {
			google.maps.event.addDomListener(window, 'load', init);
			function init() {
				var myLatlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
				var maptooltipbold = '<?php echo $contents; ?>';
				var maptooltip = '<?php echo $contents2; ?>';
				
				
				//---------------------------------------------------------//
				
				
				var mapOptions = {
					zoom: <?php echo $zoom; ?>,
					scrollwheel: false,
					center: myLatlng,
					styles: [{featureType:"landscape",
					stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",
					stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",
					stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",
					stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",
					stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",
					stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",
					stylers:[{visibility:"off"}]/**/},{featureType:"administrative.locality",
					stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",
					stylers:[{visibility:"on"}]/**/},{featureType:"water",elementType:"labels",
					stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",
					stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}]
				};

				var mapElement = document.getElementById('map');
				var map = new google.maps.Map(mapElement, mapOptions);
				var image = '<?php echo $icon; ?>';
				var content = document.createElement('div');
				content.innerHTML = "<div class="+"map-tooltip"+"><h4><strong>"+maptooltipbold+"</strong></h4><hr>"+"<h5>"+maptooltip+"</h5></div>";
				var infowindow = new google.maps.InfoWindow({
				 content: content
				});
				
				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					draggable:false,
					scrollwheel: false,
					icon: image,
					animation: google.maps.Animation.BOUNCE
				});
					google.maps.event.addListener(marker, 'click', function() {
					  infowindow.open(map, marker);
					});

			}
		});
		</script>
    </section>
<?php 
}
add_shortcode('rms-googlemap', 'rms_googlemap');