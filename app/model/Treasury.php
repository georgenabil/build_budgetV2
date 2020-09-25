<?php

class Treasury {
    
    private $conn;
    private $table = 'Treasury';

   
    public $Id;
    public $Amount; 
    public $Date;

   
   public function __construct($db) {
      $this->conn = $db;
    }

    

public function read(){ 

    $query = 'SELECT * FROM ' . $this->table . '';
    
    $stmt = $this->conn->prepare($query);
    
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $this->Id = $row['Id'];
    $this->Date = $row['Date'];
    $this->Amount =$row['Amount'];
    
     return $row;
} 


public function update ($Amount)
{  
    
  $query = 'UPDATE ' . $this->table . '
  SET Amount = :Amount,Date =:Date
  WHERE Id = 1';


  $stmt = $this->conn->prepare($query);
  
  $time=time();
  // Bind data
  $stmt->bindParam(':Amount',$Amount );
  $stmt->bindParam(':Date',$time );
  
  if($stmt->execute()) {
    return true;
  }

 
  printf("Error: %s.\n", $stmt->error);

  return false;
}


public function delete($id){
   
  $this->id = htmlspecialchars(strip_tags($id));
  
  $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

   
   $stmt = $this->conn->prepare($query);

   $stmt->bindParam(':id', $this->id);
          
          if($stmt->execute()) {
            return true;
          }
         
          printf("Error: %s.\n", $stmt->error);
          return false;

}

}?>