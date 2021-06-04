<div style="background: #EEE; padding: 5px 20px 20px 20px; font-family: sans-serif; margin: 0px;">
    <p style="color:#444; font-weight: bold;">Consulta WEB de <?php echo $obj->last_name . ',' . $obj->name . ' :'; ?></p>
    <p style="color: #444; font-size: 12px;"><?php echo $obj->message; ?></p>
    <p style="color: #444; font-size: 12px;">Email: <?php echo $obj->email; ?></p>
    <p style="color: #444; font-size: 12px;">Telefono: <?php echo ($obj->phone == null) ? '-' : $obj->phone; ?></p>
</div>