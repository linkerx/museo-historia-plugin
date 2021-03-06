<?php

add_action ('add_meta_boxes','museo_historia_plugin_topico_metaboxes');

function museo_historia_plugin_topico_metaboxes() {
    global $post;
    if($post->post_type == 'topico'){
      add_meta_box('museo_historia_plugin_topico_fecha',"Fecha", 'museo_historia_plugin_topico_fecha_meta_box', null, 'normal','core');
      add_meta_box('museo_historia_plugin_topico_bibliografia',"Bibliografía", 'museo_historia_plugin_topico_bibliografia_meta_box', null, 'normal','core');
    }
}

function museo_historia_plugin_topico_bibliografia_meta_box(){
    global $post;
    $id = $post->ID;
    $alumno = get_post_meta($id,'museo_historia_plugin_topico_bibliografia',true);
    print "<div id='museo_historia_plugin_topico_bibliografia_container'>";
    wp_editor($alumno, "museo_historia_plugin_topico_bibliografia_editor");
    print "</div>";
    print "<div style='clear:both;'></div>";
}


function museo_historia_plugin_topico_fecha_meta_box(){
    global $post;
    $id = $post->ID;

    $inicio = get_post_meta($id,'museo_historia_plugin_topico_inicio',true);
    $fin = get_post_meta($id,'museo_historia_plugin_topico_fin',true);

    if($inicio && $fin && $inicio <= $fin){
        $resp = "OK";
    } else {
        $resp = "ERR";
    }

    $inicio_anio = get_post_meta($id,'museo_historia_plugin_topico_inicio_anio',true);
    $inicio_mes = get_post_meta($id,'museo_historia_plugin_topico_inicio_mes',true);
    $inicio_dia = get_post_meta($id,'museo_historia_plugin_topico_inicio_dia',true);

    $fin_anio = get_post_meta($id,'museo_historia_plugin_topico_fin_anio',true);
    $fin_mes = get_post_meta($id,'museo_historia_plugin_topico_fin_mes',true);
    $fin_dia = get_post_meta($id,'museo_historia_plugin_topico_fin_dia',true);
    ?>

    <div id='museo_historia_plugin_topico_fecha_container'>
        <table>
            <tr>
                <td colspan="4"><strong>Inicio:</strong></td>
            </tr>
            <tr>
                <td style='padding-left:10px;'>Año: <input name='museo_historia_plugin_topico_inicio_anio_input' value='<?php echo $inicio_anio ?>' size="5"/></td>
                <td style='padding-left:10px;'>Mes: <input name='museo_historia_plugin_topico_inicio_mes_input' value='<?php echo $inicio_mes ?>' size="5"/></td>
                <td style='padding-left:10px;'>Día: <input name='museo_historia_plugin_topico_inicio_dia_input' value='<?php echo $inicio_dia ?>' size="5"/></td>
                <td style='padding-left:10px;'>
                    <?php
                        if($resp == "OK") echo $inicio;
                        else echo "ERR";
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Fin:</strong> </td>
            </tr>
            <tr>
                <td style='padding-left:10px;'>Año: <input name='museo_historia_plugin_topico_fin_anio_input' value='<?php echo $fin_anio ?>' size="5"/></td>
                <td style='padding-left:10px;'>Mes: <input name='museo_historia_plugin_topico_fin_mes_input' value='<?php echo $fin_mes ?>' size="5"/></td>
                <td style='padding-left:10px;'>Día: <input name='museo_historia_plugin_topico_fin_dia_input' value='<?php echo $fin_dia ?>' size="5"/></td>
                <td style='padding-left:10px;'>
                    <?php
                        if($resp == "OK") echo "OK: ".$fin;
                        else echo "ERR";
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div style='clear:both;'></div>
<?php
}
