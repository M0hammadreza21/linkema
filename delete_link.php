<?php
if(isset($_GET["link_id"]) && !empty($_GET["link_id"]) && isset($_GET["profile_id"]) && !empty($_GET["profile_id"])){

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
$sql = "DELETE FROM links WHERE link_id =".$_GET["link_id"]." AND pid=".$_GET["profile_id"];

if (mysqli_query($conn, $sql)) {
  header("location: creator.php?profile_id=".$_GET["profile_id"]."&action=delete_link");
} else {
  echo mysqli_error($conn);
}

mysqli_close($conn);

} else{
        exit();
}
?>