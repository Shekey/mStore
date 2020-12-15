import Search from './Search.js';
import { $, $$, to24HourFormat, formatRangeLabel, toDateInputFormat } from './helpers.js';
import { center, hereCredentials } from './config.js';
import { isolineMaxRange, requestIsolineShape } from './here.js';

//Height calculations
    const height = $('#content-group-1').clientHeight || $('#content-group-1').offsetHeight;
    $('.content').style.height = '500' + 'px';

    // Initialize HERE Map
    const platform = new H.service.Platform({ apikey: hereCredentials.apikey });
    const defaultLayers = platform.createDefaultLayers();
    const map = new H.Map(document.getElementById('map'), defaultLayers.raster.satellite.map, {
       center,
       zoom: 14,
       pixelRatio: window.devicePixelRatio || 1
    });
    const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
    const provider = map.getBaseLayer().getProvider();

    //Initialize router and geocoder
    const router = platform.getRoutingService();
    const geocoder = platform.getGeocodingService();

    window.addEventListener('resize', () => map.getViewPort().resize());

    // Initialize search and hour filter
    new Search('', map, false);

    //Inititalize map marker and polygon
    let polygon;
    const marker = new H.map.Marker(center, {volatility: true});
    marker.draggable = false;
    // map.addObject(marker);

    //Calculate initialize isoline
    calculateIsoline(center)

    // Add event listeners for marker movement
    map.addEventListener('dragstart', evt => {
       if (evt.target instanceof H.map.Marker) behavior.disable();
    }, false);
    map.addEventListener('dragend', evt => {
       if (evt.target instanceof H.map.Marker) {
          behavior.enable();
          calculateIsoline();
       }
    }, false);
    map.addEventListener('drag', evt => {
       const pointer = evt.currentPointer;
       if (evt.target instanceof H.map.Marker) {
         evt.target.setGeometry(map.screenToGeo(pointer.viewportX, pointer.viewportY));
       }
    }, false);

    function showPosition(position) {
       alert( position.coords.latitude,position.coords.longitude)
    }

    //Manage initial state
    $('#date-value').value = toDateInputFormat(new Date());

    $$('.isoline-controls').forEach(c => c.onchange = () => calculateIsoline());
    $$('.view-controls').forEach(c => c.onchange = () => calculateView());

    var group = new H.map.Group();
    //Calculate isolines
    async function calculateIsoline() {
       console.log('updating...')
       const options = {
          mode: 'car',
          range: 7500,
          rangeType: 'distance',
          center: marker.getGeometry(),
          date: $('#date-value').value === '' ? toDateInputFormat(new Date()) : $('#date-value').value,
          time: to24HourFormat($('#hour-slider').value)
       }

        if (options.range > isolineMaxRange.distance) {
            options.range = isolineMaxRange.distance
        }

       map.setCenter(options.center, true);

       const linestring = new H.geo.LineString();

       const isolineShape = await requestIsolineShape(options);
       isolineShape.forEach(p => linestring.pushLatLngAlt.apply(linestring, p));

       if (polygon !== undefined) {
          map.removeObject(polygon);
       }

       polygon = new H.map.Polygon(linestring, {
          style: {
             fillColor: 'rgba(74, 134, 255, 0.3)',
             strokeColor: '#4A86FF',
             lineWidth: 2
          }
       });
       map.addObject(polygon);
    }

    function calculateView() {
       const options = {
          theme: $('#day').checked ? 'day' : 'night',
          static: $('#static').checked
       }
       if (options.static) {
          rotation.stop();
       } else {
          rotation.start();
       }
    }


    export { calculateIsoline, marker, router, geocoder }
