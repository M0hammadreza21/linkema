<?php 
ob_start();
session_start();
    // Include Connection File 
    require('dbConfig.php');

    $position = $_POST['position'];

    $i=1;
    $p=$_SESSION["profile_id"];

    // Update Orting Data 
    foreach($position as $k=>$v){

        $sql = "Update routing SET position_order=".$i." WHERE pid=".$p." AND routing_id=".$v;

        $con->query($sql);

        $i++;
    }
?>