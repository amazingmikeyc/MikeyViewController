<?php 
if ($values['state']!='saved') { ?>
<form id="<?php echo $values['formID'];?>" method='post' action='/form/<?php echo $values['table']->getTableName(); ?>?function=save' onsubmit='ajaxSave("#<?php echo $values['formID'];?>"); return false;' >

	<?php 
		if ($values['formitem']) {
			foreach ($values['formitem'] as $item) {

				$item->display();

			}
		}
	?>

	<p><span class='label'>&nbsp;</span><input type='submit' value='Save' /></p>

</form>
<?php } else { ?>	
data = {'message':'Saved successfully.','success':1,'id':<?php echo $values['insertId']; ?>}
<?php } ?>