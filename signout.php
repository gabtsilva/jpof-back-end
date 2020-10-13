<?php
session_start();
require "header.php";

session_destroy();
header("Location:index.php?loggedout");

require "footer.php";
