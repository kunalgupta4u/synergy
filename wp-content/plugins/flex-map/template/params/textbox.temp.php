<?php
    global $param_properties;
    $extra_class = (isset( $param_properties['class']))?$param_properties['class'] : '';
    $attrs = (isset( $param_properties['attrs']))?$param_properties['attrs'] : '';
    $require = ( isset( $param_properties['require'] ) )? '<span class="setting_required">*</span>' : '';
    $des = ( isset( $param_properties['des'] ) )? '<span class="description">' . $param_properties['des'] . '</span>': '';
?>
<div class="mymaps-row"><div class="field_title"><?php echo $param_properties['title']; ?></div>
                    <div class="field_container">
                        <input type="text" class="<?php echo $extra_class; ?>" id="<?php echo $param_properties['id']; ?>" name="<?php echo $param_properties['name']; ?>" value="<?php echo $param_properties['value']; ?>" <?php echo $attrs; ?><?php echo $require; ?> <br> <?php echo $des; ?>
                    </div>
</div>
