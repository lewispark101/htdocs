<?php
    $username = "testuser"; 
    $password = "password";   
    $host = "localhost";
    $database="test";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    $asset = "Asset Data Model";
    $myquery = "
SELECT * FROM `objects` LIMIT 10";
    $query = mysql_query($myquery);

    $myrels = "
    SELECT * FROM links
    ";
    $myrels = mysql_query($myrels);
    
    if ( ! $query ) {
        die;
        echo mysql_error();
    }

    if ( ! $myrels) {
        die;
        echo mysql_error();
    }
    
    $data = array();

    $reldata = array();
    
    for ($x = 1; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
    }

    for ($x = 1;$x < mysql_num_rows($myrels); $x++) {
        $reldata[] = mysql_fetch_assoc($myrels);
    }
    echo "{\"nodes\":";

    echo json_encode($data);

    echo ",\"links\":";  

    echo json_encode($reldata); 

    echo "}";

     
    mysql_close($server);
?>