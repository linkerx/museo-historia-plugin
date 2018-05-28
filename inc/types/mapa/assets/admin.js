var debug = false

var mapa = null;
var dibujado = null;
var barra = null;
var popup = null;

var editActions = [
    L.Toolbar2.EditAction.Popup.Edit,
    L.Toolbar2.EditAction.Popup.Delete,
    L.Toolbar2.Action.extend({
        options: {
            toolbarIcon: {
                className: 'leaflet-color-picker',
                html: '<span class="fa fa-eyedropper"></span>'
            },
            subToolbar: new L.Toolbar2({ actions: [
                L.ColorPicker.extendOptions({ color: '#3388ff' }),
                L.ColorPicker.extendOptions({ color: '#db1d0f' }),
                L.ColorPicker.extendOptions({ color: '#025100' }),
                L.ColorPicker.extendOptions({ color: '#ffff00' })
            ]})
        }
    }),
    /*
    L.Toolbar2.Action.extend({
        options: {
          toolbarIcon: {
            className: 'lnk-text-input',
            html: '<span class="fa fa-pencil"></span>'
          }
        },
        initialize: function(map, shape, options) {
      		this._map = map;
      		this._shape = shape;

      		L.setOptions(this, options);
      		L.Toolbar2.Action.prototype.initialize.call(this, map, options);
      	},
        addHooks: function(){
          this._shape.openPopup();
        }
    })
    */
];

var dibujoSel = 1;

var defaultLat = -40.839618;
var defaultLon = -62.937394;
var defaultZoom = 10;

var access_token = "pk.eyJ1IjoibG5raWduZW8iLCJhIjoiY2pmcG50Z2p4MW9udzJ4cWVhYjJlamdsOSJ9.onjuXh3To0bEWHYCDTcSMg";

var fondos = [
  {
    nombre: "Político con rutas y calles",
    url: "https://api.mapbox.com/styles/v1/lnkigneo/cjfpo73gq48dd2rn0a5eedmft/tiles/256/{z}/{x}/{y}"
  },
  {
    nombre: "Imagen satelital",
    url: "https://api.mapbox.com/styles/v1/lnkigneo/cjh8v9qhz04292sqj95mnkhnf/tiles/256/{z}/{x}/{y}"
  },
  {
    nombre: "Antiguo",
    url: "https://api.mapbox.com/styles/v1/lnkigneo/cjh8w9ztj05212sqjvnzmdthd/tiles/256/{z}/{x}/{y}"
  }
]

var fondoSel = 1;

var mapas = [
  {
    lat: null,
    lon: null,
    zoom: null,
    dib: null
  },
  {
    lat: null,
    lon: null,
    zoom: null,
    dib: null
  },
  {
    lat: null,
    lon: null,
    zoom: null,
    dib: null
  }
]

jQuery(window).load(function(){

    // inicializa mapas
    init_datos(1);
    init_datos(2);
    init_datos(3);

    if(debug)
      console.log(mapas);

    // carga mapa inicial
    dibujoSel = 1;
    cargar_mapa();

    // EVENTS
    jQuery("select[name='museo_historia_plugin_mapa_dibujo_nro']").on("change",function(){cambio_dibujo(this)})
    jQuery("select[name='museo_historia_plugin_mapa_fondo']").on("change",function(){cambio_fondo(this)})
});

function init_datos(nro_mapa){
  var datos = jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+nro_mapa+"]").val();
  if(datos != ""){
    var objDatos = JSON.parse(datos);

    if(debug)
      console.log(objDatos);

    mapas[nro_mapa-1].lat = objDatos.lat;
    mapas[nro_mapa-1].lon = objDatos.lon;
    mapas[nro_mapa-1].zoom = objDatos.zoom;
    mapas[nro_mapa-1].dib = objDatos.dib;
  } else {
    mapas[nro_mapa-1].lat = defaultLat;
    mapas[nro_mapa-1].lon = defaultLon;
    mapas[nro_mapa-1].zoom = defaultZoom;
  }
  fondoSel = jQuery("#guardar select[name=museo_historia_plugin_mapa_fondo").val();
}

function cargar_mapa(nro_mapa){
  if(mapa) mapa.remove();
  mapa = new L.map('el_mapa');

      if(debug) console.log("creado");

  //limpiar_mapa();
  //console.log("limpiado");
  init_mapa(dibujoSel);
      if(debug) console.log("inicializado");
  cargar_fondo(fondoSel);
      if(debug) console.log("fondo");
  cargar_herramientas();
  bind_all();
      if(debug) console.log("herramientas");
  cargar_guardado(dibujoSel);
      if(debug) console.log("dibujo");
}

