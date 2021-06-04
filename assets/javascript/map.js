var map;
var geocoder;
var center;
var markerBounds;

function initialize() {

    geocoder = new google.maps.Geocoder();
    markerBounds = new google.maps.LatLngBounds();

    var mapOptions = {zoom: 17};
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    for (var i = 0; i < markers.length; i++) {
        codeAddress(markers[i].location, markers[i].name, markers[i].long, markers[i].lat);
    }
    center();
}

function center() {
    map.fitBounds(markerBounds);
    map.setCenter(markerBounds.getCenter());
}

function codeAddress(location, name, long, lat) {
    if (long !== false && lat !== 0) {
        var loc = new google.maps.LatLng(lat, long);
        addMarker(loc, name);
        markerBounds.extend(loc);
    } else {
        geocoder.geocode({'address': location}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                addMarker(results[0].geometry.location, name);
                markerBounds.extend(results[0].geometry.location);
            }
        });
    }
}

function addMarker(location, name) {
    var marker = new google.maps.Marker({
        map: map,
        position: location,
        title: name
    });
}

google.maps.event.addDomListener(window, 'load', initialize);
