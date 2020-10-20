<?php 
session_start();
require "admin/includes/conn.inc.php";
require "header.php";
$id = $_GET["id"];
$sql = "SELECT * FROM speakers WHERE speaker_id = $id";
$result = $conn->query($sql)->fetch();



echo "<img class='pfp-conf' src='admin/".$result["speaker_pfp"]."' alt='Image de profil'><p>Nom - Prénom: <span class='e-name'>".$result["speaker_name"]." - ".$result["speaker_surname"]."</span></p><p>Compte Linked-In: <span class='e-name'>".$result["speaker_linkedin"]."</span></p>";

require "footer.php";

?>