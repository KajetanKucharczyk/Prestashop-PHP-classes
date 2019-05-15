<?php
class _Manufacturer{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
    public function getIDfromNAME($name){
		
		$query = "SELECT id_manufacturer FROM manufacturer WHERE name='$name'";
		$res = $this->connection->ExecuteS($query);
		$id = $res[0]['id_manufacturer'];
		
		return $id;
	}
	
	public function get_manufacturer_name_by_manufacturer_id($id){
		
		$query = "SELECT name FROM manufacturer WHERE id_manufacturer='$id'";
		$res = $this->connection->ExecuteS($query);
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_manufacturer_name_by_product_id($id_product){
		
		$query = "SELECT name, id_manufacturer FROM manufacturer WHERE id_manufacturer IN (SELECT id_manufacturer FROM product WHERE id_product=$id_product)";
		$res = $this->connection->ExecuteS($query);
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_all_manufacturer_name(){
		
		$query = "SELECT name FROM manufacturer";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
}
?>