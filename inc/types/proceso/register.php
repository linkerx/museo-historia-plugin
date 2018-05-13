<?php

add_action('init', 'museo_historia_plugin_register_cpt_proceso');

function museo_historia_plugin_register_cpt_proceso(){

    $labels = array(
        'name' => __('Procesos','proceso_name'),
        'singular_name' => __('Proceso','proceso_singular_name'),
        'menu_name' => __('Procesos','proceso_menu_name'),
        'all_items' => __('Lista de Procesos','proceso_all_items'),
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Tipo de dato proceso',
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
        'supports' => array('title','editor','excerpt','thumbnail','revisions'),
        "capability_type" => 'proceso',
        "map_meta_cap" => true
    );

    register_post_type('proceso',$args);
}
