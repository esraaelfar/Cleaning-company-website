var google;

function initMap() {
    // Define the initial center of the map
    var myLatlng = new google.maps.LatLng(40.69847032728747, -73.9514422416687);
    
    // Define the options for the map
    var mapOptions = {
        zoom: 7, // Initial zoom level
        center: myLatlng, // Center of the map
        scrollwheel: false, // Disable scrolling with the mouse wheel
        styles: [ // Customize the map style
            {
                "featureType": "administrative.country",
                "elementType": "geometry",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "hue": "#ff0000"
                    }
                ]
            }
        ]
    };

    // Get the HTML element that will contain the map
    var mapElement = document.getElementById('map');

    // Create the Google Map object using the specified options
    var map = new google.maps.Map(mapElement, mapOptions);
    
    // Array of addresses to be geocoded
    var addresses = ['New York'];

    // Loop through each address
    addresses.forEach(function(address) {
        // Fetch the geolocation data for the address from the Google Maps Geocoding API
        fetch('https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(address) + '&key=YOUR_API_KEY')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Extract the latitude and longitude from the geolocation data
                var p = data.results[0].geometry.location;
                var latlng = new google.maps.LatLng(p.lat, p.lng);
                // Create a marker at the obtained coordinates and add it to the map
                new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: 'images/loc.png' // Custom marker icon (replace with your own)
                });
            })
            .catch(function(error) {
                console.error('Error fetching geolocation:', error);
            });
    });
}
