<html>
<head>  
    <link href="lib/bootstrap/css/bootstrap.min.css"    rel="stylesheet">
    <script src="lib/bootstrap/js/bootstrap.js"></script> 
</head>
<?php
$username = "testuser"; 
$password = "password";   
$host = "localhost";
$database="i_dictionary";

$conn = mysql_connect($host, $username,     $password);
if(!$conn)
{
    die('Could not connect: ' . mysql_error());   
}

$sql = 'SELECT * from i_dictionary.item_dictionary';

mysql_select_db($database);

$retval = mysql_query($sql, $conn);

if(!$retval)
{
    die('Could not get data: ' . mysql_error());   
}

        

while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{   
      echo "Object Name -{$row['object_name']} <br> ";
}

echo "Fetched Data Successfully";
mysql_close($conn);

?>
</html>