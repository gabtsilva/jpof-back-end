<?php 
session_start();
if(isset($_SESSION["token"])){
require "header.php";

require "footer.php";
}else{
  header("Location:sign.php?set=signin");
}
?>