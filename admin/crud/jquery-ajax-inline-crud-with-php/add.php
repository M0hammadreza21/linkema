<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["username"])) {
	$username = mysql_real_escape_string(strip_tags($_POST["username"]));
	$password = mysql_real_escape_string(strip_tags($_POST["password"]));
  $sql = "INSERT INTO user (username,password) VALUES ('" . $username . "','" . $password . "')";
  $user_id = $db_handle->executeInsert($sql);
	if(!empty($user_id)) {
		$sql = "SELECT * from user WHERE user_id = '$user_id' ";
		$users = $db_handle->runSelectQuery($sql);
	}
?>
<tr class="table-row" id="table-row-<?php echo $users[0]["id"]; ?>">
<td contenteditable="true" onBlur="saveToDatabase(this,'username','<?php echo $users[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $users[0]["username"]; ?></td>
<td contenteditable="true" onBlur="saveToDatabase(this,'password','<?php echo $users[0]["id"]; ?>')" onClick="editRow(this);"><?php echo $users[0]["password"]; ?></td>
<td><a class="ajax-action-links" onclick="deleteRecord(<?php echo $users[0]["id"]; ?>);">Delete</a></td>
</tr>  
<?php } ?>