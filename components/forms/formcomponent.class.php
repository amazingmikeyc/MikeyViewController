<?php
class FormComponent extends Component {

	private $_field;

	function __construct($field, $value = '') {
		parent::__construct();
				
		$this->assign('name',$field['Field']);
		$this->assign('value',$value);
	}

	function validate($value) {
		
	}

}
?>
