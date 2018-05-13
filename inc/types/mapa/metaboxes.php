<?php

add_action ('add_meta_boxes','museo_historia_plugin_mapa_metaboxes');

function museo_historia_plugin_mapa_metaboxes() {
    global $post;
    if($post->post_type == 'mapa'){
        add_meta_box('museo_historia_plugin_mapa_fecha',"Fecha", 'museo_historia_plugin_mapa_fecha_meta_box', null, 'normal','core');
    }
}

function museo_historia_plugin_mapa_perfil_meta_box(){
    global $post;
    $id = $post->ID;
    $fecha = get_post_meta($id,'museo_historia_plugin_mapa_fecha',true);
    print "<div id='museo_historia_plugin_mapa_fecha_container'>";
    print "<input name='museo_historia_plugin_mapa_fecha_input'>";
    print "</div>";
    print "<div style='clear:both;'></div>";
}

/**
 * Mapa
 */
function museo_historia_plugin_mapa_editor(){
    global $post;
    if($post->post_type == 'mapa'){
        $id = $post->ID;
        $layer1 = get_post_meta($id,'museo_historia_plugin_mapa_datos1',true);
        $layer2 = get_post_meta($id,'museo_historia_plugin_mapa_datos2',true);
        $layer3 = get_post_meta($id,'museo_historia_plugin_mapa_datos3',true);
        print "<div id='museo_historia_plugin_mapa_container' class='postbox-container'>";
        print "<div id='el_mapa'></div>";
        print "</div>";
        print "<div id='guardar'>";
        print "<input type='text' name='museo_historia_plugin_mapa_datos1' value='".$layer1."' />";
        print "<input type='text' name='museo_historia_plugin_mapa_datos2' value='".$layer2."' />";
        print "<input type='text' name='museo_historia_plugin_mapa_datos3' value='".$layer3."' />";
        print "<select name='museo_historia_plugin_mapa_dibujo_nro'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select>";
        print "</div><div style='clear:both;'></div>";
    }
}
add_action('edit_form_after_title','museo_historia_plugin_mapa_editor');
