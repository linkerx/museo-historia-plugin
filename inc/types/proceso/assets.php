<?php

add_action("admin_enqueue_scripts",'museo_historia_plugin_proceso_admin_head' );
add_action("wp_enqueue_scripts",'museo_historia_plugin_proceso_front_head' );

function museo_historia_plugin_proceso_admin_head($hook) {
    global $post_type;
    $plugindir = get_option('siteurl').'/wp-content/plugins/'.plugin_basename(dirname(__FILE__));
    if($hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit.php')
    {
        if($post_type == 'proceso')
        {
            wp_enqueue_script('jquery-ui-datepicker');
            wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
            wp_enqueue_style('jquery-ui');
            wp_enqueue_script('museo_historia_plugin_proceso_admin_js',$plugindir.'/assets/admin.js');
            wp_enqueue_style('museo_historia_plugin_proceso_admin_css',$plugindir.'/assets/admin.css');
        }
    }
}

function museo_historia_plugin_proceso_front_head($hook) {
    global $post_type;
    if($post_type == 'proceso') {
        $plugindir = get_option('siteurl').'/wp-content/plugins/'.plugin_basename(dirname(__FILE__));
	wp_enqueue_style('museo_historia_plugin_proceso_css',$plugindir.'/assets/front.css');
        wp_enqueue_script('museo_historia_plugin_proceso_js',$plugindir.'/assets/front.js');
    }
}
