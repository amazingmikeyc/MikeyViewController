<?php

class Controller extends Component {
	
	private $_component;
	private $_template;


	//Load the component for this page

	function __construct($class='form', $function='') {
				 
		if (is_object($class)) {
			$this->_component = $class;
		}
		else {
			$this->_component = new $class();
		}
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->_template = 'ajax';
		}
		else {
			$this->_template = 'default';
		}

		parent::__construct($this->_template);

		if ($function) {
			if (method_exists($this->_component,$function)) {
				$this->_component->$function($_POST);				
			}
		}

	}

	function display() {
		$this->assign('component',$this->_component);					

		parent::display();
	}

}
