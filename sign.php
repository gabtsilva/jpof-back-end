<?php
session_start();
require "header.php";
require "admin/includes/conn.inc.php";
$set = $_GET["set"];

if($set == "signup"){
    echo "<div class='signup-form'><h2>INSCRIPTION</h2><form method='POST' action='".$_SERVER["PHP_SELF"]."?set=signup'><div class='form-group row'><div class='col'><label>Prénom</label><input required name='user_name' type='text' class='form-control'></div><div class='col'><label>Nom de famille</label><input type='text' name='user_surname' class='form-control'></div></div><div class='form-group'><label>Email</label><input required name='user_email' type='email' class='form-control'></div><div class='form-group'><label>Mot de passe</label><input required type='password' name='user_pwd' class='form-control'></div><button type='submit' name='signup-submit' class='btn-signin btn btn-primary'>S'inscrire</button></form></div>";

    if(isset($_POST["signup-submit"])){
    $name=$_POST["user_name"];
    $surname=$_POST["user_surname"];
    $email=$_POST["user_email"];
    $pwd=md5($_POST["user_pwd"]);
    $permitted_chars = "0123456789abcdefghijklmnopqrstuvwxyz";
    $token = substr(str_shuffle($permitted_chars),0,20);
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql)->fetch();
    if($result === FALSE){
        try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (user_name, user_surname, user_email,user_pwd,user_token) VALUES ('$name', '$surname', '$email','$pwd','$token')";
        $result = $conn->exec($sql);

        $to = $email;
        $subject = "Confirmation d'inscription - FerrEvent";
        
        $message = "Bonjour ".$name.",<br/>";
        $message .= "Pour pouvoir te connecter et commencer à utliser ton compte JPOF, clique sur le lien ci-dessous !<br/><br/><a href='https://gab.techniques-graphiques.be/jpof/validation.php?token=$token'>Activation du compte</a>";
        
        $headers = "From:no-reply@ferrevent.be \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";

        mail( $to , $subject , $message, $headers);
        header("Location:confirm-signup.php?confirm-signup");
        } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }
    }else{
        header("Location: signup.php?error=exists");
    }
    }

}else if($set == "signin"){
    echo "<div class='signup-form'><h2>CONNEXION</h2><form method='POST' action='".$_SERVER["PHP_SELF"]."?set=signin'><div class='form-group'><label>Email</label><input required name='user_email' type='email' class='form-control'>";
    if(isset($_GET["wrongemail"])){
        echo "<small>E-mail incorrect ou n'existe pas</small>";
    }elseif(isset($_GET["notvalidated"])){
        echo "<small>Veuillez activer votre compte par mail avant de vous connecter</small>";
    }
    echo "</div><div class='form-group'><label>Mot de passe</label><input required type='password' name='user_pwd'  class='form-control'>";
    if(isset($_GET["wrongpwd"])){
        echo "<small>Mot de passe incorrect</small>";
    }
    echo "</div><button type='submit' name='signin-submit' class='btn btn-signin btn-primary'>Se connecter</button></form></div>";

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

}


require "footer.php";

?>