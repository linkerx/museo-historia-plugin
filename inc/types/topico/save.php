<?php

add_action('save_post','museo_historia_plugin_topico_save');

function museo_historia_plugin_topico_save($id) {
    global $wpdb,$post_type;
    if($post_type == 'topico'){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $id;
        if (defined('DOING_AJAX') && DOING_AJAX)
                return $id;

        update_post_meta($id,'museo_historia_plugin_topico_perfil',$_POST['museo_historia_plugin_topico_perfil_editor']);
    }
}