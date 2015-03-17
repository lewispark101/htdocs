 <?php
    $username = "testuser"; 
    $password = "password";   
    $host = "localhost";
    $database="test";

    $mysqli = new mysqli($host,$username,$password,$database);

    $item = 'Asset Data Model';

    $q1 = "select * from test.objects where name in (select target from test.links where source = ?) or name in (select source from test.links where target = ?) or name = ?";

    $myarray = array();
    $stmt = $mysqli->stmt_init();
    if ($stmt->prepare("select * from test.objects where name in (select target from test.links where source = ?) or name in (select source from test.links where target = ?) or name = ?")){
        $temparray = array();
        $stmt->bind_param("sss",$item,$item,$item);
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
    if ($stmt2->prepare("select * from links where source = ? or target = ?")){
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


    /*if ($result = $mysqli->query("select * from test.objects where name in (select target from test.links where source = 'Asset Data Model') or name in (select source from test.links where target = 'Asset Data Model') or name = 'Asset Data Model'")) {
        if ($result = $mysqli->query("select * from test.objects where name in (select target from test.links where source = 'Asset Data Model') or name in (select source from test.links where target = 'Asset Data Model') or name = 'Asset Data Model'")) {
        $tempArray = array();
        while($row = $result->fetch_object()) {
                $tempArray = $row;
                array_push($myArray, $tempArray);
            }
        echo "{\"nodes\":";
        echo json_encode($myArray);
        echo ",";
    } */
  /*  $myArray2 = array();
    if ($result2 = $mysqli->query("select * from links where source = 'Asset Data Model' or target = 'Asset Data Model'")) {
        $tempArray2 = array();
        while($row2 = $result2->fetch_object()) {
                $tempArray2 = $row2;
                array_push($myArray2, $tempArray2);
            }
        echo "\"links\":";
        echo json_encode($myArray2);
        echo "}";
    } */




    $result->close();
    $result2->close();
    $mysqli->close();

?>