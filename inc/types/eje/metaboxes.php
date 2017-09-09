<?php

add_action ('add_meta_boxes','museo_historia_plugin_eje_metaboxes');

function museo_historia_plugin_eje_metaboxes() {
    global $post;
    if($post->post_type == 'eje'){
        add_meta_box('museo_historia_plugin_eje_alumno',"Actividades Alumno", 'museo_historia_plugin_eje_alumno_meta_box', null, 'normal','core');
        add_meta_box('museo_historia_plugin_eje_docente',"Actividades Docente", 'museo_historia_plugin_eje_docente_meta_box', null, 'normal','core');
    }
}

function museo_historia_plugin_eje_alumno_meta_box(){
    global $post;
    $id = $post->ID;
    $alumno = get_post_meta($id,'museo_historia_plugin_eje_alumno',true);
    print "<div id='museo_historia_plugin_eje_alumno_container'>";
    wp_editor($alumno, "museo_historia_plugin_eje_alumno_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_eje_docente_meta_box(){
    global $post;
    $id = $post->ID;
    $docente = get_post_meta($id,'museo_historia_plugin_eje_docente',true);
    print "<div id='museo_historia_plugin_eje_docente_container'>";
    wp_editor($docente, "museo_historia_plugin_eje_docente_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}


