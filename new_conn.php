 <?php
    $username = "testuser"; 
    $password = "password";   
    $host = "localhost";
    $database="test";

    $mysqli = new mysqli($host,$username,$password,$database);

    $item = 'Asset Data Model';

    $q1 = "select * from test.objects where name in (select target from test.links where source = '" . $item . "'') or name in (select source from test.links where target = '" . $item . ") or name = '" . $item . "'";

    $myArray = array();
    //if ($result = $mysqli->query("select * from test.objects where name in (select target from test.links where source = 'Asset Data Model') or name in (select source from test.links where target = 'Asset Data Model') or name = 'Asset Data Model'")) {
        if ($result = $mysqli->query("select * from test.objects where name in (select target from test.links where source = 'Asset Data Model') or name in (select source from test.links where target = 'Asset Data Model') or name = 'Asset Data Model'")) {
        $tempArray = array();
        while($row = $result->fetch_object()) {
                $tempArray = $row;
                array_push($myArray, $tempArray);
            }
        echo "{\"nodes\":";
        echo json_encode($myArray);
        echo ",";
    }
    $myArray2 = array();
    if ($result2 = $mysqli->query("select * from links where source = 'Asset Data Model' or target = 'Asset Data Model'")) {
        $tempArray2 = array();
        while($row2 = $result2->fetch_object()) {
                $tempArray2 = $row2;
                array_push($myArray2, $tempArray2);
            }
        echo "\"links\":";
        echo json_encode($myArray2);
        echo "}";
    }




    $result->close();
    $result2->close();
    $mysqli->close();

?>