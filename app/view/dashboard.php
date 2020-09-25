<?php

require_once('navbar.php');
$Apartmentstmt=$Apartment->read();
$Receivablestmt = $Receivable->readWithApartments(); 
$Expensestmt=$Expense->read();
$Treasuryrow = $Treasury->read();
$ExpenseByTimestmt=null;

if(isset($_POST['start'])&&isset($_POST['end'])){
  
  $Start = new DateTime($_POST['start']);
  $Starttimestmp =$Start->getTimestamp();
  $End = new DateTime($_POST['end']);
  $Endtimestmp =$End->getTimestamp();
  $ExpenseByTimestmt=$Expense->readWithTime($Starttimestmp,$Endtimestmp);  
}
   
?>
<div class="container" >
    <div class="table-content">
     <h2> Receivables for Each Apartment </h2>
     <table class="Receivables">
       <tr>
         <th>Id</th>
         <th>Apartment_id</th>
         <th>Description</th>
         <th>Type</th>
         <th>Charges</th>
         <th>Apartment_number</th>
         <th>Owner_name</th>
         <th>Date</th>
       </tr>
     
     <?php while($Receivablerow = $Receivablestmt->fetch(PDO::FETCH_ASSOC)) { ?>
       
         <tr>
         <td><?=$Receivablerow['Id'];?></td>
         <td><?=$Receivablerow['Apartment_id'];?></td>
         <td><?=$Receivablerow['Description'];?></td>
         <td><?=$Receivablerow['Type'];?></td>
         <td><?=$Receivablerow['Charges'];?></td>
         <td><?=$Receivablerow['Apartment_number'];?></td>
         <td><?=$Receivablerow['Owner_name'];?></td>
         <td><?= date("Y-m-d H:i:s", $Receivablerow['Date']);?></td>
       </tr>
     
     <?php } ?>
       
       
     </table>
     
    </div> 
     

    <div class="table-content"> 
     <h2> Expenses </h2>
     <table class="Expenses">
       <tr>
         <th>Id</th>
         <th>Made_by</th>
         <th>Description</th>
         <th>Amount</th>
         <th>Apartment_id</th>
         <th>Date</th>
       </tr>
        
     <?php while($Expenserow = $Expensestmt->fetch(PDO::FETCH_ASSOC)) { ?>
         
         <tr>
         <td><?=$Expenserow['Id'];?></td>
         <td><?=$Expenserow['Made_by'];?></td>
         <td><?=$Expenserow['Description'];?></td>
         <td><?=$Expenserow['Amount'];?></td>
         <td><?=$Expenserow['Apartment_id'];?></td>
         <td><?= date("Y-m-d H:i:s", $Expenserow['Date']);?></td>
       </tr>
     
     <?php } ?>
       
       
     </table>
    </div>
     
     
     
     
     
     <form id="Expensesform" action="dashboard.php" method="post">
        <h3>Expenses in a Specific Period</h3> 
          <label>From: </label>
          <input id="start" type="date" class="form-control" name="start" required > 
          <label>TO: </label>
          <input id="end" type="date" class="form-control" name="end" required >
          <button type="submit" class="btn btn-info">Sumbit</button>
     </form>
     
     
    <div class="table-content">  
     <table class="Expenses">
       <tr>
         <th>Id</th>
         <th>Made_by</th>
         <th>Description</th>
         <th>Amount</th>
         <th>Apartment_id</th>
         <th>Date</th>
       </tr>
      
     <?php
      if(isset($_POST['start']) && isset($_POST['end'])){
     while($ExpenseTimerow = $ExpenseByTimestmt->fetch(PDO::FETCH_ASSOC)) { 
       ?>
         
         <tr>
         <td><?=$ExpenseTimerow['Id'];?></td>
         <td><?=$ExpenseTimerow['Made_by'];?></td>
         <td><?=$ExpenseTimerow['Description'];?></td>
         <td><?=$ExpenseTimerow['Amount'];?></td>
         <td><?=$ExpenseTimerow['Apartment_id'];?></td>
         <td><?= date("Y-m-d H:i:s", $ExpenseTimerow['Date']);?></td>
       </tr>
     
     <?php } } ?>
       
     </table>
     
     
     <h2>the current Budget Amount</h2>
     <h1> <?=$Treasuryrow['Amount'];?></h1>
   
     </div>

</div>
