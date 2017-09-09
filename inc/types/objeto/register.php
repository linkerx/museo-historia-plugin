<?php

add_action('init', 'museo_historia_plugin_register_cpt_objeto');

function museo_historia_plugin_register_cpt_objeto(){
    
    $labels = array(
        'name' => __('Objetos','objeto_name'),
        'singular_name' => __('Objeto','objeto_singular_name'),
        'menu_name' => __('Objetos','objeto_menu_name'),
        'all_items' => __('Lista de Objetos','objeto_all_items'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato objeto',
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_nav_menus' => true,
        'show_in_rest' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'support' => array('title','excerpt','thumbnail','revisions'),
        "capability_type" => 'objeto',
        "map_meta_cap" => true        
    );
    
    register_post_type('objeto',$args);
    add_post_type_support('objeto', array('thumbnail','excerpt'));
}
