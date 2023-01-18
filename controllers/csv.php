<?php
require_once "../model/model.php";



if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
} else if (isset($_GET['confirm_message'])) {
    $confirm_message = $_GET['confirm_message'];
}

$projects = get_all_projects();
$columnNames = get_column_names();
$fileName = 'projects'. time() . '.csv';
$fileContent = "";

foreach ($projects as $projects) {
    echo $projects["id"] . "; " . $projects["title"] . "; " . $projects["category"] . "; " . "\n";
}

if (is_writable($fileName)) {

    if(!$fp = fopen($fileName, 'w')) {
        echo "Cannot open file ($fileName)";
        exit;
    }
    if (fwrite($fp, $content) === FALSE) {
        echo "Cannot write to file ($fileName)";
        exit;
    }


    echo $fileContent;

    fclose($fp);
}
echo $columnNames;

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/csv; "); 












/*  $f = fopen($filename, 'w');

 if ($f === false) {
     die('Error opening the file ' . $filename);
 }

 foreach ($projects as $row) {
     fputcsv($f, $row);
 }

fclose($f);
 */


/* 
 require "../views/project_list.php"; */
?>