<?php
$param_properties = $data_form['param_properties'];

 if( isset($param_properties['htype']) && $param_properties['htype'] == 'h3' )
 {
     echo '<h3>' . $param_properties['value'] . '</h3>';
 }
