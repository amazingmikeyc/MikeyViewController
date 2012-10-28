<?php
$GLOBALS['rootdir'] = str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);

foreach ($_SERVER as $key=>$value) {
//	echo '<p>'.$key.' => '.$value;

}

//echo $GLOBALS['rootdir'];

	function __autoload($classname){

		$GLOBALS['paths'] = array('', '/forms', 'pages','components');

		foreach ($GLOBALS['paths'] as $path) {
			if (file_exists($GLOBALS['rootdir'].'/components/'.$path.'/'.strtolower($classname) . '.class.php')) {
			
				include $GLOBALS['rootdir'].'/components/'.$path.'/'.strtolower($classname) . '.class.php';		
			}
		}
            
       }

$relativeURL = str_replace(str_replace('/index.php','',$_SERVER['SCRIPT_NAME']),'',$_SERVER['REQUEST_URI']);

$url = explode('?',$relativeURL);
$url = explode('/',$url[0]);

$objectValue = '';

//Check URL contents
if (isset($url[1])&&$url[1]) {
	$objectName = $url[1];
	if (isset($url[2])) {
		$objectValue = $url[2];
	}
}
else {
	$objectName = 'indexpage';
	$objectValue = '';
}

$object = new $objectName($objectValue);


$page = new Controller($object, isset($_GET['function'])?$_GET['function']:null);

$page->display();