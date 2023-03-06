<?php
require_once "../model/model.php";
require "common.php";

$comment_id = '';
$comment = '';
$task_id = $_GET['task_id'];

$tasks = get_all_tasks();
$comments = get_all_comments();

if (isset($_POST['submit'])) {
    $comment_id = null;

    /* if (isset($_POST['comment_id'])) {
        $comment_id = $_POST['comment_id'];
    } */


    
    $task_id = trim($_POST['task_id']);
    $comment = trim($_POST['comment']);



    print_r($_POST);
    echo "täällä comment controllerissa";

   

        
         
            if (add_comment($comment_id, $comment, $task_id)) {
                 header('Refresh:2; url=task_list.php');
                    $confirm_message = 'comment added successfully';
                 } else {
                    $error_message = "There's something wrong'";
                }
        
    

}
require "../views/comment.php";
?>