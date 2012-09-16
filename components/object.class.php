<?php
//include_once('component.class.php');
class Object  {

	private $_structure;
	private $_tableName;

	private $_record;

	private $_primaryKey;

	function __construct($table) {
		
		$sql = 'SHOW FULL COLUMNS FROM '.$table;
		$result = $this->query($sql);

		$this->_tableName = $table;

		$fields = array();

		while($record = mysql_fetch_assoc($result)) {
echo '<pre>'.print_r($record,1).'</pre>';
		        $fields[$record['Field']] = $record;

			//Look for the primary key
			if ($record['Key']=='PRI') {
				$this->_primaryKey = $record['Field'];
			}


			//the form for 

		}	

		$this->_structure = $fields;

	}

	function getTableName() {
		return $this->_tableName;
	}

	function structure() {
		return $this->_structure;
	}


	function get($search = array()) {
		
	}


	function save($values) {
		$save = array();	
		$errors = array();
	
		//Go through the submitted values
		foreach ($values as $key=>$value) {
			
			//We assume that the form has validated it,
			//because otherwise we don't know if we're allowed
			//to return certain values or what.
			if (isset($this->_structure[$key])) {
				
				$save[$key] = $value;
				
			}

		}
		//validates

		//saves
		//is the primary key set? Then we know to do an update.
		if (isset($save[$this->_primaryKey])) {
			$sql = 'UPDATE '.$this->_tableName.' SET ';

			foreach ($save as $key=>$value) {
				//Don't do an update on a primary key
				if ($key!=$this->_primaryKey) {
					$sql.=' `'.$key.'` = "'.mysql_real_escape_string($value).'"';
				}
			}

			$sql .= ' WHERE `'.$this->_primaryKey.'` = "'.$save[$this->_primaryKey].'"';
		}
		else {
			$sql = 'INSERT INTO '.$this->_tableName.' (`';

			$sql.=implode('`,`',array_keys($save));

			$sql.='`) VALUES ("';

			$sql.=implode('","',$save);
			$sql.='")';
		}

		$this->query($sql);
	}

	function primaryKey() {
		return $this->_primaryKey;
	}

	function query($sql) {

		mysql_connect('127.0.0.1','root','r00t');
		mysql_select_db('mikeyc_mikeynet');

		return mysql_query($sql);

	}

}
