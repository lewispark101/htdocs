<html>
<body>
<?php
$servername = "localhost";
$username = "testuser";
$password = "password";
$dbname = "test";

$link = mysql_connect($servername, $username, $password);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
$db = mysql_select_db("test",$link);

$result = mysql_query("SELECT * from relations") or die('Could not query');
$json = array();

    if(mysql_num_rows($result)){
            $row=mysql_fetch_assoc($result);
        while($row=mysql_fetch_row($result)){
            //  cast results to specific data types

            $test_data[]=$row;
        }
        $json['testData']=$test_data;
    }



    echo json_encode($json);

mysql_close($link);

?>
</body>
</html>