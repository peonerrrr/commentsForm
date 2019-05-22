<?php 

require 'database/QueryBuild.php';
  if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['tel']) && !empty($_POST['mail'])) {
    $db = new QueryBuild();
    $name = trim(htmlspecialchars(strip_tags($_POST['name'])));


    $mail = trim($_POST['mail']);
    if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail)) {
      echo 'mailError';
      return;
    }

    $tel = trim($_POST['tel']);
    if (!preg_match("/^[0-9]/", $tel)) {
      echo 'telError';
      return;
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  
    $data = ['name' => $name, 'mail' => $mail, 'tel' => $tel, 'password' => $password];
    $users = $db->searchUserName($data['name']);
    if (empty($users)) {
      $db->addUser($data);
      echo "success";
    }else{
      echo "userNameError";
    }
  }else{
    echo "empty";
  }