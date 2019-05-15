<?php
class _ProductLink{
	
	private $connection;
	
	public function __construct($conn){
		
		$this->connection = $conn;
    }
	
	public function get_product_link_by_id($id, $domain = "agtom.eu", $type = "https"){
		
		$link = $type;
		$link .= "://";
		$link .= $domain;
		$link .= "/index.php?controller=product&id_product=";
		$link .= $id;
		
		return $link;
	}
}
?>