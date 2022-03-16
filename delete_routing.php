<?php
if(isset($_GET["routing_id"]) && !empty($_GET["routing_id"]) && isset($_GET["profile_id"]) && !empty($_GET["profile_id"])){

$servername = "localhost";
$username = "linkemac_mohammadreza";
$password = "pyax}nO-[nYW";
$dbname = "linkemac_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM routing WHERE routing_id =".$_GET["routing_id"]." AND pid=".$_GET["profile_id"];

if (mysqli_query($conn, $sql)) {
  header("location: creator.php?profile_id=".$_GET["profile_id"]."&action=delete_routing");
} else {
  echo mysqli_error($conn);
}

mysqli_close($conn);

} else{
        exit();
}
?>