function init_mapa(nro_mapa){
  lat = mapas[nro_mapa-1].lat;
  lon = mapas[nro_mapa-1].lon;
  zoom = mapas[nro_mapa-1].zoom;
  mapa.setView([lat,lon],zoom);  //lat long
}

function limpiar_mapa(){
  mapa.eachLayer(function (layer) {
    mapa.removeLayer(layer);
  });
}

function bind_all() {
  mapa.on(L.Draw.Event.CREATED, function(event) {generar_capa(event)});
  mapa.on('draw:edited', function (e) {editar_capas(e)});
  mapa.on('draw:deleted', function(e) {editar_capas(e)});

  mapa.on('movestart',function(e){console.log("move start")});
  mapa.on('moveend',function(e){guardar_pos_mapa()});

  mapa.on('zoomend',function(e){guardar_pos_mapa()});
}

function bind_layer(layer) {

  layer.on('click', function(event) {
    new L.Toolbar2.Popup(event.latlng, {
      actions: editActions,
    }).addTo(mapa, layer);
  });

  layer.on('color_change',function(){

    layer.feature = {};
    layer.feature.type = 'Feature';
    layer.feature.properties = {};
    layer.feature.properties.color = layer.options.color;

    console.log("color cambiado");
    guardar_capas();
  });

  layer.bindPopup(getLayerEditor(layer),{autoPan: false});
}

function getLayerEditor(layer){
  html= "<div id='text-popup-"+layer._leaflet_id+"' class='text-editor-popup'>";
  html+= "<div class='title'>"+"Titulo: ";
  html+= "<input onChange='guardarTextos();' name='popup_shape_title_"+layer._leaflet_id+"' value='"+layer.feature.properties.title+"' />";
  html+= "</div>";
  html+= "<div class='container'>";
  html+= "<textarea name='popup_shape_text_"+layer._leaflet_id+"'>"+layer.feature.properties.text+"</textarea>";
  html+= "</div>"
  html+= "</div>";
  return html;
}

function cargar_fondo(id_fondo){
    L.tileLayer(fondos[id_fondo].url+'?access_token='+access_token, {
        attribution : '&copy; Mapbox &copy; OpenStreetMap contributors, by linkerx',
        transparent: true
    }).addTo(mapa);
}

function cargar_herramientas(){
    dibujado = new L.FeatureGroup();
    mapa.addLayer(dibujado);
    barra = new L.Control.Draw({
        edit: {
            featureGroup: dibujado
        }
    });
    mapa.addControl(barra);
}

function cargar_guardado(nro_mapa){
  if(mapas[nro_mapa-1].dib != null){
    var layers = mapas[nro_mapa-1].dib;
    cargar_capas(layers);
  }
}

function init_layer_props(layer) {
  layer.feature = {};
  layer.feature.type = 'Feature';
  layer.feature.properties = {};
  layer.feature.properties.color = layer.options.color;
}

function generar_capa(event) {
    var layer = event.layer;
    init_layer_props(layer);
    dibujado.addLayer(layer);
    bind_layer(layer);
    guardar_capas();
}

function editar_capas(e) {
  var layers = e.layers;
  layers.eachLayer(function (layer) {
      dibujado.addLayer(layer);
      bind_layer(layer);
      guardar_capas();
  });
}

function cargar_capas(geoJson) {
  L.geoJson(geoJson, {
    onEachFeature: function (feature, layer) {
      layer.feature.properties = feature.properties;
      if(feature.properties.color != undefined)
        layer.options.color = feature.properties.color;
      dibujado.addLayer(layer);
      bind_layer(layer);
    }
  });
}

function cambio_dibujo(select) {
  dibujoSel = select.value;
  cargar_mapa();
      if(debug) console.log(dibujoSel,mapas[dibujoSel-1]);
}

function cambio_fondo(select) {
  fondoSel = select.value;
  cargar_mapa();
      if(debug) console.log(fondoSel,mapas[dibujoSel-1]);
}

function guardar_capas(){
  mapas[dibujoSel-1].dib = dibujado.toGeoJSON();
  jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+dibujoSel+"]").val(JSON.stringify(mapas[dibujoSel-1]));
      if(debug) console.log(dibujado);
}

function guardar_pos_mapa(){
      if(debug) console.log("muevo");
  var pos = mapa.getCenter();
  var zoom = mapa.getZoom();

      if(debug) console.log("guardo");
  mapas[dibujoSel-1].lat = pos.lat;
  mapas[dibujoSel-1].lon = pos.lng;
  mapas[dibujoSel-1].zoom = zoom;
  jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+dibujoSel+"]").val(JSON.stringify(mapas[dibujoSel-1]));
      if(debug) console.log(dibujoSel,mapas);
}
