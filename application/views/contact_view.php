<div class="contenerdor_box">
    <?php echo validation_errors(); ?>
    <?php echo $this->session->flashdata('mensaje'); ?>
    <?php echo $form_open; ?> 
    <div class="box" style="height: 525px;">
        <div class="row h75">
            <div class="w100">
                <div class="label">
                    Nombre
                </div>
                <?php echo $name; ?> 
            </div>
        </div>
        <div class="row h75">
            <div class="w100">
                <div class="label">
                    Apellido
                </div>
                <?php echo $last_name; ?> 
            </div>
        </div>
        <div class="row h75">
            <div class="w100">
                <div class="label">
                    Email
                </div>
                <?php echo $email; ?> 
            </div>
        </div>
        <div class="row h75">
            <div class="w100">
                <div class="label">
                    Telefono
                </div>
                <?php echo $phone; ?> 
            </div>
        </div>
        <div class="row h75">
            <div class="w100">
                <div class="label">
                    Mensaje
                </div>
                <?php echo $message; ?> 
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