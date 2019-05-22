<?php session_start(); 
require "database/QueryBuild.php";

  if (!empty($_POST['name']) && !empty($_POST['password'])) {
    $db = new QueryBuild();
    $user = $db->searchUserName($_POST['name']);
    if (!$user) {
      echo "error";
    }else{
      if (password_verify($_POST['password'], $user['password']) == 1) {
        $_SESSION = [];
        $_SESSION = array_merge($_SESSION, array('user' => array(
              'userName' => $user['name'], 'userEmail' => $user['mail'], 'userTel' => $user['tel'], 'userImage' => $user['image']
            )));
        echo json_encode($_SESSION);
      }else{
        echo "passwordError";
      }
  } 
}else{
  echo "notAllVal";
}
