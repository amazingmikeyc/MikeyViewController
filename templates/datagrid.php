<div class='datagrid ui-corner-all' id='<?php echo $this->vars['id']; ?>'>
<table class='ui-component ui-widget'>
	<tr>
	<?php

		foreach ($this->vars['data'][0] as $col=>$val) {
			?><th><?php echo $col; ?></th><?php 	
		}
		$count = 0;
	?>
	</tr>
	<?php foreach ($this->vars['data'] as $row) {
		$count++;
		?><tr><?php
		foreach ($row as $col=>$val) {
			?><td class='row<?php echo $count % 2?>' ><?php
				echo $val;
			?></td><?php
		}
		?>
		</tr>
		<?php
	}
	
	?>	
</table>
</div>