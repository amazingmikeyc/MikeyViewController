<?php

class DataGrid extends Component {

	private $_table;
	private $_formID;
	
	public $data;

	function __construct($data=array()) {

		$this->data = $data;
		
		if (isset($_POST['data'])) {
			$this->data = $_POST['data'];
		}
		
		parent::__construct();
	}

	

	function display() {
		$this->assign('data',$this->data);

		parent::display();
	}

	

}

?>
