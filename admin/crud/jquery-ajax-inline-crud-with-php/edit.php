<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "UPDATE user set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  user_id=".$_POST["id"];
$result = $db_handle->executeUpdate($sql);
?>
