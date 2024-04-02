<?php session_start();
if(isset($_SESSION["cart"])){
  $jsondata = json_encode($_SESSION["cart"]);
  echo $jsondata;
}

 
?>