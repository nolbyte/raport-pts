<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
define("RESMI", "OK");

if(!isset($_SESSION['admID'])){
  header("Location: login.php");
}

require('../config/database.php');
require('../config/fungsi.php');
require('../config/gump.class.php');

if(isset($_GET['mod'])){
  $mod = sanitasi($_GET['mod']);
  $hal = sanitasi($_GET['hal']);

  include('modul/' . $mod . '/' . $hal . '.php');
}