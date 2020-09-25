<?php
require_once('navbar.php');

if(isset($_POST['Charges'])&&isset($_POST['Description']) &&isset($_POST['Apartment_Id']) &&isset($_POST['Type'])) {

$Receivable->Charges = $_POST['Charges'];
$Receivable->Description=$_POST['Description'];
$Receivable->Apartment_Id=$_POST['Apartment_Id'];
$Receivable->Type=$_POST['Type'];
$Receivable->Date=time();
 

if($_POST['Apartment_Id']=="ALL"){
  $Apartment  = new Apartment($db);
  $ApartmentStmt = $Apartment->read();
  $Receivablestmt = $Receivable->createMany($ApartmentStmt);
}else{
   $Receivablestmt = $Receivable->create();
}

  $message;

 if($Receivablestmt){
   $message= "done successfully ";
 }
   
 header('Refresh:3;url=dashboard.php'); 
   
 }


$Treasuryrow = $Treasury->read();
$Apartmentstmt = $Apartment->read();
$Receivablestmt = $Receivable->readWithApartments(); 


?>
 <div class="container">
      <div class="form-warper"> 
          
          <form   id="Receivableform" action="Receivables.php" method="post">
          <h2> Receivables </h2>
           <div class="form-input">
              <label>Charges</label>
              <input id="Charges" type="number" class="form-control" name="Charges" required min="0"  step="0.01" >
          
           </div>
           <div class="form-input">
              <label>Description</label>
              <input id="Description" type="text" class="form-control" name="Description" required >
          
           </div>
          
           <div class="form-input">
                <label>Apartment number</label>
                <select name="Apartment_Id" id="Apartment_Id">
                  <?php while($Apartmentrow = $Apartmentstmt->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?=$Apartmentrow['Id'] ?>"><?=$Apartmentrow['Apartment_number'] ?></option>
                  <?php } ?>
                   <option value="ALL">ALL</option> 
                </select>
           </div>
          
          
           <div class="form-radio"> 
             <label> Type </label>                   
             <div class="raido-options"> 
             <input type="radio" id="monthly" name="Type" value="monthly" required  >
                <label for="monthly">monthly</label>
             <input type="radio" id="emergency" name="Type" value="emergency">
                <label for="emergency">emergency</label>
             </div>
         </div>

           <div class="form-button">
               <button type="submit" class="btn btn-info">Sumbit</button>
           </div>
           <p><?= isset($message)? $message:null;?></p>
          
          </form>
      </div>    
          
   </div>

<!----------------------------------------------------------------------------------------------->



 

