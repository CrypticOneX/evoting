<?php
    $host = "localhost";
    $user = "ashutosh";
    $password = "123456";
    $db = "evoting";

    $conn = new mysqli($host, $user, $password, $db);

    if (!$conn)
        die("<h1>Error in establishing database connection</h1>");
?>