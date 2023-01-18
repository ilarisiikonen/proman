<?php
require_once "../model/model.php";
require "common.php";

$id = '';
$task_title = '';
$date = '';
$time = '';
$project_id = '';

if (isset($_GET['id'])) {
    list($id, $task_title, $date, $time, $project_id) = get_task($_GET['id']);
}

$projects = get_all_projects();

if (isset($_POST['submit'])) {
    $id = null;

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }

    $id = trim($_POST['id']);
    $project_id = trim($_POST['project_id']);
    $title = trim($_POST['title']);
    $date = trim($_POST['date']);
    $time = trim($_POST['time']);


    if (empty($id) || empty($title) || empty($date) || empty($time)) {
        $error_message = "One or more fields empty";
    } else {

        if (titleExists("tasks", $title) && $id == null) {
            $error_message = "I'm sorry, but looks like " . escape($title) . " already exists";
        } else {
            if (add_task($id, $title, $date, $time, $project_id)) {
                 header('Refresh:4; url=task_list.php');
                 if (!empty($id)) {
                    $confirm_message = escape($title) . ' updated successfully';
                 } else {
                    $confirm_message = escape($title) . ' added successfully';
                 }   
            } else {
             $error_message = "There's something wrong'";
            }
        }
    }
}

require "../views/task.php";