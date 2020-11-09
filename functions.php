<?php
  global $error;
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $url = explode("/",$_SERVER['QUERY_STRING']);
  $page = $url[0];

  require_once 'database.php';

   if ($_POST) {
     $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
     if ($_POST['call_function']) {
       call_user_func($_POST['call_function']);
     }

   }
?>
