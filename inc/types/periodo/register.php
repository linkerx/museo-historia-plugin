<?php

add_action('init', 'museo_historia_plugin_register_cpt_periodo');

function museo_historia_plugin_register_cpt_periodo(){
    
    $labels = array(
        'name' => __('Periodos','periodo_name'),
        'singular_name' => __('Periodo','periodo_singular_name'),
        'menu_name' => __('Periodos','periodo_menu_name'),
        'all_items' => __('Lista de Periodos','periodo_all_items'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato periodo',
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
        "capability_type" => 'periodo',
        "map_meta_cap" => true        
    );
    
    register_post_type('periodo',$args);
    add_post_type_support('periodo', array('thumbnail','excerpt'));
}
