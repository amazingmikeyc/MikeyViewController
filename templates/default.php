<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="/admin.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/jquery-ui/jquery-ui-1.8.23.custom.css" />
<link rel="stylesheet" type="text/css" title="MikeyNet v3" href="/style.css" media="screen" />
</head>
<body>
	<div id='navbar'>
		<?php
	//	$nav = new Navigation();
	//	 $nav->display();
	?>	
	</div>
	
<div id='mainpane'>
<div id='main'>
<?php echo $values['component']->display(); ?>
</div>
</div>
</body>
</html>
