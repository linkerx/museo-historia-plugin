<?php

add_action('save_post','museo_historia_plugin_topico_save');

function museo_historia_plugin_topico_gen_fecha($anio,$mes,$dia){
    print $anio.$mes.$dia."<br>";

    if(!empty($anio)) {
        $fecha .= $anio."-";
        if(!empty($mes)) {
            $fecha .= sprintf("%02d", $mes)."-";
            if(!empty($dia)) {
                $fecha .= sprintf("%02d", $dia);
            } else {
                $fecha .= "01";
            }
        } else {
            $fecha .= "01-01";
        }
        return $fecha;
    }
    return false;
}


function museo_historia_plugin_topico_save($id) {
    global $wpdb,$post_type;
    if($post_type == 'topico'){
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $id;
        if (defined('DOING_AJAX') && DOING_AJAX)
                return $id;

        /**
         * valido fechas
         */

        $inicio_anio = $_POST['museo_historia_plugin_topico_inicio_anio_input'];
        $inicio_mes = $_POST['museo_historia_plugin_topico_inicio_mes_input'];
        $inicio_dia = $_POST['museo_historia_plugin_topico_inicio_dia_input'];
        $fin_anio = $_POST['museo_historia_plugin_topico_fin_anio_input'];
        $fin_mes = $_POST['museo_historia_plugin_topico_fin_mes_input'];
        $fin_dia = $_POST['museo_historia_plugin_topico_fin_dia_input'];

        $inicio = museo_historia_plugin_topico_gen_fecha($inicio_anio,$inicio_mes,$inicio_dia);
        $fin = museo_historia_plugin_topico_gen_fecha($fin_anio,$fin_mes,$fin_dia);

        if($inicio && $fin && $inicio <= $fin){

            /*
            $inicio_anio = date("Y",strtotime($inicio));
            $inicio_mes = date("m",strtotime($inicio));
            $inicio_dia = date("d",strtotime($inicio));
            $fin_anio = date("Y",strtotime($fin));
            $fin_mes = date("m",strtotime($fin));
            $fin_dia = date("d",strtotime($fin));
            */

            update_post_meta($id,'museo_historia_plugin_topico_inicio',$inicio);
            update_post_meta($id,'museo_historia_plugin_topico_fin',$fin);

            if(!empty($inicio_anio))
                update_post_meta($id,'museo_historia_plugin_topico_inicio_anio',sprintf("%02d", $inicio_anio));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_inicio_anio');

            if(!empty($inicio_mes))
                update_post_meta($id,'museo_historia_plugin_topico_inicio_mes',sprintf("%02d", $inicio_mes));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_inicio_mes');

            if(!empty($inicio_dia))
                update_post_meta($id,'museo_historia_plugin_topico_inicio_dia',sprintf("%02d", $inicio_dia));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_inicio_dia');

            if(!empty($fin_anio))
                update_post_meta($id,'museo_historia_plugin_topico_fin_anio',sprintf("%02d", $fin_anio));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_fin_anio');

            if(!empty($fin_mes))
                update_post_meta($id,'museo_historia_plugin_topico_fin_mes',sprintf("%02d", $fin_mes));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_fin_mes');

            if(!empty($fin_dia))
                update_post_meta($id,'museo_historia_plugin_topico_fin_dia',sprintf("%02d", $fin_dia));
            else
                delete_post_meta($id,'museo_historia_plugin_topico_fin_dia');
        }

        update_post_meta($id,'museo_historia_plugin_topico_bibliografia',$_POST['museo_historia_plugin_topico_bibliografia_editor']);


    }
}
