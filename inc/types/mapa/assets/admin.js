var mapa = null;
var dibujado = null;
var barra = null

var dibujoSel = 1;

var defaultLat = -40.839618;
var defaultLon = -62.937394;
var defaultZoom = 10;

var fondos = [
  {
    nombre: "rios y rutas",
    url: "https://api.mapbox.com/styles/v1/lnkigneo/cjfvfp0bfa54r2sqphi54j02a/tiles/256/{z}/{x}/{y}"
  },
  {
    nombre: "alturas",
    url: ""
  },
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

    console.log(mapas);
    // carga mapa inicial
    cargar_mapa(1);

    // EVENTS
    jQuery("select[name='museo_historia_plugin_mapa_dibujo_nro']").on("change",function(){cambio_dibujo(this)})
});

function init_datos(nro_mapa){
  var datos = jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+nro_mapa+"]").val();
  if(datos != ""){
    var objDatos = JSON.parse(datos);
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
}

function cargar_mapa(nro_mapa){
  if(mapa) mapa.remove();
  mapa = new L.map('el_mapa');
  console.log("creado");
  //limpiar_mapa();
  //console.log("limpiado");
  init_mapa(nro_mapa);
  console.log("inicializado");
  cargar_fondo();
  console.log("fondo");
  cargar_herramientas();
  bind_all();
  console.log("herramientas");
  cargar_guardado(nro_mapa);
  console.log("dibujo");
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


  mapa.on('movestart',function(e){console.log("move start")});
  mapa.on('moveend',function(e){guardar_pos_mapa()});

  mapa.on('zoomend',function(e){guardar_pos_mapa()});
}

function cargar_fondo(){
    L.tileLayer('?access_token=pk.eyJ1IjoibG5raWduZW8iLCJhIjoiY2pmcG50Z2p4MW9udzJ4cWVhYjJlamdsOSJ9.onjuXh3To0bEWHYCDTcSMg', {
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

function generar_capa(event) {
    var layer = event.layer;
    var ta = document.createElement("textarea");
    layer.bindPopup(ta);
    jQuery(ta).on("change", function(e){
      console.log(ta.value);
    })
    dibujado.addLayer(layer);
    guardar_capas();
}

function editar_capas(e) {
  var layers = e.layers;
  layers.eachLayer(function (layer) {
      dibujado.addLayer(layer);
      guardar_capas();
  });
}

function cargar_capas(geoJson) {
  L.geoJson(geoJson, {
    onEachFeature: function (feature, layer) {
      dibujado.addLayer(layer);
    }
  });
}

function cambio_dibujo(select) {
  dibujoSel = select.value;
  cargar_mapa(dibujoSel);
  console.log(dibujoSel,mapas[dibujoSel-1]);
}

function guardar_capas(){
  mapas[dibujoSel-1].dib = dibujado.toGeoJSON();
  jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+dibujoSel+"]").val(JSON.stringify(mapas[dibujoSel-1]));
  console.log(dibujoSel,mapas);
}

function guardar_pos_mapa(){
  console.log("muevo");
  var pos = mapa.getCenter();
  var zoom = mapa.getZoom();

  console.log("guardo");
  mapas[dibujoSel-1].lat = pos.lat;
  mapas[dibujoSel-1].lon = pos.lng;
  mapas[dibujoSel-1].zoom = zoom;
  jQuery("#guardar input[name=museo_historia_plugin_mapa_datos"+dibujoSel+"]").val(JSON.stringify(mapas[dibujoSel-1]));
  console.log(dibujoSel,mapas);
}
