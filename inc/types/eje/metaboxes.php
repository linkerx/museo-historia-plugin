<?php

add_action ('add_meta_boxes','museo_historia_plugin_eje_metaboxes');

function museo_historia_plugin_eje_metaboxes() {
    global $post;
    if($post->post_type == 'eje'){
        add_meta_box('museo_historia_plugin_eje_fecha',"Fecha", 'museo_historia_plugin_eje_fecha_meta_box', null, 'normal','core');
    }
}

function museo_historia_plugin_eje_perfil_meta_box(){
    global $post;
    $id = $post->ID;
    $fecha = get_post_meta($id,'museo_historia_plugin_eje_fecha',true);
    print "<div id='museo_historia_plugin_eje_fecha_container'>";
    print "<input name='museo_historia_plugin_eje_fecha_input'>";
    print "</div>";
    print "<div style='clear:both;'></div>";
}

