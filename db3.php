<?php
    $username = "testuser"; 
    $password = "password";   
    $host = "localhost";
    $database="test";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    $asset = "Asset Data Model";
    $myquery = "
SELECT * FROM `objects`";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 1; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
?>