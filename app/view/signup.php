<?php

require_once('navbar.php');


if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['repassword'])) {
   $message;
   if($_POST['password']!=$_POST['repassword']){
      $message = "the passwaord doesn`t match";
      header('Refresh:3;url=login.php');   

   }

 
}

 
?>
 
 <div class="container">
      <div class="form-warper">  

        <form id="signup" action="signup.php" method="post">
             <h2> Sing up </h2>
            <div class="form-input">
               <label>Username</label>
               <input id="username" type="text" class="form-control" name="username" required >
           
            </div>
            <div class="form-input">
               <label>Password</label>
               <input id="password" type="password" class="form-control" name="password" required >
           
            </div>
            <div class="form-input">
               <label>Re-type Password  </label>
               <input id="repassword" type="password" class="form-control" name="repassword" required >
           
            </div>
           
           <div class="form-button">
              <button type="submit" class="btn btn-info">sign up</button>
           </div>

           <p><?= isset($message)? $message:null;?></p>

        </form>
    </div>
</div>