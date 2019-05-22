<?php 

require 'database/QueryBuild.php';
  if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['tel']) && !empty($_POST['mail']) && !empty($_FILES)) {
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

    if($_FILES['image']['size'] > (5 * 1024 * 1024)) {
    echo "sizeImage";
    return;
    }
    $imageinfo = $_FILES['image']['type'];
    $arr = array('image/jpeg','image/gif','image/png');

    if(in_array($imageinfo , $arr) == 0){
      echo "typeImage";
      return;
    }
     else {
      $data = [];
      $upload_dir = 'image/'; //имя папки с картинками
      $nameImg = $upload_dir.basename($_FILES['image']['name']);
      $mov = move_uploaded_file($_FILES['image']['tmp_name'],$nameImg);
      array_push($data, array('name' => $name, 'mail' => $mail, 'tel' => $tel, 'image' => $nameImg, 'password' => $password));

      $users = $db->searchUserName($data[0]['name']);
      if (empty($users)) {
        $db->addUser($data[0]);
        echo "success";
      }else{
        echo "userNameError";
      }
    }
}else{
    echo "empty";
  }