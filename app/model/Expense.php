<?php

class Expense {
  
    private $conn;
    private $table = 'Expenses';


    public $Made_by;
    public $Amount;
    public $Description;
    public $Apartment_Id;
    public $Date;
  

   
   public function __construct($db) {
      $this->conn = $db;
    }

   

public function read(){ 

        $query = 'SELECT * FROM ' . $this->table . '';

      
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
       
        return $stmt;
} 

public function  readWithTime($Startdate,$Enddate){
  
   $query = 'SELECT * FROM Expenses WHERE Date BETWEEN :Startdate AND :Enddate';

      
      $stmt = $this->conn->prepare($query);

      
      $stmt->bindParam(':Startdate', $Startdate);
      $stmt->bindParam(':Enddate', $Enddate);
      if($stmt->execute()){
         
        return $stmt;
      };
       
        
}




public function create() {
  $query = 'INSERT INTO '. $this->table .'(Made_by,Description,Amount,Date,Apartment_id) 
  VALUES(:Made_by,:Description,:Amount,:Date,:Apartment_id)';

  
  $stmt = $this->conn->prepare($query);

   
  
  $stmt->bindParam(':Made_by', $this->Made_by);
  $stmt->bindParam(':Description', $this->Description);
  $stmt->bindParam(':Amount', $this->Amount);
  $stmt->bindParam(':Apartment_id', $this->Apartment_Id);
  $stmt->bindParam(':Date', $this->Date);


  
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