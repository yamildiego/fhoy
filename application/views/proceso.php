<style>
    html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
    }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script>
    var map;
    var geocoder;

    function initialize() {
        var mapOptions = {
            zoom: 8,
            center: new google.maps.LatLng(-34.397, 150.644)
        };
        geocoder = new google.maps.Geocoder();

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        process();
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
    var listado =<?php echo $listado; ?>;

    function process() {
        var elementos = [];
        for (var i = 0; i < listado.length; i++) {
            geocoder.geocode({'address': listado[i].location}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    addMarker(results[0].geometry.location);
                    elementos.push({'lat': results[0].geometry.location.lat(), 'long': results[0].geometry.location.lng()});
                }
            });
        }
        console.log(elementos);
    }

    function addMarker(location) {
        var marker = new google.maps.Marker({
            map: map,
            position: location
        });
    }
</script>
<div id="map-canvas"></div>

