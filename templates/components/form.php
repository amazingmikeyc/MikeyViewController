<form id="<?php echo $values['formID'];?>" method='post' action='/dbtest/form/<?php echo $values['table']->getTableName(); ?>?save=1' onsubmit='ajaxSave("#<?php echo $values['formID'];?>"); return false;' >

	<?php 
		if ($values['formitem']) {
			foreach ($values['formitem'] as $item) {

				$item->display();

			}
		}
	?>

	<p><span class='label'>&nbsp;</span><input type='submit' value='Save' /></p>

</form>
