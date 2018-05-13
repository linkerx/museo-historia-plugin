<?php

add_action ('add_meta_boxes','museo_historia_plugin_eje_metaboxes');

function museo_historia_plugin_eje_metaboxes() {
    global $post;
    if($post->post_type == 'eje'){
        add_meta_box('museo_historia_plugin_eje_recurso_didactico',"Recurso Didáctico", 'museo_historia_plugin_eje_recurso_didactico_meta_box', null, 'normal','core');
        add_meta_box('museo_historia_plugin_eje_contenido_oficial',"Contenido Oficial", 'museo_historia_plugin_eje_contenido_oficial_meta_box', null, 'normal','core');
        add_meta_box('museo_historia_plugin_eje_dimension_local',"Dimension Local", 'museo_historia_plugin_eje_dimension_local_meta_box', null, 'normal','core');
        add_meta_box('museo_historia_plugin_eje_actividades',"Actividades", 'museo_historia_plugin_eje_actividades_meta_box', null, 'normal','core');
        add_meta_box('museo_historia_plugin_eje_objetivos',"Objetivos", 'museo_historia_plugin_eje_objetivos_meta_box', null, 'normal','core');
    }
}

function museo_historia_plugin_eje_recurso_didactico_meta_box(){
    global $post;
    $id = $post->ID;
    $recurso_didactico = get_post_meta($id,'museo_historia_plugin_eje_recurso_didactico',true);
    print "<div id='museo_historia_plugin_eje_recurso_didactico_container'>";
    wp_editor($recurso_didactico, "museo_historia_plugin_eje_recurso_didactico_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_eje_contenido_oficial_meta_box(){
    global $post;
    $id = $post->ID;
    $contenido_oficial = get_post_meta($id,'museo_historia_plugin_eje_recurso_didactico',true);
    print "<div id='museo_historia_plugin_eje_recurso_didactico_container'>";
    wp_editor($contenido_oficial, "museo_historia_plugin_eje_recurso_didactico_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_eje_dimension_local_meta_box(){
    global $post;
    $id = $post->ID;
    $dimension_local = get_post_meta($id,'museo_historia_plugin_eje_dimension_local',true);
    print "<div id='museo_historia_plugin_eje_dimension_local_container'>";
    wp_editor($dimension_local, "museo_historia_plugin_eje_dimension_local_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_eje_objetivos_meta_box(){
    global $post;
    $id = $post->ID;
    $objetivos = get_post_meta($id,'museo_historia_plugin_eje_objetivos',true);
    print "<div id='museo_historia_plugin_eje_objetivos_container'>";
    wp_editor($objetivos, "museo_historia_plugin_eje_objetivos_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_eje_actividades_meta_box(){
    global $post;
    $id = $post->ID;
    $actividades = get_post_meta($id,'museo_historia_plugin_eje_actividades',true);
    print "<div id='museo_historia_plugin_eje_actividades_container'>";
    wp_editor($actividades, "museo_historia_plugin_eje_actividades_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}
