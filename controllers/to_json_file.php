<?php
require_once "../model/model.php";



$fileName = 'proman'. time() . '.json';
$fileContent = array();

$tasks =  get_all_tasks();
$projects = get_all_projects();

$tasks = array();
$projects = array();

    foreach($projects as $project) {
            array_push($projects, "project id: " . $project['project_id'] . " project title: " . $project['project_title'] . " project category: " . $project['project_category']);
        }
    foreach($tasks as $task) {
        array_push($tasks, "task id: " . $task['task_id'] . " task name: " .  $task['task_title'] . " project name: " . $task['project_id'] .  " date: " . $task['task_date']);
    }



$file = json_encode($projects, JSON_FORCE_OBJECT);


if (is_writable($fileName)) {

    if(!$fp = fopen($fileName, 'w')) {
        echo "Cannot open file ($fileName)";
        exit;
    }
    if (fwrite($fp, $file) === FALSE) {
        echo "Cannot write to file ($fileName)";
        exit;
    }

    echo $file;
    

    fclose($fp);
}
 


echo $file;

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/json; "); 

?>