import { $, $$ } from './helpers.js';
import { autocompleteGeocodeUrl, distanceCalculate, requestGeocode } from './here.js';
import { center } from './config.js';
import { calculateIsoline, marker } from './app.js';

class Search {
   constructor(startLocation, map, current = false) {
      this.active = 0;
      this.distance = 0;
      this.matches = [];
      this.container = $('.search-container');
      this.input = $('.city-field');
      this.input.innerText = startLocation;
      this.input.oninput = (evt) => this.updateField(evt);
      this.input.onkeydown = (evt) => this.onkeyinput(evt);
      this.label = '';
      this.currentIndex = 0;
      this.searchMarkers = [];
      this.map = map;
      this.current = current;
      this.setUpClickListener(map);
      this.checkState();
   }

   checkState() {
      const that = this;
      $$('input[type=radio][name=address]').forEach(c => c.onchange = (e) => {
         if (e.target.value == "current") {
             $('.city-field-suggestion').innerText = '';
             $('.city-field').innerText = '';
             var event = new CustomEvent("startLocation");
             document.dispatchEvent(event);
            that.selectCurrent();
         } else if (e.target.value == "registred") {
             if(this.searchMarkers.length) {
                 this.map.removeObjects(this.searchMarkers);
                 this.searchMarkers = [];
             }

             const value = e.target.parentNode.querySelector("input[type='hidden']").value;
             var event = new CustomEvent("addedMarkers", {
                 detail: {
                     registred: true,
                     value
                 }
             });
             document.dispatchEvent(event);

         } else {
             var eventClear = new CustomEvent("removedMarkers");
             document.dispatchEvent(eventClear);
             if(this.searchMarkers.length) {
                 this.map.removeObjects(this.searchMarkers);
                 this.searchMarkers = [];
             }
         }
      });

       $$('#sidebar a').forEach(c => c.onclick = (e) => {
           var eventClear = new CustomEvent("removedMarkers");
           document.dispatchEvent(eventClear);
           if(this.searchMarkers.length) {
               this.map.removeObjects(this.searchMarkers);
               this.searchMarkers = [];
           }
           const isCurrentChecked = document.querySelector('input[type=radio][name=address]');
           if (isCurrentChecked.value !== null) {
               isCurrentChecked.checked = false;
           }
       });

       }

   async updateField(evt) {
       const isCurrentChecked = document.querySelector('input[type=radio][name=address]');
        if (isCurrentChecked.value !== null) {
            isCurrentChecked.checked = false;
        }

        const value = evt.target.innerText;
          if (value.length === 0) {
             return;
          }

          this.matches = await fetch( autocompleteGeocodeUrl(value) ).then(res => res.json());
          this.matches = this.matches.suggestions.filter((x, i, arr) => x.countryCode === 'BIH' && x.address.city === 'Bugojno' && arr.some(el => el.locationId !== x.locationId));
          let bestMatch = this.matches.findIndex(element => element.address.street.substr(element.address.street - 3).includes(value.substr(value.length - 3)));
          if(bestMatch == -1) bestMatch = 0;
          const match = this.matches[bestMatch];
          if (match === undefined) {
             $('.city-field-suggestion').innerText = '';
          } else {
             const textLabel = match.address.houseNumber != undefined ? ' , ' + match.address.houseNumber : '';
             this.label = `${match.address.street}  ${textLabel}`;
             this.active = match.locationId;
             $('.city-field-suggestion').innerHTML = this.matches.map((element) => {
                if (element.address.street !== undefined ){
                    if(element.address.houseNumber !== undefined) {
                        return '<p data-id=' + element.locationId + '>' +  element.address.street + ', ' + element.address.houseNumber + '</p>';

                    } else {
                        return '<p data-id=' + element.locationId + '>' +  element.address.street + '</p>';
                    }
                }
             }).join('');

          }
   }

   onkeyinput(evt) {
      const code = evt.keyCode;
      const that = this;
      if (code === 13 || code === 9) {
         $('.city-field').innerText = this.label;
          $('.city-field-suggestion').innerText = '';
          evt.preventDefault();
         this.selectMatch();
      }

      if (code === 40) {
         /*If the arrow DOWN key is pressed,
         increase the currentIndex variable:*/
         if (this.matches !== undefined) {
            if (this.currentIndex === -1 || this.currentIndex ===  this.matches.length) this.currentIndex = 0;
            console.log(this.currentIndex);
            // if (this.currentIndex > this.matches.suggestions.length) this.currentIndex = 0;
            const textLabel = this.matches[this.currentIndex].address.houseNumber != undefined ? ' , ' + this.matches[this.currentIndex].address.houseNumber : '';
            this.label = `${this.matches[this.currentIndex].address.street}  ${textLabel}`;
            evt.target.innerText = this.label;
            this.active = this.matches[this.currentIndex].locationId;
         } else {
            this.currentIndex = 0;
         }
         this.currentIndex++;
         /*and and make the current item more visible:*/
      }

      if (code === 38) {
         /*If the arrow UP key is pressed,
         increase the currentIndex variable:*/
         if (this.matches !== undefined) {
            if (this.currentIndex === -1 || this.currentIndex ===  this.matches.length) this.currentIndex = this.matches.length - 1;
            const textLabel = this.matches[this.currentIndex].address.houseNumber != undefined ? ' , ' + this.matches[this.currentIndex].address.houseNumber : '';
            this.label = `${this.matches[this.currentIndex].address.street}  ${textLabel}`;
            evt.target.innerText = this.label;
            this.active = this.matches[this.currentIndex].locationId;
         } else {
            this.currentIndex = 0;
         }
         this.currentIndex--;
         /*and and make the current item more visible:*/
      }
   }

