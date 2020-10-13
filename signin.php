<?php
session_start();
require "header.php";
require "admin/includes/conn.inc.php";

echo "<div class='signup-form'><h2>CONNEXION</h2><form method='POST' action='".$_SERVER["PHP_SELF"]."'>
<div class='form-group'>
  <label>Email</label>
  <input required name='user_email' type='email' class='form-control'>";
  if(isset($_GET["wrongemail"])){
    echo "<small>E-mail incorrect ou n'existe pas</small>";
  }elseif(isset($_GET["notvalidated"])){
    echo "<small>Veuillez activer votre compte par mail avant de vous connecter</small>";
  }
echo "</div>
<div class='form-group'>
<label>Mot de passe</label>
  <input required type='password' name='user_pwd'  class='form-control'>";
  if(isset($_GET["wrongpwd"])){
    echo "<small>Mot de passe incorrect</small>";
  }
echo "</div>
<button type='submit' name='signin-submit' class='btn btn-signin btn-primary'>Se connecter</button>
</form></div>";

if(isset($_POST["signin-submit"])){
  $email=$_POST["user_email"];
  $pwd=$_POST["user_pwd"];

  $sql = "SELECT * FROM users WHERE user_email = '$email'";
  $result = $conn->query($sql)->fetch();
  if(isset($_POST["signin-submit"])){
    $email=$_POST["user_email"];
    $pwd=$_POST["user_pwd"];
  
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql)->fetch();
    if($result === FALSE){
      header("Location:signin.php?wrongemail");
    }elseif(md5($pwd) != $result["user_pwd"]){
      header("Location:signin.php?wrongpwd");
    }elseif($result["user_validated"] == 0){
      header("Location:signin.php?notvalidated");
    }else{
      session_start();
      $_SESSION["token"] = $result["user_token"];
      $_SESSION["isadmin"] = $result["user_admin"];
      header("Location:index.php?loggedin");
      }
    }
  
  }
  echo "<p>Les comptes utilisables: <ul><li>prof@he-ferrer.eu / prof</li><li>visiteur@he-ferrer.eu / visiteur</li><li>nonconfirme@he-ferrer.eu / nonconfirme</li></ul></p>";

require "footer.php";

?>