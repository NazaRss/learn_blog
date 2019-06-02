<?php
namespace model;

use Core\SQL;
 
abstract class BaseModel {
	
	protected $db;
	protected $table;
	protected $pk;
	
	public function __construct()
	{
		$this->db = SQL::instance();
	}
	
	 public function getAll()
    {
        return $this->db->query("SELECT * FROM {$this->table} ORDER BY dt_create DESC");
    }

    public function getOne($id)
    {
         $res  = $this->db->query("SELECT * FROM {$this->table} WHERE {$this->pk} = '$id'");
         
        return $res ? $res[0] : false;
	}

    // $object  - [key1 => 'value1', key2 => 'value2']
    public function add($object)
    {
        return $this->db->insert($this->table, $object);
    }
    
    public function edit($id, $object)
    {
        return $this->db->update($this->table, $object, "$this->pk = '$id'");
    }
	
	 public function delete($id)
    {    
        return $this->db->delete($this->table, "$this->pk = '$id'");
    }
	
	
}
	