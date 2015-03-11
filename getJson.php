<?php
    $username = "vis"; 
    $password = "m0r3f00d";   
    $host = "localhost";
    $database="ldmvis";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);

    $myquery = "
SELECT  `name`, `domain` FROM  `nodes`
";
    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
    
    $data = array();
    
    for ($x = 0; $x < mysql_num_rows($query); $x++) {
        $data[] = mysql_fetch_assoc($query);
        
    }
    
    echo json_encode($data);     
     
    mysql_close($server);
?>

