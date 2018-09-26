<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Manufacturer{
	
	private $connection;
	
	public function __construct(){
		
		$this->connection = Connection::getInstance();
    }
	
    public function getIDfromNAME($name){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_manufacturer FROM manufacturer WHERE name='$name'");
		$query->execute(); 	
		$res = $query->fetchAll();
		$id = $res[0]['id_manufacturer'];
		
		return $id;
	}
	
	public function get_manufacturer_name_by_manufacturer_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT name FROM manufacturer WHERE id_manufacturer='$id'");
		$query->execute(); 	
		$res = $query->fetchAll();
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_manufacturer_name_by_product_id($id_product){
		
		$query = $this->connection->getConnection()->prepare("SELECT name, id_manufacturer FROM manufacturer WHERE id_manufacturer IN (SELECT id_manufacturer FROM product WHERE id_product=$id_product)");
		$query->execute(); 	
		$res = $query->fetchAll();
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_all_manufacturer_name(){
		
		$query = $this->connection->getConnection()->prepare("SELECT name FROM manufacturer");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
}
?>