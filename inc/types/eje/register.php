<?php

add_action('init', 'museo_historia_plugin_register_cpt_eje');

function museo_historia_plugin_register_cpt_eje(){
    
    $labels = array(
        'name' => __('Ejes','eje_name'),
        'singular_name' => __('Eje','eje_singular_name'),
        'menu_name' => __('Ejes','eje_menu_name'),
        'all_items' => __('Lista de Ejes','eje_all_items'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato eje',
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_nav_menus' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'support' => array('title','excerpt','thumbnail','revisions'),
        "capability_type" => 'eje',
        "map_meta_cap" => true        
    );
    
    register_post_type('eje',$args);
    add_post_type_support('eje', array('thumbnail','excerpt'));
}
