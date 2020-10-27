<?php 
session_start();
if(isset($_SESSION["token"])){
require "../header.php";

echo "<div>
        <ol class='breadcrumb'>
          <li class='breadcrumb-item active'>Accueil</li>
        </ol>
      </div>
      <div class='list-group-flush'>
        <a href='data-manage.php?table=events' class='list-group-item list-group-item-action'>Événements</a>
        <a href='data-manage.php?table=activities' class='list-group-item list-group-item-action'>Activités</a>
        <a href='data-manage.php?table=rooms' class='list-group-item list-group-item-action in'>Locaux</a>
        <a href='data-manage.php?table=buildings' class='list-group-item list-group-item-action'>Campus</a>
        <a href='data-manage.php?table=departments' class='list-group-item list-group-item-action'>Départements</a>
        <a href='data-manage.php?table=speakers' class='list-group-item list-group-item-action'>Conférenciers</a>
      </div>";
require "../footer.php";
}else{
  header("Location:../sign.php?set=signin");
}
?>