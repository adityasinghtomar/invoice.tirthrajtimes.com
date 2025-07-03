<?php 
include('Classes/PHPExcel.php');
include('functions.php');
$columnHeader = "User Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t"; 
$setData = '';  
  

$name = "invoice_".date("d-m-Y");
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=".$name.".xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";   


?>