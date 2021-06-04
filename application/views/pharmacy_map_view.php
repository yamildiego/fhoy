<script>
    var markers =<?php echo $markers; ?>;

    $(document).ready(function () {
        setTimeout("center();", 1000);
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script src="<?php echo base_url('/assets/javascript/map.js'); ?>"></script>

<div id="vasa" style="width: 100%; height: 150px;"><div id="maps"><div id="map-canvas"></div></div></div>
