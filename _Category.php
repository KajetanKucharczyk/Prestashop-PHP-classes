<?php
class _Category{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
	public function get_all_product_id_by_category_id($id){
		
		$query = "SELECT id_product FROM category_product WHERE id_product IN (SELECT id_product FROM stock_available WHERE quantity>0 OR out_of_stock=1) AND id_category=$id";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_all_product_id_by_category_id_ALL($id){
		
		$query = "SELECT id_product FROM category_product WHERE id_category = $id";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_category_name_by_category_id($id){
		
		$query = "SELECT name FROM category_lang WHERE id_category='$id' AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		$name = $res[0]['name'];
		
		return $name;
	}
	
	public function get_category_id_by_product_id($id){
		
		$query = "SELECT id_category FROM category_product WHERE id_product=$id_product";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
    
}
?>