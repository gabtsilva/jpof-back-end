<?php 
session_start();
if(isset($_SESSION["token"]) && $_SESSION["isadmin"] == 1){
require "header.php";
require "includes/conn.inc.php";

if($_GET["table"] === "buildings"){
  echo "<div>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item active'>
              <a href='/jpof/admin/'>Accueil</a>
            </li>
            <li class='breadcrumb-item active'>Ajout d'un campus</li>
          </ol>
        </div>
        <h1>Ajout d'un campus</h1>
        <form action='includes/insert.inc.php?table=buildings' method='POST'>
          <div class='form-group'>
            <label for='name-building'>Nom du campus</label>
            <input type='text' class='form-control' id='name-building' name='name-building' required>
          </div>
          <div class='row'>
            <div class='form-group col-9'>
              <label for='street-building'>Adresse</label>
              <input type='text' class='form-control' id='street-building' name='street-building' required>
            </div>
            <div class='form-group col'>
              <label for='number-building'>N°</label>
              <input type='text' class='form-control' id='number-building' name='number-building' required>
            </div>
          </div>
          <div class='row'>
            <div class='form-group col'>
              <label for='cp-building'>Code postal</label>
              <input type='text' class='form-control' id='cp-building' name='cp-building' required>
            </div>
            <div class='form-group col'>
              <label for='city-building'>Ville</label>
              <input type='text' class='form-control' id='city-building' name='city-building' required>
            </div>
          </div>
          <button type='submit' class='btn btn-success'>Ajouter</button>
          <button type='reset' class='btn btn-warning'>Effacer</button>
        </form>";

}elseif($_GET["table"] === "speakers"){
  echo "<div>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item active'>
              <a href='/jpof/admin/'>Accueil</a>
            </li>
            <li class='breadcrumb-item active'>Ajout d'un conférencier</li>
          </ol>
        </div>
        <h1>Ajout d'un conférencier</h1>
        <form action='includes/insert.inc.php?table=speakers' enctype='multipart/form-data' method='POST'>
          <div class='row'>
            <div class='form-group col'>
              <label for='name-conf'>Nom</label>
              <input type='text' class='form-control' id='name-conf' name='name-conf'>
            </div>
            <div class='form-group col'>
              <label for='surname-conf'>Prénom</label>
              <input type='text' class='form-control' id='surname-conf' name='surname-conf'>
            </div>
          </div>
          <div class='row'>
            <div class='form-group col-7'>
              <label for='linkedin-conf'>LinkedIn</label>
              <input type='text' class='form-control' id='linkedin-conf' name='linkedin-conf'>
            </div>
            <div class='form-group col'>
              <label for='pic-conf'>Image de profil</label>
              <input type='file' class='form-control-file' id='pic-conf' name='pic-conf'>
            </div>
          </div>
          <button type='submit' class='btn btn-success'>Ajouter</button>
          <button type='reset' class='btn btn-warning'>Effacer</button>
        </form>";

}elseif($_GET["table"] === "activities"){
  echo "<div>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item active'>
              <a href='/jpof/admin/'>Accueil</a></li>
              <li class='breadcrumb-item active'>Ajout d'une activité</li>
            </ol>
          </div>
          <h1>Ajout d'une activité</h1>
          <form action='includes/insert.inc.php?table=activities' method='POST'>
            <div class='row'><div class='form-group col-8'>
              <label for='activity-name'>Intitulé</label>
              <input type='text' class='form-control' id='activity-name' name='activity-name' required>
            </div>
            <div class='form-group col-4'>
              <label for='event-id'>Événement associé</label>
              <select name='event-id' class='col-auto form-control' required>
                <option disabled selected value> --- </option>";

  $sql = "SELECT * FROM events ORDER BY event_name ASC";
  $result = $conn->query($sql);
  foreach($result as $row){
    echo "<option value='".$row["event_id"]."'>".$row["event_name"]."</option>";
  }
  echo "</select></div></div><div class='row'><div class='form-group col'><label for='activity-name'>Date</label><input type='date' class='form-control' id='activity-name' name='activity-date' required></div><div class='form-group col'><label for='activity-time'>Tranche horaire</label><div class='input-group'><div class='input-group-prepend'><span class='input-group-text' id='basic-addon1'>De</span></div><input required type ='time' min='08:00' max='18:00' class='form-control' name='activity-start'><div class='input-group-prepend'>
  <span class='input-group-text'>À</span>
  </div><input type ='time' min='09:00' max='18:00' class='form-control' name='activity-end' required></div></div></div><div class='form-group'><label for='activity-desc'>Description</label><textarea class='form-control' name ='activity-desc' id='activity-desc' rows='3' required></textarea></div><div class='row'><div class='form-group col'><label for='activity-building'>Implantation</label><select name='activity-building' class='col-auto form-control' required><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM buildings ORDER BY building_name ASC";
  $result = $conn->query($sql);
  foreach($result as $row){
  echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
  }
  echo "</select></div><div class='form-group col'><label for='activity-local'>Local</label><select name='activity-local' class='col-auto form-control' required><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM rooms ORDER BY room_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
  echo "<option value='".$row["room_id"]."'>".$row["room_name"]."</option>";
  }

  echo "</select></div><div class='form-group col'><label for='activity-section'>Département</label><select name='activity-section' class='col-auto form-control' required><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM categories ORDER BY category_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
  echo "<option value='".$row["category_id"]."'>".$row["category_name"]."</option>";
  }

  echo "</select></div></div><div class='form-group'>
  <label for='activity_size'>Nombre de places</label>
  <input required type='text' class='form-control' name='activity-size' value='0' required><small>Laisser sur 0 s'il n'y a pas de limite de places</small></div><div class='form-group'><label for='activity-section'>Conférencier</label><select name='activity-conf' class='col-auto form-control' required><option disabled selected value> --- </option>";

  $sql = "SELECT * FROM speakers ORDER BY speaker_name ASC";
  $result = $conn->query($sql);

  foreach($result as $row){
  echo "<option value='".$row["speaker_id"]."'>".$row["speaker_name"].", ".$row["speaker_surname"]."</option>";
  }

  echo "</select></div><button type='submit' class='btn btn-success'>Ajouter</button><button type='reset' class='btn btn-warning'>Effacer</button></form>";

}elseif($_GET["table"] === "rooms"){
  echo "<div>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item active'>
              <a href='/jpof/admin/'>Accueil</a>
            </li>
            <li class='breadcrumb-item active'>Ajout de local</li>
          </ol>
        </div>
        <h1>Ajout de local</h1>
        <form action='includes/insert.inc.php?table=rooms' method='POST'>
          <div class='form-group row'>
            <div class='col'>
              <label for='name-room'>Numéro du local</label>
              <input type='text' class='form-control' name ='name-room' id='name-room'>
            </div>
            <div class='col'>
              <label for='activity-local'>Implantation</label>
              <select name='activity-local' class='col-auto form-control'>
                <option disabled selected value> --- </option>";

  // SQL rooms request
  $sql = "SELECT * FROM buildings ORDER BY building_name ASC";
  $result = $conn->query($sql);

  // Rooms loop echo
  foreach($result as $row){
  echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
  }

  echo"</select></div></div><div class='form-group'><label for='capacity-room'>Nombre de places assises</label><input type='text' class='form-control' name='capacity-room' id='capacity-room'></div><button type='submit' class='btn btn-success'>Ajouter</button><button type='reset' class='btn btn-warning'>Effacer</button></form>";

}elseif($_GET["table"] === "departments"){
  echo "<div><ol class='breadcrumb'><li class='breadcrumb-item active'><a href='/jpof/admin/'>Accueil</a></li><li class='breadcrumb-item active'>Ajout d'une catégorie</li></ol></div><h1>Ajout d'un département</h1><form action='includes/insert.inc.php?table=departments' method='POST'><div class='form-group'><label for='name-section'>Nom</label><input type='text' class='form-control' id='name-section' name='name-section'></div><div class='form-group'><label for='id-building'>Implantation</label><select name='id-building' class='col-auto form-control'><option disabled selected value> --- </option>";

  // SQL building request
  $sql = "SELECT * FROM buildings ORDER BY building_name ASC";
  $result = $conn->query($sql);

  // Building loop echo
  foreach($result as $row){
  echo "<option value='".$row["building_id"]."'>".$row["building_name"]."</option>";
  }

  // End form echo
  echo "</select></div><div class='row'><div class='form-group col'><label for='num-section'>Téléphone</label><input type='text' class='form-control' id='num-section' name='num-section'></div><div class='form-group col'><label for='mail-section'>Mail de contact</label><input type='e-mail' class='form-control' id='mail-section' name='mail-section'></div></div><button type='submit' class='btn btn-success'>Ajouter</button><button type='reset' class='btn btn-warning'>Effacer</button></form>";

}else if($_GET["table"] === "events"){
  echo "<div>
          <ol class='breadcrumb'>
            <li class='breadcrumb-item active'>
              <a href='/jpof/admin/'>Accueil</a>
            </li>
            <li class='breadcrumb-item active'>Ajout d'un événement</li>
          </ol>
        </div>
        <h1>Ajout d'un événement</h1>
        <form action='insert.php?table=event' method='POST'>
          <div class='row'><div class='form-group col'>
            <label for='event-name'>Intitulé</label>
            <input type='text' class='form-control' id='event-name' name='event-name' required>
          </div>
          <div class='form-group col'>
            <label for='event-date'>Date</label>
            <input type='text' class='form-control' id='event-date' name='event-date' required>
          </div>
        </div>
        <div class='form-group'>
          <label for='event-desc'>Description</label>
          <textarea class='form-control' name ='event-desc' id='event-desc' rows='3' required></textarea>
        </div>
        <div class='form-group'>
          <legend>Activer l'événement par défaut ?</legend>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='event-active' id='event-yes' value='1'>
              <label class='form-check-label' for='event-yes'>Oui</label>
            </div>
            <div class='form-check form-check-inline'>
              <input class='form-check-input' type='radio' name='event-active' id='event-no' value='0' checked>
              <label class='form-check-label' for='event-no'>Non</label>
            </div>
          </div>
          <button type='submit' class='btn btn-success'>Ajouter</button><button type='reset' class='btn btn-warning'>Effacer</button>
        </form>";
}

require "footer.php";
}else{
  header("Location:index.php?error"); 
}
?>