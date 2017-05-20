<?php

add_filter ('manage_posts_columns', 'museo_historia_plugin_eje_columns');
add_action ('manage_posts_custom_column', 'museo_historia_plugin_eje_columns_values');
    
function museo_historia_plugin_eje_columns($columns) {
    global $post_type;
    if($post_type == 'eje'){
        unset($columns['date']);
    }
    return $columns;
}

function museo_historia_plugin_eje_columns_values($column_name) {
    global $wpdb, $post;
    $id = $post->ID;

    if($post->post_type == 'eje'){
        $id = $post->ID;
       
    }
}
