<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db = "jpof";

$servername = "vps494300.ovh.net:3306";
$username = "jpof";
$password ="H1anx6*0";
$db = "jpof";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>