<?php

 defined("APPLICATION_PATH")||define("APPLICATION_PATH" ,realpath(dirname(__FILE__).'/../app'));
 const DS =DIRECTORY_SEPARATOR;

 require_once APPLICATION_PATH .DS.'config'.DS.'config.php';
 require_once APPLICATION_PATH .DS.'database'.DS.'Database.php';
 require_once APPLICATION_PATH.DS.'model'.DS.'Treasury.php';
 require_once APPLICATION_PATH.DS.'model'.DS.'Receivable.php';
 require_once APPLICATION_PATH.DS.'model'.DS.'Apartment.php';
 require_once APPLICATION_PATH.DS.'model'.DS.'Expense.php';


  $getUrl=getURL();
  $page = isset( $getUrl[0]) ?  $getUrl[0] : 'index';
  
  $view= $config['VIEW_PATH'].$page.'.php';
 


  //models intializing 
   $database = new Database();
   $db= $database->connect();
  
  $Receivable = new Receivable($db);
  $Treasury = new Treasury($db);
  $Apartment= new Apartment($db);
  $Expense = new Expense($db);

  if(file_exists($view)){
    require $view;
  }else{
    require $config['VIEW_PATH']."404.php";
  };
 
?>


