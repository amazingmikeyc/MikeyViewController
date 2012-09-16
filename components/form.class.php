<?php
include_once('component.class.php');

class Form extends Component {

	private $_table;
	private $_formID;

	function __construct($table) {

		$this->_formID = md5(serialize($table).date('H:i:s'));
	
		$this->_table = $table;

		parent::__construct();

		foreach ($this->_table->structure() as $key=>$row) {
			if ($key == $this->_table->primaryKey()) {
				$formitems[] = new Hidden($row);
				continue;
			}

			if ($row['Type'] == 'text') {
				$formitems[] = new TextArea($row);
			}
			else {
				$formitems[] = new Input($row);
			}
		}
		
		$this->assign('formID',$this->_formID);
		$this->assign('formitem',$formitems);

		$this->assign('table',$this->_table);
	}

	

	function display() {
	/*
		foreach ($this->_table->structure() as $row) {
			//print_r('<pre>'.print_r($row,1).'</pre>');		

			if ($row['Type']=='text') {
				 include ('templates/textbox.php');
			}
			else {
				include ('templates/text.php');
			}
	
		}	
*/

		parent::display();
	}

	function save($values) {
		$this->_table->save($values);
	}
	

}

?>
