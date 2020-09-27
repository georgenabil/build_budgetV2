<?php

   function getURL(){
     
    if(isset($_REQUEST['url'])){  
       $url = rtrim($_REQUEST['url'],'/');
       $url=str_replace('.php','',$url);
       $url = explode('/',$url); 
       return $url;
    }
     return null;

   }
   
?>