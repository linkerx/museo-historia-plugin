<?php

add_filter ('manage_posts_columns', 'museo_historia_plugin_periodo_columns');
add_action ('manage_posts_custom_column', 'museo_historia_plugin_periodo_columns_values');
    
function museo_historia_plugin_periodo_columns($columns) {
    global $post_type;
    if($post_type == 'periodo'){
        $columns['inicio'] = "Inicio";
        $columns['fin'] = "Fin";
        unset($columns['date']);
    }
    return $columns;
}

function museo_historia_plugin_periodo_columns_values($column_name) {
    global $wpdb, $post;
    $id = $post->ID;

    if($post->post_type == 'periodo'){
        $id = $post->ID;
        if($column_name === 'inicio'){
            print get_post_meta($id,'museo_historia_plugin_periodo_inicio',true);
        }
        if($column_name === 'fin'){
            print get_post_meta($id,'museo_historia_plugin_periodo_fin',true);
        }
    }
}
