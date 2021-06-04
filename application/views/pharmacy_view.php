<div class="box_see_pharmacy">
    <div class="row h40 border_line">
        <div class="w10">
            <div class="icon-small icon-pharmacy"></div>
        </div>
        <div class="w25">
            <div class="label marginl8">
                Nombre
            </div>
        </div>
        <div class="w65">
            <div class="text_see_pharmacy"><?php echo $pharmacy->name_pharmacy; ?></div>
        </div>
    </div>
    <div class="row h40 border_line">
        <div class="w10">
            <div class="icon-small icon-telephone"></div>
        </div>
        <div class="w25">
            <div class="label marginl8">
                Tel&eacute;fono
            </div>
        </div>
        <div class="w65">
            <div class="text_see_pharmacy"><?php echo $pharmacy->telephone; ?></div>
        </div>
    </div>
    <div class="row h40">
        <div class="w10">
            <div class="icon-small icon-route"></div>
        </div>
        <div class="w25">
            <div class="label marginl8">
                Direcci&oacute;n
            </div>
        </div>
        <div class="w65">
            <div class="text_see_pharmacy"><?php echo $pharmacy->address; ?></div>
        </div>
    </div>
</div>
<?php if ($pharmacy->foto != '') { ?>
    <div style="text-align: center">
        <a class="link_imagen" href="<?php echo base_url($pharmacy->foto); ?>"><img style="height: 150px" src="<?php echo base_url($pharmacy->foto); ?>"></a>
    </div>
    <?php } ?>