let latitude = '';
let longitude = '';

function success(pos) {
   var crd = pos.coords;
   latitude = crd.latitude;
   longitude = crd.longitude;
 }

function getLocation() {
   if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(success);
   } else { 
     x.innerHTML = "Geolocation is not supported by this browser.";
   }
}
getLocation();

const center = { 
   lat: 44.05505, 
   lng: 17.44742, 
   text: 'Gimnazija Bugojno'
}

const hereCredentials = {
   id: 'UQ75LhFcnAv0DtOUwBEA',
   apikey: 'kQAg7weo_uAx-487QgBj0HLIggsmWUHQCDyXwpCHjWY'
}

export { center, hereCredentials };