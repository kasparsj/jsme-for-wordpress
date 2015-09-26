<script>
    //this function will be called after the JavaScriptApplet code has been loaded.
    function jsmeOnLoad() {
        <?php $i=0; foreach ($instances as $instance) { ?>
        var applet<?php echo $i ?> = new JSApplet.JSME("<?php echo $instance['id'] ?>", "<?php echo $instance['width'] ?>px", "<?php echo $instance['height'] ?>px");
        <?php if (isset($molfile)) { ?>
        applet<?php echo $i ?>.readMolFile("<?php echo $molfile ?>");
        <?php } ?>
        jQuery("#<?php echo $instance['id'] ?>").closest("form").find(":submit").click(function() {
            <?php $export_arr = explode(",", $instance['export']); ?>
            <?php if (in_array("molfile", $export_arr)) { ?>
            jQuery("#<?php echo $instance['id'] ?>_molfile").val(applet<?php echo $i ?>.molFile());
            <?php } ?>
            <?php if (in_array("molfile_v3000", $export_arr)) { ?>
            jQuery("#<?php echo $instance['id'] ?>_molfile_v3000").val(applet<?php echo $i ?>.molFile(true));
            <?php } ?>
            <?php if (in_array("smiles", $export_arr)) { ?>
            jQuery("#<?php echo $instance['id'] ?>_smiles").val(applet<?php echo $i ?>.smiles());
            <?php } ?>
        });
        <?php $i++; } ?>
    }
</script>
