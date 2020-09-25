<?php

require_once('navbar.php');


if(isset($_POST['Apartment_Id'])&&isset($_POST['Date'])&&isset($_POST['Expenses'])&&isset($_POST['Description']) ) {


$FlatAndOwner = explode("+",$_POST['Apartment_Id']); 
$dateTime = new DateTime($_POST['Date']);

$Expense->Made_by=$FlatAndOwner[1];       
$Expense->Amount=$_POST['Expenses'];      
$Expense->Description=$_POST['Description'];   
$Expense->Apartment_Id=$FlatAndOwner[0];  
$Expense->Date=$dateTime->getTimestamp();



$BalanceAmount =$Treasury->read()['Amount'];

$message;

if($BalanceAmount <= $Expense->Amount){
    $message="the Amount in The Teasury Can`t afford these Expenses";
}else{
 $NewAmount =$BalanceAmount-($Expense->Amount);
 $Treasury->update($NewAmount);
 $Expense->create();

 $message ="Done Succssfully";

}

header('Refresh:3;url=dashboard.php'); 
}


$Apartmentstmt = $Apartment->read();
 
?>
 
 <div class="container">
      <div class="form-warper">  

<form id="Expensesform" action="Expenses.php" method="post">
     <h2> Expenses </h2>
    <div class="form-input">
       <label>Expenses</label>
       <input id="Expenses" type="number" class="form-control" name="Expenses" required min="0"  step="0.01" >
   
    </div>
    <div class="form-input">
       <label>Description</label>
       <input id="Description" type="text" class="form-control" name="Description" required >
   
    </div>
   
    <div class="form-input">
         <label>Owner name</label>
         <select name="Apartment_Id" id="Apartment_Id">
           <?php while($Apartmentrow = $Apartmentstmt->fetch(PDO::FETCH_ASSOC)) { ?>
           <option value="<?= $Apartmentrow['Id']."+".$Apartmentrow['Owner_name'] ?>"><?=$Apartmentrow['Owner_name'] ?></option>
           <?php } ?>   
         </select>
    </div>
    <div class="form-input">
       <label>date</label>
       <input id="Date" type="date" class="form-control" name="Date" required >
            
    </div>
   
   <div class="form-button">
      <button type="submit" class="btn btn-info">Sumbit</button>
   </div>
   <p><?= isset($message)? $message:null;?></p>
</form>
</div>
</div>




 

