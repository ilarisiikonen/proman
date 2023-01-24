<?php

<<<<<<< HEAD
json_object kantaan


=======
global $connection;
$sql = 'SELECT * FROM projects ORDER BY id ASC';
$result = $connection->query($sql);
  
 
$emparray = array();
while($row = $result)
{
    $emparray[] = $row;
}
json_encode($emparray)















/* 
if (is_writable($fileName)) {

    if(!$fp = fopen($fileName, 'w')) {
        echo "Cannot open file ($fileName)";
        exit;
    }
    if (fwrite($fp, $fileContent) === FALSE) {
        echo "Cannot write to file ($fileName)";
        exit;
    }


    echo $fileContent;

    fclose($fp);
}
 */

/*
$fileName = 'proman'. time() . '.json';
$fileContent = "";
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/csv; ");  */

>>>>>>> 4a18ddf71a60d660c10803eb727e6ea0aa8d7236
?>