<h1>
	The incredible MVC system 
</h1>


<p>Welcome to my awesome CMS!!</p>

<?php
	$data = array(array('col1'=>'INFO', 'col2'=>'MORE'), 
		array('col1'=>'2322', 'col2'=>'dfsdfdsefdsa'),
		array('col1'=>'INFO', 'col2'=>'MORE'));
	$grid = new DataGrid($data);
	$grid->display();

?>

<div id='componentspace'>
	<script>
	popUpComponent('datagrid',{data:[{col1:'val', col2:'val', col3:'test'},
		{col1:'woop', col2:'val', col3:'bananas'}]});
	</script>
</div>

