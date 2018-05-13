<?php

add_action('save_post','museo_historia_plugin_mapa_save');

function museo_historia_plugin_mapa_save($id) {
    global $wpdb,$post_type;
    if($post_type == 'mapa'){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $id;
        if (defined('DOING_AJAX') && DOING_AJAX)
                return $id;

            update_post_meta($id,'museo_historia_plugin_mapa_datos1',$_POST['museo_historia_plugin_mapa_datos1']);
            update_post_meta($id,'museo_historia_plugin_mapa_datos2',$_POST['museo_historia_plugin_mapa_datos2']);
            update_post_meta($id,'museo_historia_plugin_mapa_datos3',$_POST['museo_historia_plugin_mapa_datos3']);
    }
}
