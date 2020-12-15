import { hereCredentials } from './config.js';
import { router, geocoder } from './app.js';

var AUTOCOMPLETION_URL = 'https://autocomplete.geocoder.ls.hereapi.com/6.2/suggest.json',
    ajaxRequest = new XMLHttpRequest();
const autocompleteGeocodeUrl = (query) => {
var params = '?' +
               'language=bs'+
                '&query=' +  encodeURIComponent(query) +   // The search text which is the basis of the query
                '&country=BIH' +  // The upper limit the for number of suggestions to be included
                '&maxresults=5' +  // The upper limit the for number of suggestions to be included
                // in the response.  Default is set to 5.
                '&apikey=' + hereCredentials.apikey;
                return  AUTOCOMPLETION_URL + params 
}

const distanceCalculate = (lat, lang) => {
    const url = 'https://route.ls.hereapi.com/routing/7.2/calculateroute.json';

    var params = '?' +
               'waypoint0=geo!44.05505,17.44742' +
                '&waypoint1=geo!' + lat + ',' + lang +
                '&routeattributes=wp,sm,sh,sc' +
                '&mode=fastest;car' +
                '&apikey=' + hereCredentials.apikey;
                return  url + params 
}

// Attach the event listeners to the XMLHttpRequest object
// ajaxRequest.addEventListener("load", onAutoCompleteSuccess);
// ajaxRequest.addEventListener("error", onAutoCompleteFailed);
ajaxRequest.responseType = "json";

const requestGeocode = locationid => {
   return new Promise((resolve, reject) => {
      geocoder.geocode(
         { locationid },
         res => {
            const coordinates = res.Response.View[0].Result[0].Location.DisplayPosition;
            resolve(coordinates);
         },
         err => reject(err)
      )
   })
}

const isolineMaxRange = {
   time: 32400, //seconds
   distance: 7500 //meters
}


const requestIsolineShape = options => {
   const params = {
      'mode': `fastest;${options.mode};traffic:disabled;motorway:-3`,
      'start': `geo!${options.center.lat},${options.center.lng}`,
      'range': options.range,
      'rangetype': options.rangeType,
   };

   return new Promise((resolve, reject) => {
      router.calculateIsoline(
         params,
         res => {
            const shape = res.response.isoline[0].component[0].shape.map(z => z.split(','));
            resolve( shape )
         },
         err => reject(err)
      );
   })
}

export { 
   autocompleteGeocodeUrl, 
   distanceCalculate, 
   isolineMaxRange,
   requestGeocode,
   requestIsolineShape
}