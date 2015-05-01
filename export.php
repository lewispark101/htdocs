<?php

$username = "testuser"; 
$password = "password";   
$host = "localhost";
$database="i_dictionary";
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('object_name', 'item_type_code'));

// fetch the data
mysql_connect($host, $username, $password);
mysql_select_db($database);
$rows = mysql_query("SELECT object_name,item_type_code from i_dictionary.item_dictionary where object_name like '%epfm%'");

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);

?>