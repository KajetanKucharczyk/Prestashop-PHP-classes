<?php
class _Reference{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
    public function get_reference_by_id($id) {
		
		$query = "SELECT reference FROM product WHERE id_product='$id'";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['reference'];
    }
	
	public function get_id_from_reference($reference) {
		
		$query = "SELECT id_product AS id FROM product WHERE reference='$reference'";
		$res = $this->connection->ExecuteS($query);
		
		return $res[0]['id'];
    }
}
?>