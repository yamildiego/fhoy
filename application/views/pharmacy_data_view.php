<?php if (isset($mostrar_volver)&& $mostrar_volver) { ?>
<a class="btn btn_back" href="<?php echo $url_back; ?>">
    <span class="icon-small icon-back"></span>
    Volver
</a><?php } ?>
<div class="box_see_pharmacy">
    <?php if (isset($pharmacy->date)) { ?>
        <div class="row h40 border_line">
            <div class="w10">
                <div class="icon-small icon-calendar"></div>
            </div>
            <div class="w25">
                <div class="label marginl8">
                    D&iacute;a
                </div>
            </div>
            <div class="w65">
                <div class="text_see_pharmacy bold"><?php echo $today; ?></div>
            </div>
        </div>
    <?php } ?>
    <div class="row h40">
        <div class="w10">
            <div class="icon-small icon-marker"></div>
        </div>
        <div class="w25">
            <div class="label marginl8">
                Localidad
            </div>
        </div>
        <div class="w65">
            <div class="text_see_pharmacy"><?php echo $pharmacy->name_locality; ?></div>
        </div>
    </div>
</div>