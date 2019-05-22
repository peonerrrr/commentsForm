<?php session_start(); 
require "database/QueryBuild.php";

  if (!empty($_POST['name']) && !empty($_POST['password'])) {
    $db = new QueryBuild();
    $user = $db->searchUser($_POST['name'], $_POST['password']);
    if (!$user) {
      echo "error";
    }else{
      $_SESSION = [];
      $_SESSION = array_merge($_SESSION, array('user' => array(
            'userName' => $_POST['name'] 
          )));
      echo json_encode($_SESSION);
  } 
}else{
  echo "notAllVal";
}
