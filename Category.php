<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Category{
	
	private $connection;
	
	public function __construct(){
		
		$this->connection = Connection::getInstance();
    }
	
	public function get_all_product_id_by_category_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_product FROM category_product WHERE id_product IN (SELECT id_product FROM stock_available WHERE quantity>0 OR out_of_stock=1) AND id_category=$id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_all_product_id_by_category_id_ALL($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_product FROM category_product WHERE id_category = $id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_category_name_by_category_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT name FROM category_lang WHERE id_category='$id' AND id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_category_id_by_product_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_category FROM category_product WHERE id_product=$id_product");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
    
}
?>