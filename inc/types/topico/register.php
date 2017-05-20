<?php

add_action('init', 'museo_historia_plugin_register_cpt_topico');

function museo_historia_plugin_register_cpt_topico(){
    
    $labels = array(
        'name' => __('Topicos','topico_name'),
        'singular_name' => __('Topico','topico_singular_name'),
        'menu_name' => __('Topicos','topico_menu_name'),
        'all_items' => __('Lista de Topicos','topico_all_items'),
    );
    
    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato topico',
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
        "capability_type" => 'topico',
        "map_meta_cap" => true        
    );
    
    register_post_type('topico',$args);
    add_post_type_support('topico', array('thumbnail','excerpt'));
}
