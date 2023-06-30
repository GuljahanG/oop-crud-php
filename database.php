<?php
/**
 * @author Guljahan Ilmedova <gurbanmyradownaguljahan@gmail.com>
 * @version 1.0.0
**/
class Database
{
	
	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = 'root';
	private $dbname = 'simple_todo_app';

	
	public $db;
	/**
	 * Query result
	 * @var array
	 */
	public $result = [];

	/**
	 * Autoload database connection
	 */
	public function __construct() {
		// create connection with mysqli object
		$this->db = new mysqli($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);
		if ($this->db->connect_errno) {
			array_push($this->result, 'Connected to database');
			return true; // connection success
		}else {
			array_push($this->result, $this->db->error);
			return false; // Problem with a connecting retirn FALSE
		}
	}

	/**
	 * Select Table
	 * @param string table to be select
	 * @param string rows column to be display
	 * @param string limit is the number of records to return
	 */
	public function read($table, $rows = '*', $limit = null)
	{
		$sql = 'SELECT '.$rows.' FROM '.$table;

		if ($limit != null) {
			$sql .= ' LIMIT '.$limit;
		}
		$query = $this->db->query($sql);
		$data = [];
		while ($row = $query->fetch_assoc()) { // query will be return with loop
			$data[] = $row;
		}
		return $data;
	}

	/**
	 * Add Record
	 * @param string table
	 * @param array data insert to database
	 */
	public function insert($table, $data = array())
	{
		$column = implode('`, `', array_keys($data)); // implode array keys
		$values = implode('", "', $data); // implode array value
		$sql		= 'INSERT INTO `'.$table.'` (`'.$column.'`) VALUES("'.$values.'")';
		if ($this->db->query($sql)) {
			array_push($this->result, $this->db->insert_id); // get id when successfully inserted
			return true; // query success return TRUE
		}
		else {
			array_push($this->result,$this->db->error); // will be return error
			return false; // something wrong return FALSE
		}
	}
    /**
	 * Edit Record
	 * @param string table
	 * @param array data to be modify
	 * @param string where condition to select
	 */
	public function edit($table, $where)
	{
		$sql = 'SELECT * FROM '.$table.' WHERE ' . $where;
	
		$query = $this->db->query($sql);
		$data = $query->fetch_assoc();
		return $data;
       
	}
    /**
	 * Update Record
	 * @param string table name
	 * @param array data
	 * @param string where condition to update
	 */
	public function update($table, $data=array(), $where)
	{
		$value = array();
		foreach ($data as $column => $field) {
			
			$value[] = $column.'="'.$field.'"';
		}
		$values = implode(',', $value); // implode value
		$sql		= 'UPDATE `'.$table.'` SET '.$values.' WHERE '.$where;
		
		if ($this->db->query($sql)) {
			array_push($this->result, $this->db->affected_rows);
			return true; 
		}
		else {
			array_push($this->result,$this->db->error);
			return false; 
		}
	}
    /**
	 * Delete Record
	 * @param string table
	 * @param string where condition to delete
	 */
	public function delete($table, $where)
	{
		$sql = 'DELETE FROM '.$table.' WHERE ' . $where;
		if ($this->db->query($sql)) {
			array_push($this->result, $this->db->affected_rows);
			return true; 
		}
		else {
			array_push($this->result, $this->db->error);
			return false;
		}
	}

}
