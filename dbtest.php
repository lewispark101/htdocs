<html>
<body>
<?php
$servername = "localhost";
$username = "testuser";
$password = "password";
$dbname = "test";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = "SELECT from_name FROM relations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "source: " . $row["from_name"] . "<br>";
    }
} else {
    echo "0 results";
}
echo $result->num_rows;
$conn->close();
?>
</body>
</html>