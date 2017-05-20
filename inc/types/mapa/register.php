<?php

add_action('init', 'museo_historia_plugin_register_cpt_mapa');

function museo_historia_plugin_register_cpt_mapa(){
    
    $labels = array(
        'name' => __('Mapas','mapa_name'),
        'singular_name' => __('Mapa','mapa_singular_name'),
        'menu_name' => __('Mapas','mapa_menu_name'),
        'all_items' => __('Lista de Mapas','mapa_all_items'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato mapa',
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
        "capability_type" => 'mapa',
        "map_meta_cap" => true        
    );
    
    register_post_type('mapa',$args);
    add_post_type_support('mapa', array('thumbnail','excerpt'));
}