   async selectMatch() {
      const { Latitude: lat, Longitude: lng } = await requestGeocode(this.active);
      center.lat = lat;
      center.lng = lng;
      this.distance = await fetch( distanceCalculate(center.lat, center.lng) ).then(res => res.json());
      var marker = new H.map.Marker({lat:lat, lng: lng});
      if (this.searchMarkers.length) {
          var event = new CustomEvent("removedMarkers");
          document.dispatchEvent(event);
          this.map.removeObjects(this.searchMarkers);
          this.searchMarkers = [];
      }
      this.searchMarkers.length = 0;
       // create and dispatch the event
       var eventSelect = new CustomEvent("addedMarkers", {
           detail: {
               lat: lat,
               lng: lng
           }
       });
       document.dispatchEvent(eventSelect);
      this.checkMarker(marker, lat, lng);
      // calculateIsoline(center);

       document.getElementById("map").scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
   }

   setUpClickListener(map) {
      const that = this;
      map.addEventListener('tap', function (evt) {
         if (that.searchMarkers.length) {
             var event = new CustomEvent("removedMarkers");
             document.dispatchEvent(event);
             that.map.removeObjects(that.searchMarkers);
             this.searchMarkers = [];
         }
         that.searchMarkers = [];
         var coord = map.screenToGeo(evt.currentPointer.viewportX,evt.currentPointer.viewportY);
         var marker = new H.map.Marker({lat:coord.lat.toFixed(4), lng:coord.lng.toFixed(4)});
         that.checkMarker(marker, coord.lat.toFixed(4), coord.lng.toFixed(4));
          const eventAddress = new CustomEvent("addedMarkers", {
              detail: {
                  lat: coord.lat.toFixed(4),
                  lng: coord.lng.toFixed(4)
              }
          });
          document.dispatchEvent(eventAddress);
      });

       $('.city-field-suggestion').addEventListener('click', (evt) => {
           const locationId = evt.target.dataset.id;
           if(locationId) {
               const matchClicked = this.matches.filter(x => x.locationId === locationId)[0];
               console.log(matchClicked);
               const textLabel = matchClicked.address.houseNumber != undefined ? ' , ' + matchClicked.address.houseNumber : '';
               this.label = `${matchClicked.address.street}  ${textLabel}`;
               this.input.innerText = this.label;
               this.active = matchClicked.locationId;
               $('.city-field-suggestion').innerText = '';
               this.selectMatch();
           }
       });
   }

   selectCurrent() {
      const that = this;
      if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function(position) {
             var latitude = position.coords.latitude;
             var longitude = position.coords.longitude;
             var accuracy = position.coords.accuracy;
            var marker = new H.map.Marker({lat:latitude, lng: longitude});
            var event = new CustomEvent("addedMarkers", {
                 detail: {
                     lat: latitude,
                     lng: longitude
                 }
             });
             document.dispatchEvent(event);
             var eventProcessed = new CustomEvent("foundLocation");
             document.dispatchEvent(eventProcessed);
            that.checkMarker(marker, latitude, longitude);
             document.getElementById("map").scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
         },
         function error(msg) {
             var event = new CustomEvent("locationEnable");
             document.dispatchEvent(event);
         },
             {maximumAge:60000, timeout:5000, enableHighAccuracy:true});
     } else {
         alert("Nažalost ne možemo vas pronaći.");
     }
   }

   async checkMarker(marker, lat, lng) {
      this.distance = await fetch( distanceCalculate(lat, lng) ).then(res => res.json());
      if (this.distance.response.route[0].summary.distance > 7500) {
         alert('Nažalost, ne pokrivamo traženi teritorij.')
      } else {
         this.searchMarkers.push(marker);
         this.map.addObject(marker);
         this.map.setZoom(18);
         this.map.setCenter({lat:lat, lng:lng});
      }
   }
}

export default Search;
