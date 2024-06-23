<?php
if (isset($_GET["id"])){
	$id = $_GET["id"];

	$servername = "localhost:3306 ";
	$username = "root";
	$password = "";
    $database = "dictionary_db";

	$connection = new mysqli($servername, $username, $password, $database);

	$sql = "DELETE FROM dictionary_table WHERE id=$id";
	$connection->query($sql);
}

header("location: /Dictionary/list.php");
exit;
?>