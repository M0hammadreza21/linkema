<?php
if(isset($_GET["messenger_id"]) && !empty($_GET["messenger_id"]) && isset($_GET["profile_id"]) && !empty($_GET["profile_id"])){
// sql to delete a record
$sql = "DELETE FROM messengers WHERE messenger_id =".$_GET["messenger_id"]." AND pid=".$_GET["profile_id"];

if (mysqli_query($conn, $sql)) {
  header("location: creator.php?profile_id=".$_GET["profile_id"]."&action=delete_messenger");
} else {
  echo mysqli_error($conn);
}

mysqli_close($conn);

} else{
        exit();
}
?>