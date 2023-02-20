<?php
require_once "../model/model.php";
require "common.php";


$project_title = '';
$project_category = '';

if (isset($_GET['project_id'])) {
    list($project_id, $project_title, $project_category) = get_project($_GET['project_id']);
}

$projects = get_all_projects();

if (isset($_POST['submit'])) {
    $project_id = null;

    if (isset($_POST['project_id'])) {
        $project_id = $_POST['project_id'];
    }


    $project_title = escape(trim($_POST['project_title']));
    $project_category = escape($_POST['project_category']);

    if (empty($project_title) || empty($project_category)) {
        $error_message = "Title or project_category empty";
        
    } else {
        if (projectTitleExists("projects", $project_title) && $project_id == null) {
            $error_message = "I'm sorry, but looks like \"" . $project_title . "\" already exists";
        } else {
            if (add_project($project_title, $project_category, $project_id)) {
                header('Refresh:4; url=project_list.php');
                if (!empty($project_id)) {
                    $confirm_message = escape($project_title) . ' updated succesfully';
                } else {
                    $confirm_message = escape($project_title) . ' added succesfully';
                }
            } else {
                $error_message = "There's something wrong'";
            }
        }
    }
}

require "../views/project.php"
?>


