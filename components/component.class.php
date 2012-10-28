<?php

class Component {

	//Each component has a template which can be used
	//to draw it
	private $_template;

	protected $vars;

	function __construct($templateName = '') {

		if (!$templateName) {
			$this->_template = strtolower(get_class($this));
		}
		else {
			$this->_template = $templateName;
		}
		
		$id = md5(time());
		$this->assign('id', $id);		
		$vars = array();
	}

	function assign($name, $value) {
		$this->vars[$name] = $value;
	}

	function display() {
		$values = $this->vars;		
		foreach ($GLOBALS['paths'] as $path) {
			if (file_exists($GLOBALS['rootdir'].'/templates/'.$path.'/'.strtolower($this->_template) . '.php')) {
			
				include $GLOBALS['rootdir'].'/templates/'.$path.'/'.strtolower($this->_template) . '.php';		
			}
		}
	
	}

}
