<?php 

include_once './Database.php';
 
class Migration {
   private $conn;
    public function __construct($db)
    {
         $this->conn=$db;
    }

    public function up(){
      
      $Apartments ='
      CREATE TABLE IF NOT EXISTS Apartments(
        Id     INTEGER PRIMARY KEY AUTOINCREMENT, 
        Owner_name   TEXT NOT NULL,
        Apartment_number  INTEGER NOT NULL
      );';

      $Receivables='
      CREATE TABLE IF NOT EXISTS Receivables(
        Id     INTEGER PRIMARY KEY AUTOINCREMENT, 
        Apartment_id   INTEGER NOT NULL,
        Description        TEXT NOT NULL,
        Type        TEXT NOT NULL,
        Charges   REAL NOT NULL,
        Date     INTEGER NOT NULL,  
        FOREIGN KEY(Apartment_Id) REFERENCES Apartments(Id)
      );';

      $Expenses ='
       CREATE TABLE IF NOT EXISTS Expenses(
        Id     INTEGER PRIMARY KEY AUTOINCREMENT, 
        Made_by  TEXT NOT NULL,
        Description    TEXT NOT NULL,
        Amount  REAL NOT NULL,
        Date     INTEGER NOT NULL,
        Apartment_id   INTEGER,
        FOREIGN KEY(Apartment_Id) REFERENCES Apartments(Id)
      );';

      $Treasury= ' 
        CREATE TABLE IF NOT EXISTS Treasury(
        Id     INTEGER PRIMARY KEY, 
        Amount  REAL NOT NULL,
        Date     INTEGER  
      );';

      $deleteTreasury ='DELETE FROM Treasury WHERE 1=1;';
      
      $intialTreasury='
      INSERT INTO Treasury (Id,Amount,Date) VALUES(1,0.0,1599609722);
      ';

      
      try{
      $stmt = $this->conn->prepare($Apartments);
      $stmt->execute();

      $stmt = $this->conn->prepare($Receivables);
      $stmt->execute();

      $stmt = $this->conn->prepare($Expenses);
      $stmt->execute();

      $stmt = $this->conn->prepare($Treasury);
      $stmt->execute();
      
      $stmt = $this->conn->prepare($deleteTreasury);
      $stmt->execute();

      $stmt = $this->conn->prepare($intialTreasury);
      $stmt->execute();

      }
      catch(Exception $e){
         echo $e;
      }

      return $stmt;
    
      
    }

    public function down(){
       //droping tables
    }

 };
   
      
    $database = new Database();     
    $db = $database->connect();
    $mirgrate = new Migration($db);
    
    if( $mirgrate->up()){
     echo "Mirgations Created Tables";
    }



?>