<?php
require_once "../model/model.php";

$tasks =  get_all_tasks();
$projects = get_all_projects();

$tasks = array();
$projects = array();

    foreach($projects as $project) {
            array_push($projectsArray, "project id: " . $project['project_id'] . " project title: " . $project['project_title'] . " project category: " . $project['project_category']);
        }
    foreach($tasks as $task) {
        array_push($tasksArray, "task id: " . $task['task_id'] . " task name: " .  $task['task_title'] . " project name: " . $task['project_id'] .  " date: " . $task['task_date']);
    }

    
/* 
    if(empty($tasks) || empty($projects)) {
        echo 'No items found';
        exit;
    }
 */

        if(isset($_GET['tasks'])) {
            echo json_encode($tasksArray, JSON_FORCE_OBJECT);
        } else if(isset($_GET['projects'])) {
            echo json_encode($projectsArray, JSON_FORCE_OBJECT);
        } else {
            echo 'No items found';
            exit;
        }


?>