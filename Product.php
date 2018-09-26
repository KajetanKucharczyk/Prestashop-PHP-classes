<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Product{
	
	private $connection;
	
	public function __construct(){
		
		$this->connection = Connection::getInstance();
    }
	
    public function get_all_products_informations($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT * FROM product_lang WHERE id_product=$id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_name_by_product_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT name FROM product_lang WHERE id_product=$id AND id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['name'];
	}
}
?>