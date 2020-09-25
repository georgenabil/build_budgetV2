<?php
require_once('navbar.php');

if(isset($_POST['Apartment_Id'])&&$_POST['PaymentType']) {
   
   
   $Apartment_Id = $_POST['Apartment_Id']; 
   $Type=$_POST['PaymentType']; 

    $sum = 0;

    $Receivable->Apartment_Id=$Apartment_Id;
    $Receivable->Type=$Type;
    $Receivablestmt=$Receivable->findAll();

    while($Receivablerow = $Receivablestmt->fetch(PDO::FETCH_ASSOC)) {
          $sum+=$Receivablerow['Charges'];
          $Receivable->delete($Receivablerow['Id']);
    }
     
    $Amount=$Treasury->read()['Amount'];
    $NewAmount = $sum+$Amount;
    
    $Treasury->update($NewAmount);

$message;
 if($Receivablestmt){
   $message= "done successfully ";
 }
 header('Refresh:3;url=dashboard.php');
}


$Treasuryrow = $Treasury->read();
$Apartmentstmt = $Apartment->read();
$Receivablestmt = $Receivable->readWithDistinctApartments(); 


?>
<div class="container">
      <div class="form-warper"> 


         <form id="Paymentform" action="Payments.php" method="post">
         <h2> Payments </h2>
         <div class="form-input">
              <label>Apartment number</label>
              <select name="Apartment_Id" id="Apartment_Id">
                <?php while($Receivablesrow = $Receivablestmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?=$Receivablesrow['Apartment_id'] ?>"> <?=$Receivablesrow['Apartment_number'] ?></option>
                <?php } ?>
              </select>
         </div>
         
         <div class="form-radio"> 
             <label> Type </label>                   
             <div class="raido-options"> 
                   <input type="radio" id="monthly" name="PaymentType" value="monthly" required  >
                      <label for="monthly">monthly</label>
                   <input type="radio" id="emergency" name="PaymentType" value="emergency">
                      <label for="emergency">emergency</label>
                   <input type="radio" id="ALL" name="PaymentType" value="ALL">
                      <label for="ALL">ALL</label>
                </div>    
         </div>

         
         <div class="form-button">
               <button type="submit" class="btn btn-info">Payed</button>
          </div>    
          <p><?= isset($message)? $message:null;?></p>  
         </form>
       </div>
</div>


