<?php
$GLOBALS['rootdir'] = str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);

foreach ($_SERVER as $key=>$value) {
//	echo '<p>'.$key.' => '.$value;

}

//echo $GLOBALS['rootdir'];

	function __autoload($classname){

		$paths = array('', '/forms', 'pages');

		foreach ($paths as $path) {
			if (file_exists($GLOBALS['rootdir'].'/components/'.$path.'/'.strtolower($classname) . '.class.php')) {
			
				include $GLOBALS['rootdir'].'/components/'.$path.'/'.strtolower($classname) . '.class.php';		
			}
		}
            
        }

$relativeURL = str_replace(str_replace('/index.php','',$_SERVER['SCRIPT_NAME']),'',$_SERVER['REQUEST_URI']);

$url = explode('?',$relativeURL);
$url = explode('/',$url[0]);

if ($url[1]) {
	$objectName = $url[1];
	$objectValue = $url[2]; 
}
else {
	$objectName = 'indexpage';
	$objectValue = '';
}

$object = new Object($objectValue);
$form = new $objectName($object);

$page = new Controller($form, isset($_GET['save'])?$_GET['save']:null);


$page->display();

?>
