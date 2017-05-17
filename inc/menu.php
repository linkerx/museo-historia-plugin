<?php

add_action('admin_menu', 'museo_historia_plugin_menu');

function museo_historia_plugin_menu(){
    global $submenu;
    add_menu_page('Museo', 'Museo', 'manage_museo',basename(__FILE__)."_museo", 'museo_historia_plugin_setting_page', null, 20 );
    add_submenu_page(basename(__FILE__)."_museo", 'Procesos', 'Procesos', 'manage_museo', 'edit.php?post_type=proceso', NULL);
    add_submenu_page(basename(__FILE__)."_museo", 'Periodos', 'Periodos', 'manage_museo', 'edit.php?post_type=periodo', NULL);
    add_submenu_page(basename(__FILE__)."_museo", 'Topicos', 'Topicos', 'manage_museo', 'edit.php?post_type=topico', NULL);
    add_submenu_page(basename(__FILE__)."_museo", 'Ejes', 'Ejes', 'manage_museo', 'edit.php?post_type=eje', NULL);
    add_submenu_page(basename(__FILE__)."_museo", 'Objetos', 'Objetos', 'manage_museo', 'edit.php?post_type=objeto', NULL);
    add_submenu_page(basename(__FILE__)."_museo", 'Mapas', 'Mapas', 'manage_museo', 'edit.php?post_type=mapa', NULL);
    $submenu[basename(__FILE__)."_museo"][0][0] = "Opciones";
}

function museo_historia_plugin_setting_page(){
    echo "<h1>Opciones Plugin</h1>";
}
