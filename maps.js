
// get the geolocation of the user with a promise
function getLocation() {
    return new Promise(function(resolve, reject) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(resolve, reject);
        } else {
            reject('Geolocation is not supported by this browser.');
        }
    });
}

// get the geolocation of the user
getLocation().then(function(position) {
    // get the latitude and longitude
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;

    // create a new object with the latitude and longitude
    var center = {
        lat: lat,
        lng: lng

    };

    // return the object
    return center;
}).then(function(center) {
    // create a new map




    var map = L.map('map').setView([center.lat, center.lng], 13);


    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker= L.marker([center.lat, center.lng]).addTo(map);
})

//
//



console.log(center.lat, center.lng);