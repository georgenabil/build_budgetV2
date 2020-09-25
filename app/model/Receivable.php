<?php

class Receivable {
    // DB stuff
    private $conn;
    private $table = 'Receivables';

    public $Charges;
    public $Description;
    public $Apartment_Id;
    public $Type;
    public $Date;

    // Constructor with DB
   public function __construct($db) {
      $this->conn = $db;
    }

   

public function read(){ 

        $query = 'SELECT * FROM ' . $this->table . '';

       $stmt = $this->conn->prepare($query);
       $stmt->execute();
       
        return $stmt;
} 

public function readWithApartments(){

    $query = 'SELECT * FROM Apartments,'. $this->table .'
      WHERE Apartments.Id=Receivables.Apartment_id
    ';

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
     
      return $stmt;
}
public function readWithDistinctApartments(){

  $query = 'SELECT * FROM Apartments,'. $this->table .'
    WHERE Apartments.Id=Receivables.Apartment_id GROUP by Apartment_number
  ';

  $stmt = $this->conn->prepare($query);
  $stmt->execute();
   
    return $stmt;
}



public function create() {
 
  $query = 'INSERT INTO '. $this->table .'(Apartment_id,Description,Type,Charges,Date) 
  VALUES(:Apartment_id,:Description,:Type,:Charges,:Date)';

  $stmt = $this->conn->prepare($query);


  $stmt->bindParam(':Apartment_id', $this->Apartment_Id);
  $stmt->bindParam(':Description', $this->Description);
  $stmt->bindParam(':Type', $this->Type);
  $stmt->bindParam(':Charges', $this->Charges);
  $stmt->bindParam(':Date', $this->Date);

  if($stmt->execute()) {
    return true;
   }
 

  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function createMany($Apartmentstmt) {

  $query = 'INSERT INTO '. $this->table .'(Apartment_id,Description,Type,Charges,Date) 
  VALUES(:Apartment_id,:Description,:Type,:Charges,:Date)';

  $stmt = $this->conn->prepare($query);
  while( $Apartment=$Apartmentstmt->fetch(PDO::FETCH_ASSOC)){
      $stmt->bindParam(':Apartment_id', $Apartment["Id"]);
      $stmt->bindParam(':Description', $this->Description);
      $stmt->bindParam(':Type', $this->Type);
      $stmt->bindParam(':Charges', $this->Charges);
      $stmt->bindParam(':Date', $this->Date);
      $stmt->execute();
  }

 
  return true;

}



public function delete($id){
    
  $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

   $stmt = $this->conn->prepare($query);

   $stmt->bindParam(':id',$id);
        
          if($stmt->execute()) {
            return true;
          }
         
          printf("Error: %s.\n", $stmt->error);
          return false;

}


public function find(){
  
 $query ='SELECT * FROM Receivables WHERE Apartment_id=:Apartment_id AND Type=:Type ';
   
   $stmt = $this->conn->prepare($query);

   $stmt->bindParam(':Apartment_id', $this->Apartment_Id);
   $stmt->bindParam(':Type', $this->Type);

   $stmt->execute();
    
    return $stmt;

}

public function findAll(){
  
  if($this->Type =="ALL"){
        $query ='SELECT * FROM Receivables WHERE Apartment_id=:Apartment_id';
  }else{
    
        $query ='SELECT * FROM Receivables WHERE Apartment_id=:Apartment_id AND Type=:Type ';
  }
  
  
    $stmt = $this->conn->prepare($query);
 
    $stmt->bindParam(':Apartment_id', $this->Apartment_Id);

    if($this->Type !="ALL"){
     $stmt->bindParam(':Type', $this->Type);
    }
 
    $stmt->execute();
     
     return $stmt;
 
 }


}?>