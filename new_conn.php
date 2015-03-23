 <?php
    $username = "testuser"; 
    $password = "password";   
    $host = "localhost";
    $database="i_dictionary";

    $mysqli = new mysqli($host,$username,$password,$database);

    $item = 'Asset Data Model';
    $source = 'Asset Data Model';
    $q1 = "select * from test.objects where name in (select target from test.links where source = ?) or name in (select source from test.links where target = ?) or name = ?";

    $myarray = array();
    $stmt = $mysqli->stmt_init();
    if ($stmt->prepare("select * 
        from i_dictionary.item_dictionary 
        where object_name in 
            ( select object_name 
            from item_dictionary 
            where item_type_code = 'HPC.Item.Relationship' 
            and field_name = ? 
            ) 
        or object_name in 
            ( select field_name 
            from item_dictionary 
            where object_name = ? 
            and item_type_code = 'HPC.Item.Relationship' 
            ) 
        and item_type_code = 'HPC.Item.DataObject'
        and item_source = ?
        or item_type_code = 'HPC.Item.DataSource' and object_name = ?"
        )){
        $temparray = array();
        $stmt->bind_param("ssss",$item,$item,$item,$item);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_object()) {
            $temparray = $row;
            array_push($myarray, $temparray);
        }
        echo "{\"nodes\":";
        echo json_encode($myarray);
        echo ",";
    }

    $myarray2 = array();
    $stmt2 = $mysqli->stmt_init();
    if ($stmt2->prepare("select * from i_dictionary.item_dictionary where field_name = ? or object_name = ? and item_type_code = 'HPC.Item.Relationship'")){
        $temparray2 = array();
        $stmt2->bind_param("ss",$item,$item);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        while($row2 = $result2->fetch_object()) {
            $temparray2 = $row2;
            array_push($myarray2, $temparray2);
        }
        echo "\"links\":";
        echo json_encode($myarray2);
        echo "}";
    }

    $result->close();
    $result2->close();
    $mysqli->close();

?>