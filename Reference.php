<?php
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Reference{
	
	private $connection;
	
	public function __construct(){
		
		$this->connection = Connection::getInstance();
    }
	
    public function get_reference_by_id($id) {
		
		$query = $this->connection->getConnection()->prepare("SELECT reference AS ref FROM product WHERE id_product='$id'");
		$query->execute(); 	
		$res = $query->fetchAll();
		
		return $res[0]['ref'];
    }
}
?>