<?php
class _Product{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
    public function get_all_products_informations($id){
		
		$query = "SELECT * FROM product_lang WHERE id_product=$id";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_name_by_product_id($id){
		
		$query = "SELECT name FROM product_lang WHERE id_product=$id AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['name'];
	}
	
	public function get_polish_name_by_product_id($id){
		
		$query = "SELECT name FROM product_lang WHERE id_product=$id AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['name'];
	}
	
	public function get_english_name_by_product_id($id){
		
		$query = "SELECT name FROM product_lang WHERE id_product=$id AND id_lang=2";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['name'];
	}
}
?>