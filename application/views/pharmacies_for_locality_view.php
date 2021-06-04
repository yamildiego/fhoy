<style>
    .custom-combobox {
        position: relative;
        display: inline-block;
    }
    .custom-combobox-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
        right: 7px;
    }
    .custom-combobox-input {
        margin: 0;
        padding: 0px;
    }
    #combobox {
        width: 100%;
    }
</style>
<script src="<?php echo base_url('/assets/javascript/javascript.js'); ?>"></script>

<div class="contenerdor_box">
    <?php echo validation_errors(); ?>
    <?php echo $form_open; ?> 
    <div class="box" style="height: 120px;">
        <div class="row h75">
            <div class="w20">
                <div class="icon icon-map"></div>
            </div>
            <div class="w80">
                <div class="label">
                    Localidad
                </div>
                <div class="ui-widget">
                    <?php echo $locations; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="w100 h75">
                <?php echo $send; ?> 
            </div>
        </div>
    </div>
    <?php echo $form_close; ?> 
</div>