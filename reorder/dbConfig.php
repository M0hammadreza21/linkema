<?php
    $host = "localhost"; /* Host name */
    $user = "linkemac_mohammadreza"; /* User */
    $password = "pyax}nO-[nYW"; /* Password */
    $dbname = "linkemac_database"; /* Database name */

    $con = mysqli_connect($host, $user, $password,$dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }