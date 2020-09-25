<?php 
 
class Database {
    // DB Params
    private $db_name = 'budget';
    private $conn;
   
    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $path =dirname(__FILE__)."\\";
        $this->conn = new PDO('sqlite:'.$path.$this->db_name.'_PDO.sqlite');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
}
 
   
?>