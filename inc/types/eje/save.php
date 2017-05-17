<?php

add_action('save_post','museo_historia_plugin_eje_save');

function museo_historia_plugin_eje_save($id) {
    global $wpdb,$post_type;
    if($post_type == 'eje'){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $id;
        if (defined('DOING_AJAX') && DOING_AJAX)
                return $id;

        update_post_meta($id,'museo_historia_plugin_eje_perfil',$_POST['museo_historia_plugin_eje_perfil_editor']);
    }
}
