<html>

    
<style>
    /* CSS used here will be applied after bootstrap.css */
.table {
font-size: 11px 
}

body { 
 background: url('lib/assets/edf1.jpg') no-repeat center center fixed; 
 -webkit-background-size: cover;
 -moz-background-size: cover;
 -o-background-size: cover;
 background-size: cover;
}

.panel-default {
 opacity: 0.9;
 margin-top:30px;
}
.form-group.last {
 margin-bottom:0px;
}
</style>    
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="lib/bootstrap/js/bootstrap.js"></script>
    
<!--RUN THE PHP QUERY-->
<?php
$username = "testuser"; 
$password = "password";   
$host = "localhost";
$database="i_dictionary";

/*if((!isset($_POST['itemSearch'])) and (!isset($_POST['descSearch']))) {
    
 header("Location:id_landpage.html");   
}*/
$toSearch = "";
$searchTerm = "";
$sql = "";
if(isset($_POST['itemSearch']))
{
    $toSearch = "i";
    $searchTerm = $_POST['itemSearch'];
    $sql = "SELECT * from i_dictionary.item_dictionary where object_name like '%" . $searchTerm . "%'";
}
else if(isset($_POST['descSearch']))
{
    $toSearch = "d";
    $searchTerm = $_POST['descSearch'];
    $sql = "SELECT * from i_dictionary.item_dictionary where item_description like '%" . $searchTerm . "%'";
}

$conn = mysql_connect($host, $username,     $password);
if(!$conn)
{
    die('Could not connect: ' . mysql_error());   
}

//$sql = 'SELECT object_name, item_description, item_source,item_type_code from i_dictionary.item_dictionary';

mysql_select_db($database);

$retval = mysql_query($sql, $conn);

if(!$retval)
{
    die('Could not get data: ' . mysql_error());   
}
?>
    
<div class="panel panel-default">
    <div class="panel-heading"> <strong class="">Item Dictionary Definitions</strong>
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Object Name</th>
                <th>Object Description</th>
                <th>Source Name</th>
            </tr>
        </thead>
        <tbody>
    
        
<?php

while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $name = wordwrap($row['object_name'],50,"<br />\n");
    $desc = $row['item_description'];
    $source = wordwrap($row['item_source'],70,"<br />\n");
if(($row['item_type_description'] == "Item Dictionary Definition") && ($row['item_type_code'] == "HPC.Item.DataObject"))
   {
       print "<tr>
       <td><a href='itemDetails.php?name=$name&desc=$desc' style='display:block;''>$name</a></td>
       <td>$desc</td>
       <td>$source</td>
       </tr>";
   }

}
?>
        </tbody>
    </table>
    </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading"> <strong class="">Code List Names</strong>

        
            <table class="table table-condensed">
        <thead>
            <tr>
                <th>Object Name</th>
                <th>Object Description</th>
                <th>Source Name</th>
            </tr>
        </thead>
        <tbody>
<?php
$retval = mysql_query($sql, $conn);

while($row2 = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $name = wordwrap($row2['object_name'],50,"<br />\n");
    $desc = $row2['item_description'];
    $source = wordwrap($row2['item_source'],70,"<br />\n");
if($row2['item_type_code'] == "HPC.Item.DataObject.CodeList")
   {
       print "<tr>
       <td><a href='itemdetails.php?name=$name&desc=$desc' style='display:block;''>$name</a></td>
       <td>$desc</td>
       <td>$source</td>
       </tr>";
   }

}
?>
        </tbody>
    </table>
        </div>
        </div>
        
        <div class="panel panel-default">
    <div class="panel-heading"> <strong class="">List of Values</strong>
        
<table class="table table-condensed">
        <thead>
            <tr>
                <th>Object Name</th>
                <th>Object Description</th>
                <th>Source Name</th>
            </tr>
        </thead>
        <tbody>
<?php
$retval = mysql_query($sql, $conn);

while($row3 = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $name = wordwrap($row3['object_name'],50,"<br />\n");
    $desc = $row3['item_description'];
    $source = wordwrap($row3['item_source'],70,"<br />\n");
if($row3['item_type_code'] == "HPC.Item.DataObject.CodeList.Value")
   {
       print "<tr>
       <td><a href='itemDetails.php?name=$name&desc=$desc' style='display:block;''>$name</a></td>
       <td>$desc</td>
       <td>$source</td>
       </tr>";
   }

}
?>
        </tbody>
    </table>
        


    </div>
    </div>

<?php
mysql_close($conn);
?>


</html>