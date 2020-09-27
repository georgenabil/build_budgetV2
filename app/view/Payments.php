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
$ApartmentTotalstmt = $Apartment->TotalCharges();

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

 <br> <br>

<div class="table-content"> 
     <h2> Apartments Payments Summary </h2>
     <table class="Apartments">
       <tr>
         <th>Apartment_id</th>
         <th>Owner_name</th>
         <th>Description</th>
         <th>total</th>
         <th>Date</th>
       </tr>
        
     <?php while($ApartmentTotal = $ApartmentTotalstmt->fetch(PDO::FETCH_ASSOC)) { ?>
         
         <tr>
         <td><?=$ApartmentTotal['Apartment_id'];?></td>
         <td><?=$ApartmentTotal['Owner_name'];?></td>
         <td>Total Monthly + Emergency </td>
         <td><?=$ApartmentTotal['total'];?></td>
         <td><?= date("Y-m-d H:i:s", $ApartmentTotal['Date']);?></td>
       </tr>
     
     <?php } ?>
       
       
     </table>
    </div>
     

 </div>

