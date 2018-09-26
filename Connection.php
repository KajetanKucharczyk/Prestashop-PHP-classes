<?php
class Connection{

	private $user = '************';
	private $passwd = '************';
	
	private $db;
	static $instance;
	
	private function __construct(){
		//POŁĄCZENIE Z DB
		$this->db = new PDO("mysql:host=************;dbname=************", $this->user, $this->passwd);
		$this->db->exec("set names utf8");
		date_default_timezone_set("Europe/Warsaw");
    }
	
	private function __clone(){}
	
	public static function getInstance(){
		
		if(!(self::$instance instanceof Connection)){
			$c = __CLASS__;
			self::$instance = new $c;
		}
		
		return self::$instance;
	}
	
	function getConnection(){
		return $this->db;
	}
}
?>