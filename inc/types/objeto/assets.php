<?php

add_action("admin_enqueue_scripts",'museo_historia_plugin_objeto_admin_head' );
add_action("wp_enqueue_scripts",'museo_historia_plugin_objeto_front_head' );

function museo_historia_plugin_objeto_admin_head($hook) {
    global $post_type;
    $plugindir = get_option('siteurl').'/wp-content/plugins/'.plugin_basename(dirname(__FILE__));
    if($hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit.php')
    {
        if($post_type == 'objeto')
        {
            wp_enqueue_script('museo_historia_plugin_objeto_admin_js',$plugindir.'/inc/types/objeto/assets/admin.js');
            wp_enqueue_style('museo_historia_plugin_objeto_admin_css',$plugindir.'/inc/types/objeto/assets/admin.css');
        }
    }
}

function museo_historia_plugin_objeto_front_head($hook) {
    global $post_type;
    if($post_type == 'objeto') {
        $plugindir = get_option('siteurl').'/wp-content/plugins/'.plugin_basename(dirname(__FILE__));
	wp_enqueue_style('museo_historia_plugin_objeto_css',$plugindir.'/inc/types/objeto/assets/front.css');
        wp_enqueue_script('museo_historia_plugin_objeto_js',$plugindir.'/inc/types/objeto/assets/front.js');
    }
}



