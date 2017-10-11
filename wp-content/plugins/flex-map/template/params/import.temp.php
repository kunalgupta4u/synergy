<div class="field-rows">
        <?php _e('Choose a option', 'flex-map'); ?>:
</div>
<div class="field-rows">
    <input type="radio" id="append" name="over-append" checked> <label for="append"> <?php _e('Append To Old Data', 'flex-map'); ?> </label><br clear="all">
</div>
<div class="field-rows">
    <input type="radio" id="override" name="over-append"> <label for="override"> <?php _e('Override To All Old Data ( This options may lost all current map post data )', 'flex-map'); ?></label>
</div>
<span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-plus"></i>
    <span><?php _e('Select files...', 'flex-map'); ?></span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files"  accept=".json">
</span>
<br>
<br>
<!-- The global progress bar -->
<div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>
<!-- The container for the uploaded files -->
<div id="files" class="files"></div>
<br>
