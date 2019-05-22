<?php session_start();
require "database/QueryBuild.php";

if (isset($_POST['comName']) && isset($_POST['comEmail']) && isset($_POST['comText'])){

	$db = new QueryBuild();
	$data = [];
	$date = $_POST['comDate'];
	$name = trim(htmlspecialchars(strip_tags($_POST['comName'])));

	if (iconv_strlen($name) > 50) {
		echo "nameLenght";
		return;
	}

	$email = trim($_POST['comEmail']);
	if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email)) {
		echo "errorEmail";
		return;
	}

	$text = trim(htmlspecialchars($_POST['comText']));
	if (iconv_strlen($text) > 200) {
		echo "textLenght";
		return;
	}
	 if (!$_SESSION['user']['userName']) {
		$upload_dir = 'image/'; //имя папки с картинками
		$nameImg = $upload_dir.basename($_FILES['comImage']['name']);
		$mov = move_uploaded_file($_FILES['comImage']['tmp_name'],$nameImg);
		array_push($data, array('name' => $name, 'email' => $email, 'text' => $text, 'image' => $nameImg, 'date' => $date));
	  }else{
	 	$nameImg = $_POST['comImage'];
		array_push($data, array('name' => $name, 'email' => $email, 'text' => $text, 'image' => $nameImg, 'date' => $date));
		}

		$data = $db->addComment('comments', $data[0]);
		$count = count($data);
		if ($_SESSION['user']['userName'] == 'admin'){
			$data[$count - 1] = array_merge($data[$count - 1], $_SESSION);
		}else{
			$_SESSION['user']['userName'] = '';
			$data[$count - 1] = array_merge($data[$count - 1], $_SESSION);
		}
		echo json_encode($data[$count - 1]);
}else{

	echo "emptyVars";
}	



