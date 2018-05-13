<?php

add_action ('add_meta_boxes','museo_historia_plugin_proceso_metaboxes');

function museo_historia_plugin_proceso_metaboxes() {
    global $post;
    if($post->post_type == 'proceso'){
      add_meta_box('museo_historia_plugin_proceso_fecha',"Fecha", 'museo_historia_plugin_proceso_fecha_meta_box', null, 'normal','core');
      add_meta_box('museo_historia_plugin_proceso_alcance',"Alcance", 'museo_historia_plugin_proceso_alcance_meta_box', null, 'side','core');
    }
}

/**
 * Meta box sitio vista
 */
function museo_historia_plugin_proceso_alcance_meta_box(){
	global $post;
	$id = $post->ID;
  $alcance = get_post_meta($id,'museo_historia_plugin_proceso_alcance',true);

  if(!$alcance){
    $alcance = 'local';
  }

	print "<div id='museo_historia_plugin_proceso_alcance_container'>";

  print "<input type='radio' name='museo_historia_plugin_proceso_alcance_check' value='local' ";
  if($alcance == 'local'){
    print "checked";
  }
  print " /> Local";
  print "<br />";
  print "<input type='radio' name='museo_historia_plugin_proceso_alcance_check' value='nacional' ";
  if($alcance == 'nacional'){
    print "checked";
  }
  print " /> Nacional";
  print "<br />";
  print "<input type='radio' name='museo_historia_plugin_proceso_alcance_check' value='internacional' ";
  if($alcance == 'internacional'){
    print "checked";
  }
  print " /> Internacional";
  print "<br />";

	print "</div>";
	print "<div style='clear:both;'></div>";
}

function museo_historia_plugin_proceso_fecha_meta_box(){
    global $post;
    $id = $post->ID;

    $unica = get_post_meta($id,'museo_historia_plugin_proceso_fecha_unica',true);
    if(!$unica)
      $unica = "si";

    print "<div id='museo_historia_plugin_proceso_alcance_container'>";
    print "<input type='radio' name='museo_historia_plugin_proceso_fecha_unica_check' value='si' ";
    if($unica == 'si'){
      print "checked";
    }
    print " /> Fecha Unica";
    print "<br />";
    print "<input type='radio' name='museo_historia_plugin_proceso_fecha_unica_check' value='no' ";
    if($unica == 'no'){
      print "checked";
    }
    print " /> Periodo";
    print "<br />";
    print "</div>";

    $inicio = get_post_meta($id,'museo_historia_plugin_proceso_inicio',true);

    $inicio_anio = get_post_meta($id,'museo_historia_plugin_proceso_inicio_anio',true);
    $inicio_mes = get_post_meta($id,'museo_historia_plugin_proceso_inicio_mes',true);
    $inicio_dia = get_post_meta($id,'museo_historia_plugin_proceso_inicio_dia',true);

    ?>

    <div id='museo_historia_plugin_proceso_inicio_container'>
        <table>
            <tr>
                <td colspan="4"><strong>Inicio:</strong></td>
            </tr>
            <tr>
                <td style='padding-left:10px;'>Año:

                  <select name='museo_historia_plugin_proceso_inicio_anio_input'>
                    <?php
                      for($x = 1800; $x <= 1900; $x++){

                        print "<option value='".$x."' ";
                        if($x == $inicio_anio){
                          print "selected";
                        }
                        print ">".$x."</option>";
                      }
                    ?>

                <td style='padding-left:10px;'>Mes: <input id='museo_historia_plugin_proceso_inicio_mes_input' name='museo_historia_plugin_proceso_inicio_mes_input' value='<?php echo $inicio_mes ?>' size="5"/></td>
                <td style='padding-left:10px;'>Día: <input id='museo_historia_plugin_proceso_inicio_dia_input' name='museo_historia_plugin_proceso_inicio_dia_input' value='<?php echo $inicio_dia ?>' size="5"/></td>
                <td style='padding-left:10px;'>
                    <?php
                        if($inicio) echo "OK. Orden: ".$inicio;
                        else echo "ERR";
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <?php

    if($unica == 'no'){
      $fin = get_post_meta($id,'museo_historia_plugin_proceso_fin',true);

      $fin_anio = get_post_meta($id,'museo_historia_plugin_proceso_fin_anio',true);
      $fin_mes = get_post_meta($id,'museo_historia_plugin_proceso_fin_mes',true);
      $fin_dia = get_post_meta($id,'museo_historia_plugin_proceso_fin_dia',true);

      ?>

      <div id='museo_historia_plugin_proceso_fin_container'>
          <table>
            <tr>
                <td colspan="4"><strong>Fin:</strong> </td>
            </tr>
            <tr>
                <td style='padding-left:10px;'>Año: <input name='museo_historia_plugin_proceso_fin_anio_input' value='<?php echo $fin_anio ?>' size="5"/></td>
                <td style='padding-left:10px;'>Mes: <input name='museo_historia_plugin_proceso_fin_mes_input' value='<?php echo $fin_mes ?>' size="5"/></td>
                <td style='padding-left:10px;'>Día: <input name='museo_historia_plugin_proceso_fin_dia_input' value='<?php echo $fin_dia ?>' size="5"/></td>
                <td style='padding-left:10px;'>
                    <?php
                        if($resp == "OK") echo "OK. Orden: ".$fin;
                        else echo "ERR";
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div style='clear:both;'></div>
    <?php
    }
}
