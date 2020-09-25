<?php

class Apartment {

    private $conn;
    private $table = 'Apartments';

 
   
   public function __construct($db) {
      $this->conn = $db;
    }

   
public function read(){ 

        $query = 'SELECT * FROM ' . $this->table . '';

      // Execute query
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
       
        return $stmt;
} 



public function create($Owner_name,$Apartment_number) {
  
  $query = 'INSERT INTO '. $this->table .'(Owner_name,Apartment_number) VALUES(:Owner_name ,:Apartment_number)';

  
  $stmt = $this->conn->prepare($query); 
  
 
  $stmt->bindParam(':Owner_name', $Owner_name);
  $stmt->bindParam(':Apartment_number', $Apartment_number);
 


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