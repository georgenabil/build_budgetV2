<?php

require_once('navbar.php');


if(isset($_POST['username'])&&isset($_POST['password'])) {

   echo  $_POST['username'];
     header('Refresh:3;url=dashboard.php'); 
}

 
?>
 
 <div class="container">
      <div class="form-warper">  

        <form id="login" action="login.php" method="post">
             <h2> Login </h2>
            <div class="form-input">
               <label>Username</label>
               <input id="username" type="text" class="form-control" name="username" required >
           
            </div>
            <div class="form-input">
               <label>Password</label>
               <input id="password" type="password" class="form-control" name="password" required >
           
            </div>
           
           <div class="form-button">
              <button type="submit" class="btn btn-info">Sumbit</button>
           </div>

           <p><?= isset($message)? $message:null;?></p>

        </form>
    </div>
</div>