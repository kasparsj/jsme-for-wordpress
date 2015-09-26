<?php $export_arr = explode(",", $export); ?>
<div id="<?php echo $id ?>"></div>
<?php if (in_array("molfile", $export_arr)) { ?>
<input type="hidden" name="<?php echo $id ?>_molfile" id="<?php echo $id ?>_molfile" />
<?php } ?>
<?php if (in_array("molfile_v3000", $export_arr)) { ?>
<input type="hidden" name="<?php echo $id ?>_molfile_v3000" id="<?php echo $id ?>_molfile_v3000" />
<?php } ?>
<?php if (in_array("smiles", $export_arr)) { ?>
<input type="hidden" name="<?php echo $id ?>_smiles" id="<?php echo $id ?>_smiles" />
<?php } ?>