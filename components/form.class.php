<?php
include_once('component.class.php');

class Form extends Component {

	private $_table;
	private $_formID;

	private $_formItems;
	
	private $_state;
	
	private $_insertId = '';

	function __construct($table) {
		
		if (gettype($table)=='string') {
			$table = new Object($table);
		}

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
		
		$this->_state = 'normal';
		
		$this->_formItems = $formitems;
		
	
	}


	function display() {
		
		$this->assign('formID',$this->_formID);
		$this->assign('formitem',$this->_formItems);

		$this->assign('table',$this->_table);

		$this->assign('state', $this->_state);

		$this->assign('insertId', $this->_insertId);

		parent::display();
	}

	function save($values) {
		$saved = $this->_table->save($values);
				
		if ($saved) {
			$this->_state = 'saved';
			
			$this->_insertId = $saved;
		}
		else {
			$this->_state = 'notsaved';
		}
	}
	

}

?>
