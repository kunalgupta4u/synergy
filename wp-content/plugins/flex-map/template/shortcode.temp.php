<?php

$general = json_decode($form_data['map_id']);
?>
<div class="mymaps-area-<?php echo $general ?>" style="">
  <div class="map-wrapper-<?php echo $general ?>" style="width=100%;height:500px;">

  <div id="map-canvas-<?php echo $general ?>" style="width:100%;height:100%;top:0;left:0;"></div>
    </div>
    <div class="legend-carousel-<?php echo $general ?>" style="width:100%;">
    </div>
</div>
