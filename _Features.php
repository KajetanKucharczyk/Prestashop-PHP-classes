<?php
function _cmp1($a, $b) {
	return strcasecmp($a['name'], $b['name']);
}
function _cmp2($b, $a) {
	return strcasecmp($a['value'], $b['value']);
}

class _Features{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
    public function get_all_feature_name(){
		
		$query = "SELECT name, id_feature FROM feature_lang WHERE id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		usort($res, '_cmp1');
		
		return json_encode($res);
	}
	
	public function get_all_feature_id_by_product_id($id_product){
		
		$query = "SELECT id_feature_value FROM feature_product WHERE id_product=$id_product";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_all_feature_value_id_by_feature_id($id){
		
		$query = "SELECT id_feature_value, value FROM feature_value_lang WHERE id_lang=1 AND id_feature_value IN (SELECT id_feature_value FROM feature_value WHERE id_feature='$id')";
		$res = $this->connection->ExecuteS($query);
		
		usort($res, '_cmp2');
		
		return json_encode($res);
	}
	
	public function get_feature_id_by_feature_value_name($value){
		
		$query = "SELECT id_feature_value FROM feature_value_lang WHERE id_lang=1 AND value LIKE '$value'";
		$res = $this->connection->ExecuteS($query);
		
		$id = $res[0]['id_feature_value'];
		
		$query = "SELECT id_feature FROM feature_value WHERE id_feature_value=$id";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['id_feature'];
	}
	
	public function get_feature_id_by_feature_value_id($id){
		
		$query = "SELECT id_feature FROM feature_value WHERE id_feature_value=$id";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['id_feature'];
	}
	
	public function get_feature_name_by_feature_id($id){

		
		$query = "SELECT name FROM feature_lang WHERE id_feature=$id AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['name'];
	}
	
	public function get_feature_value_name_by_feature_value_id($feature_value_id){
		
		
		
	}
	
	public function check_quantity_by_id_feature($id){

		
		$query = "SELECT COUNT(DISTINCT id_product) as total FROM feature_product WHERE id_feature=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['total'];
	}
	
	public function check_quantity_by_id_product($id){

		
		$query = "SELECT COUNT(DISTINCT id_feature) as total FROM feature_product WHERE id_product=$id";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['total'];
	}
	
	public function check_quantity_by_id_feature_value($id){

		
		$query = "SELECT COUNT(DISTINCT id_product) as total FROM feature_product WHERE id_feature_value=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['total'];
	}
	
	public function get_all_product_id_by_feature_id($id){

		$query = "SELECT DISTINCT id_product FROM feature_product WHERE id_feature=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_all_product_id_by_feature_value_id($id){
		
		$query = "SELECT DISTINCT id_product FROM feature_product WHERE id_feature_value=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_all_feature_value_name_by_product_id($id_product){
		
		$query = "SELECT value FROM feature_value_lang WHERE id_lang=1 AND id_feature_value IN (SELECT id_feature_value FROM feature_product WHERE id_product='$id_product')";
		$res = $this->connection->ExecuteS($query);
		
		return json_encode($res);
	}
	
	public function get_feature_value_by_feature_value_name($feature_value_name){

		
		$query = "SELECT id_feature_value FROM feature_value_lang WHERE value='$feature_value_name' AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['id_feature_value'];
	}
	
	public function get_name_by_feature_id($id){

		
		$query = "SELECT value FROM feature_value_lang WHERE id_feature_value=$id AND id_lang=1";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['value'];
	}
	
	public function insert_feature_value($id_product, $id_feature, $id_feature_value){
		
		$query = "INSERT INTO feature_product (id_product, id_feature, id_feature_value) VALUES ('$id_product', '$id_feature', '$id_feature_value')";
		$res = $this->connection->ExecuteS($query);
		
		return 1;
	}
	
	public function delete_feature_value($id_product, $id_feature, $id_feature_value){
		
		$query = "DELETE from feature_product WHERE id_feature=$id_feature AND id_feature_value=$id_feature_value AND id_product=$id_product";
		$res = $this->connection->ExecuteS($query);
		
		return 1;
	}
	
	public function check_feature_by_product_id($product_id, $id_feature){
		
		$query = "SELECT * FROM feature_product WHERE id_product='$product_id' AND id_feature='$id_feature'";
		$res = $this->connection->ExecuteS($query);

		$zmienna;
		if(count($res) == 0)
			$zmienna = 0;
		else
			$zmienna = 1;	

		return $zmienna;
	}
	
	public function check_feature_value_by_name($feature_value_name, $id_feature){
		
		$query = "SELECT id_feature_value FROM feature_value_lang WHERE value='$feature_value_name' AND id_feature_value IN (SELECT id_feature_value FROM feature_value WHERE id_feature='$id_feature')";
		$res = $this->connection->ExecuteS($query);
		
		if(count($res) == 0)
			return 0;
		else
			return 1;		
	}
	
}
?>