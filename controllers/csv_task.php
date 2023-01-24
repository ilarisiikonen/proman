<?php
require_once "../model/model.php";


if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
} else if (isset($_GET['confirm_message'])) {
    $confirm_message = $_GET['confirm_message'];
}


$tasks = get_all_tasks();
$columnNames = get_tasks_column_names();
$fileName = 'tasks'. time() . '.csv';
$fileContent = "";

foreach ($columnNames as $column) {
        echo $column[0] . "; ";
    }
    echo "\n";
foreach ($tasks as $task) {
        
    
    echo $task["id"] . "; " . $task["title"] . "; " . $task["Date"] . "; " . $task["ttime"] . "; " . $task["Project_ID"] . "\n";
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