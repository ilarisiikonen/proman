<?php
require_once "../model/model.php";
require "common.php";

$task_id = '';
$task_title = '';
$task_date = '';
$task_time = '';
$project_id = '';
$comment_id = '';
$comment = '';

if (isset($_GET['task_id'])) {
    list($task_id, $task_title, $task_date, $task_time, $project_id) = get_task($_GET['task_id']);
    /* list($comment_id, $comment, $task_id) = get_comment($_GET['task_id']); */
}

$projects = get_all_projects();
$tasks = get_all_tasks();
/* $comments = get_all_comments(); */



if (isset($_POST['submit'])) {
    $task_id = null;

    if (isset($_POST['task_id'])) {
        $task_id = $_POST['task_id'];
    }


    /* $task_id = trim($_POST['task_id']); */
    $project_id = trim($_POST['project_id']);
    $task_title = trim($_POST['task_title']);
    $task_date = trim($_POST['task_date']);
    $task_time = trim($_POST['task_time']);

    /* $comment = trim($_POST['comment']); */
 

   
    print_r($_POST);
    echo "täällä task controllerissa";

    if (empty($project_id) || empty($task_title) || empty($task_date) || empty($task_time)) {
        $error_message = "One or more fields empty";
    } else {

        if (taskTitleExists("tasks", $task_title) && $task_id == null) {
            $error_message = "I'm sorry, but looks like " . escape($task_title) . " already exists";
        } else {
            if (add_task($task_id, $task_title, $task_date, $task_time, $project_id/* , $comment_id, $comment */)) {
                 header('Refresh:4; url=task_list.php');
                 if (!empty($task_id)) {
                    $confirm_message = escape($task_title) . ' updated successfully';
                 } else {
                    $confirm_message = escape($task_title) . ' added successfully';
                 }   
            } else {
             $error_message = "There's something wrong'";
            }
        }
    }
    



}

require "../views/task.php";