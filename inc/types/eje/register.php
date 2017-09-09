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
        'show_in_rest' => true,
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

function museo_historia_plugin_register_eje_taxonomies(){

    /**
     * Nivel
     */
    $labels_nivel = array(
        'name' => "Niveles",
        'singular_name' => "Nivel",
    );
    $args_nivel = array(
        'hierarchical' => true,
        'labels' => $labels_nivel,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug'=>'nivel'),
    );
    register_taxonomy('nivel','eje',$args_nivel);
    
     /**
     * Grado
     */
    $labels_grado = array(
        'name' => "Grados",
        'singular_name' => "Grado",
    );
    $args_grado = array(
        'hierarchical' => true,
        'labels' => $labels_grado,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug'=>'grado'),
    );
    register_taxonomy('grado','eje',$args_grado);
}
add_action( 'init', 'museo_historia_plugin_register_eje_taxonomies');
