<?php
require_once "../model/model.php";

$tasks =  get_all_tasks();
$projects = get_all_projects();

$tasksArr = array();
$projectsArr = array();

    foreach($projects as $project) {
            array_push($projectsArr, "project id: " . $project['project_id'] . " project title: " . $project['project_title'] . " project category: " . $project['project_category']);
        }
    foreach($tasks as $task) {
        array_push($tasksArr, "task id: " . $task['task_id'] . " task name: " .  $task['task_title'] . " project id: " . $task['project_id'] .  " date: " . $task['task_date']);
    }


        if(isset($_GET['tasks'])) {
            echo json_encode($tasksArr, JSON_FORCE_OBJECT);
        } else if(isset($_GET['projects'])) {
            echo json_encode($projectsArr, JSON_FORCE_OBJECT);
        } else {
            echo 'No items found';
            exit;
        }


?>