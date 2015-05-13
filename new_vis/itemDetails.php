<html>

    
<style>
    /* CSS used here will be applied after bootstrap.css */
.table {
font-size: 11px 
}

body { 

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

$searchName = $_GET["name"];
$searchDesc = $_GET["desc"];
$sql = "select * from i_dictionary.item_dictionary where object_name = '" . $searchName . "' and item_description like '%" . $searchDesc . "'";


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
    <div class="panel-heading"> <strong class="">Item Details</strong>
    <table class="table table-condensed">
       
        <tbody>
<?php


while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    $itemtypecode = $row['item_type_code'];
    $objectname = $row['object_name'];
    $fieldname = $row['field_name'];
    $itemdesc = $row['item_description'];
    $itemcode = $row['itemcode'];
    $itemsource = $row['item_source'];
    $itemtypedesc = $row['item_type_description'];
    $itemowner = $row['item_owner'];
    $itemstatus = $row['item_status'];
    $statuscomments = $row['status_comments'];
    $datelastmod = $row['date_last_modified'];
    $sourceowner = $row['source_owner'];

       print "
       <tr><td>Item Type Code</td><td>$itemtypecode</td></tr>
       <tr><td>Object Name</td><td>$objectname</td></tr>
       <tr><td>Field Name</td><td>$fieldname</td></tr>
       <tr><td>Item Description</td><td>$itemdesc</td></tr>
       <tr><td>Item Code</td><td>$itemcode</td></tr>
       <tr><td>Item Source</td><td>$itemsource</td></tr>
       <tr><td>Item Owner</td><td><a href='mailto:$itemowner' target='_top'>$itemowner</a></td></tr>
       <tr><td>Item Status</td><td>$itemstatus</td></tr>
       <tr><td>Status Comments</td><td>$statuscomments</td></tr>
       <tr><td>Source Owner</td><td><a href='mailto:$itemowner' target='_top'>$sourceowner</a></td></tr>



       ";
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