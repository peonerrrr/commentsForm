<?php session_start();
require "database/QueryBuild.php";
$db = new QueryBuild();
        
        if ($_POST['select'] == 'name') {
        	if ($_SESSION['user']['userName']) {
                $comments = $db->showAll('comments', 'name');
        		$data = array_values(array_merge($comments, $_SESSION));

        	}else{
        		$_SESSION['user']['userName'] = '';
                $comments = $db->showAll('comments', 'name');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}
            	print_r(json_encode($data));
        }else if($_POST['select'] == 'dateAsc'){
        	if ($_SESSION['user']['userName']) {
                $comments = $db->showAll('comments', 'date');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}else{
        		$_SESSION['user']['userName'] = '';
                $comments = $db->showAll('comments', 'date');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}
            	print_r(json_encode($data));
        }else if($_POST['select'] == 'email'){
        	if ($_SESSION['user']['userName']) {
                $comments = $db->showAll('comments', 'email');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}else{
        		$_SESSION['user']['userName'] = '';
                $comments = $db->showAll('comments', 'email');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}
        	print_r(json_encode($data));
        }else if($_POST['select'] == 'dateDesc'){
        	if ($_SESSION['user']['userName']) {
                $comments = $db->showAllDesc('comments', 'date');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}else{
        		$_SESSION['user']['userName'] = '';
                $comments = $db->showAllDesc('comments', 'date');
        		$data = array_values(array_merge($comments, $_SESSION));
        	}
        	print_r(json_encode($data));
        }else {
        	
               $comments = $db->showAllDesc('comments', 'date');
        }
