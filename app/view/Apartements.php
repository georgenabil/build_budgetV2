<?php
 
 require_once('navbar.php');
 
 if(isset($_POST['Owner_name'])&&$_POST['Apartment_number']) {
   $Owner_name = $_POST['Owner_name'] ;
   $Apartment_number= $_POST['Apartment_number'];
   
   $Apartmentstmt= $Apartment->create($Owner_name,$Apartment_number);
   
   $message;
   if($Apartmentstmt){
      $message= "created Sccussefully !";
       
   }else{
      $message="there is an error";
   }
   
   header('Refresh:3;url=dashboard.php');
 
} 

?>

<div class="container">
    
   <div class="form-warper"> 

        <form id="form" action="Apartements.php" method="post">
          <h2> Apartments </h2> 

       <div class="form-input">
          <label>Owner name</label>
       
          <input id="Owner_name" type="text" class="form-control" name="Owner_name" required >
       
       </div>
       
        <div class="form-input">
           <label>Apartment number</label>
       
           <input id="Apartment_number" type="number" class="form-control" name="Apartment_number" value="" required>
        
            </div>
            <div class="form-button">
            <button type="submit" class="btn btn-info">ADD</button>
           </div>


           <p><?= isset($message)? $message:null;?></p>
         </form>

         
   </div>
</div>      


<script>
   /*
   var form= document.getElementById('form');  
  
  
    form.addEventListener('submit', event => {
    event.preventDefault();
    var name = document.getElementById("Owner_name");
    var Apartment = document.getElementById("Apartment_number");
    
    fetch('http://localhost/ABM/app/Apartements-create.php',{
    	method:"POST",
    	body:JSON.stringify({ Owner_name:name.value,Apartment_number:Apartment.value })
  })


    alert(JSON.stringify({ Owner_name:name.value,Apartment_number:Apartment.value }));

    window.location.href="http://localhost/ABM/app/dashboard.php"; 
   
});

*/
</script>