<?php
require_once "../model/model.php";


if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
} else if (isset($_GET['confirm_message'])) {
    $confirm_message = $_GET['confirm_message'];
}


$projects = get_all_projects();
$columnNames = get_project_column_names();
$fileName = 'projects'. time() . '.csv';
$fileContent = "";

foreach ($columnNames as $column) {
        echo $column[0] . "; ";
    }
    echo "\n";
foreach ($projects as $project) {
        
    
    echo $project["project_id"] . "; " . $project["project_title"] . "; " . $project["project_category"] . "; " . "\n";
}




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

echo $fileContent;

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/csv; "); 

?>