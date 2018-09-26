<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

function cmp1($a, $b) {
	return strcasecmp($a['name'], $b['name']);
}
function cmp2($b, $a) {
	return strcasecmp($a['value'], $b['value']);
}

class Features{
	
	private $limit = 10;
	private $connection;
	
	public function __construct(){
		
		$this->connection = Connection::getInstance();
    }
		
    public function get_all_feature_name(){
		
		$query = $this->connection->getConnection()->prepare("SELECT name, id_feature FROM feature_lang WHERE id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		usort($res, 'cmp1');
		
		return json_encode($res);
	}
	
	public function get_all_feature_id_by_product_id($id_product){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature_value FROM feature_product WHERE id_product=$id_product");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_all_feature_value_id_by_feature_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature_value, value FROM feature_value_lang WHERE id_lang=1 AND id_feature_value IN (SELECT id_feature_value FROM feature_value WHERE id_feature='$id')");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		usort($res, 'cmp2');
		
		return json_encode($res);
	}
	
	public function get_feature_id_by_feature_value_name($value){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature_value FROM feature_value_lang WHERE id_lang=1 AND value LIKE '$value'");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		$id = $res[0]['id_feature_value'];
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature FROM feature_value WHERE id_feature_value=$id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['id_feature'];
	}
	
	public function get_feature_id_by_feature_value_id($id){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature FROM feature_value WHERE id_feature_value=$id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['id_feature'];
	}
	
	public function get_feature_name_by_feature_id($id){

		
		$query = $this->connection->getConnection()->prepare("SELECT name FROM feature_lang WHERE id_feature=$id AND id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['name'];
	}
	
	public function get_feature_value_name_by_feature_value_id($feature_value_id){
		
		
		
	}
	
	public function check_quantity_by_id_feature($id){

		
		$query = $this->connection->getConnection()->prepare("SELECT COUNT(DISTINCT id_product) as total FROM feature_product WHERE id_feature=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['total'];
	}
	
	public function check_quantity_by_id_product($id){

		
		$query = $this->connection->getConnection()->prepare("SELECT COUNT(DISTINCT id_feature) as total FROM feature_product WHERE id_product=$id");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['total'];
	}
	
	public function check_quantity_by_id_feature_value($id){

		
		$query = $this->connection->getConnection()->prepare("SELECT COUNT(DISTINCT id_product) as total FROM feature_product WHERE id_feature_value=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy)");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['total'];
	}
	
	public function get_all_product_id_by_feature_id($id){

		
		$limit = $this->limit;
		$query = $this->connection->getConnection()->prepare("SELECT DISTINCT id_product FROM feature_product WHERE id_feature=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy) LIMIT $limit");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_all_product_id_by_feature_value_id($id){

		
		$limit = $this->limit;
		$query = $this->connection->getConnection()->prepare("SELECT DISTINCT id_product FROM feature_product WHERE id_feature_value=$id AND id_product NOT IN (SELECT id_product FROM gotowe_cechy) LIMIT $limit");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_all_feature_value_name_by_product_id($id_product){
		
		$query = $this->connection->getConnection()->prepare("SELECT value FROM feature_value_lang WHERE id_lang=1 AND id_feature_value IN (SELECT id_feature_value FROM feature_product WHERE id_product='$id_product')");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return json_encode($res);
	}
	
	public function get_feature_value_by_feature_value_name($feature_value_name){

		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature_value FROM feature_value_lang WHERE value='$feature_value_name' AND id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['id_feature_value'];
	}
	
	public function get_name_by_feature_id($id){

		
		$query = $this->connection->getConnection()->prepare("SELECT value FROM feature_value_lang WHERE id_feature_value=$id AND id_lang=1");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['value'];
	}
	
	public function insert_feature_value($id_product, $id_feature, $id_feature_value){
		
		$sql = "INSERT INTO feature_product (id_product, id_feature, id_feature_value) VALUES ('$id_product', '$id_feature', '$id_feature_value')";
		$this->connection->getConnection()->exec($sql);
		
		return 1;
	}
	
	public function delete_feature_value($id_product, $id_feature, $id_feature_value){
		
		$q = "DELETE from feature_product WHERE id_feature=$id_feature AND id_feature_value=$id_feature_value AND id_product=$id_product";
		$this->connection->getConnection()->exec($q);
		
		return 1;
	}
	
	public function check_feature_by_product_id($product_id, $id_feature){
		
		$query = $this->connection->getConnection()->prepare("SELECT * FROM feature_product WHERE id_product='$product_id' AND id_feature='$id_feature'");
		$query->execute(); 	
		$res = $query->fetchAll();

		$zmienna;
		if(count($res) == 0)
			$zmienna = 0;
		else
			$zmienna = 1;	

		return $zmienna;
	}
	
	public function check_feature_value_by_name($feature_value_name, $id_feature){
		
		$query = $this->connection->getConnection()->prepare("SELECT id_feature_value FROM feature_value_lang WHERE value='$feature_value_name' AND id_feature_value IN (SELECT id_feature_value FROM feature_value WHERE id_feature='$id_feature')");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		if(count($res) == 0)
			return 0;
		else
			return 1;		
	}
	
}
?>