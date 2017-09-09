<?php

add_filter ('manage_posts_columns', 'museo_historia_plugin_mapa_columns');
add_action ('manage_posts_custom_column', 'museo_historia_plugin_mapa_columns_values');
    
function museo_historia_plugin_mapa_columns($columns) {
    global $post_type;
    if($post_type == 'mapa'){
        // $columns['nombre'] = "Nombre";
    }
    return $columns;
}

function museo_historia_plugin_mapa_columns_values($column_name) {
    global $wpdb, $post;
    $id = $post->ID;

    if($post->post_type == 'mapa'){
        $id = $post->ID;
        if($column_name === 'nombre'){
            //print get_post_meta($id,'sarasa',true);
        }
        
    }
}
