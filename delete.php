<?php

require "database/QueryBuild.php";

$db = new QueryBuild();
$id = $_POST['id'];
$db->delete('comments', $id);
echo "success";






