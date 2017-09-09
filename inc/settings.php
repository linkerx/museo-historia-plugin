<?php

add_action('admin_menu', 'horizonte_theme_create_menu');

function horizonte_theme_create_menu() {
    add_menu_page('Horizonte Theme', 'Conf. de Tema', 'manage_options','horizonte_theme_settings_page' , 'horizonte_theme_settings_page' , null, 99);
    add_submenu_page('horizonte_theme_settings_page', "Configuración de Galerías", "Configuración de Galerías", 'manage_options', 'horizonte_theme_galleries_settings_page','horizonte_theme_galleries_settings_page');
    add_action( 'admin_init', 'register_horizonte_theme_settings' );
}


function register_horizonte_theme_settings() {
    register_setting( 'horizonte-theme-galeria-settings-group', 'galeria_inicio' );
    register_setting( 'horizonte-theme-galeria-settings-group', 'galeria_institucional' );
    register_setting( 'horizonte-theme-galeria-settings-group', 'galeria_personas' );
    register_setting( 'horizonte-theme-galeria-settings-group', 'galeria_empresas' );
}

function horizonte_theme_settings_page() {
?>    
    <h1>Horizonte Theme</h1>
    <div class="wrap"></div>
<?php
}    

function horizonte_theme_galleries_settings_page() {
    global $wpdb;
    
    $galeria_inicio = get_option('galeria_inicio');
    $galeria_institucional = get_option('galeria_institucional');
    $galeria_personas = get_option('galeria_personas');
    $galeria_empresas = get_option('galeria_empresas');
    
    $galleries = $wpdb->get_results("SELECT gid, title FROM ".$wpdb->prefix."ngg_gallery ORDER BY title ASC", ARRAY_A);

?>
    
<div class="wrap">
<h1>Tema Horizonte - Conf. de Galerias</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'horizonte-theme-galeria-settings-group' ); ?>
    <?php do_settings_sections( 'horizonte-theme-galeria-settings-group' ); ?>
    <table class="form-table">
        <tr>
        <th>Galería Inicio</th>
        <td>
            <select name="galeria_inicio">
                <option value="0">Sin galería</option>
                <?php
                    if(is_array($galleries) && count($galleries) > 0) {
                        foreach($galleries as $gal){
                            print "<option value='".$gal["gid"]."' ";
                            if($galeria_inicio == $gal["gid"]){
                                print "selected";
                            }    
                            print " >".$gal["title"]."</option>";
                        }    
                    }
                ?>
            </select> (actualmente sustituida por video)
        </tr>
        <tr>
        <th>Galería Institucional</th>
        <td>
            <select name="galeria_institucional">
                <option value="0">Sin galería</option>
                <?php
                    if(is_array($galleries) && count($galleries) > 0) {
                        foreach($galleries as $gal){
                            print "<option value='".$gal["gid"]."' ";
                            if($galeria_institucional == $gal["gid"]){
                                print "selected";
                            }    
                            print " >".$gal["title"]."</option>";
                        }    
                    }
                ?>
            </select>
        </tr>
        <tr>
        <th>Galería Home</th>
        <td>
            <select name="galeria_personas">
                <option value="0">Sin galería</option>
                <?php
                    if(is_array($galleries) && count($galleries) > 0) {
                        foreach($galleries as $gal){
                            print "<option value='".$gal["gid"]."' ";
                            if($galeria_personas == $gal["gid"]){
                                print "selected";
                            }    
                            print " >".$gal["title"]."</option>";
                        }    
                    }
                ?>
            </select>
        </tr>
        <tr>
        <th>Galería Home</th>
        <td>
            <select name="galeria_empresas">
                <option value="0">Sin galería</option>
                <?php
                    if(is_array($galleries) && count($galleries) > 0) {
                        foreach($galleries as $gal){
                            print "<option value='".$gal["gid"]."' ";
                            if($galeria_empresas == $gal["gid"]){
                                print "selected";
                            }    
                            print " >".$gal["title"]."</option>";
                        }    
                    }
                ?>
            </select>
        </tr>
    </table>
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>