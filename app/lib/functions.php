<?php

   function getURL(){
     
    if(isset($_REQUEST['url'])){  
       $url = rtrim($_REQUEST['url'],'/');
       $url = rtrim($_REQUEST['url'],'.php');
       $url = explode('/',$url); 
       return $url;
    }
     return null;

   }
   
?>