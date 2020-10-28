<?php
session_start();
require "header.php";
require "includes/conn.inc.php";
$set = $_GET["set"];

echo "<div clas='container'>
        <div class='row signup-container min-vh-100 vh-100 justify-content-center align-items-center'>
        <div class='signup-form col-3'>
        <form method='POST' class='px-4 py-5' action='".$_SERVER["PHP_SELF"]."?set=signin'>
            <div class='form-group mb-4'>
                <label>Adresse Email</label>
                <input required name='user_email' placeholder='root@he-ferrer.eu' type='email' class='form-control'>";
                if(isset($_GET["wrongemail"])){
                    echo "<small>E-mail incorrect ou n'existe pas</small>";
                }elseif(isset($_GET["notvalidated"])){
                    echo "<small>Veuillez activer votre compte par mail avant de vous connecter</small>";
                }
echo "</div>
        <div class='form-group'>
            <label>Mot de passe</label>
            <input required type='password' placeholder='•••••••••' name='user_pwd'  class='form-control'>";
            if(isset($_GET["wrongpwd"])){
                echo "<small>Mot de passe incorrect</small>";
            }
echo "</div>
        <button type='submit' name='signin-submit' class='btn btn-signin btn-dark'>Connexion</button>
    </form>
</div></div></div>";

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
    if($result["user_admin"] == 1){
    if($result === FALSE){
    header("Location:sign.php?set=signin&wrongemail");
    }elseif(md5($pwd) != $result["user_pwd"]){
    header("Location:sign.php?set=signin&wrongpwd");
    }elseif($result["user_validated"] == 0){
    header("Location:sign.php?set=signin&notvalidated");
    }else{
    session_start();
    $_SESSION["token"] = $result["user_token"];
    $_SESSION["isadmin"] = $result["user_admin"];
    header("Location:index.php?loggedin");
    }
    }else{
        header("Location:../index.php");
    }
    }

}
?>