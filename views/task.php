<?php
if (!empty($_GET['task_id'])) {
    $title = 'Update task';
} else {
    $title = 'Add Task'; 
}

ob_start();
require 'nav.php';
?>

<div class="container">

    <h1><?php echo $title ?></h1>
    <?php

    if (isset($error_message)) {
        echo "<p class='message_error'>$error_message</p>";
    }

    if (isset($confirm_message)) {
        echo "<p class='message_ok'>$confirm_message</p>";
    }
    ?>

    <form method="post" >
        <label for="project">
            <span>Project:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        
        <select name="project_id" id="project_id" required>
            <option value="">Select a project</option>
            <?php foreach ($projects as $project) { ?>
            <option value="<?php echo $project['project_id'] ?>" 
            <?php if ($project_id === $project['project_id']) {echo 'selected';} ?>
            ><?php echo $project['project_title'] ?></option>
            <?php } ?>
        </select>

        <label for="task_title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" placeholder="New task" name="task_title" id="task_title"
        value="<?php echo $task_title; ?>" required>

        <label for="date">
            <span>Date:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="date" name="task_date" id="task_date"
        value="<?php echo $task_date; ?>" required>

        <label for="task_time">
            <span>Time:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="number" name="task_time" id="task_time"
        value="<?php echo $task_time; ?>" required>

        <!-- comment -->
        <label for="comment">
            <span>Comment:</span>
        </label>
       
        <input type="text" class="comment-field" name="comment" id="comment" value="<?php foreach ($comments as $comment) {
                foreach ($tasks as $task) { 
                if ($comment["task_id"] == $task["task_id"]) {
                    echo $comment["comment"];
                }
            }
            } ?> ">



       

        <br><br>

        
        <?php if (!empty($task_id)) { ?>
        <input type="hidden" name="task_id" value="<?php echo $task_id ?>" />
        <?php } ?>
        <input class="button" type="submit"  name="submit"
        value="<?php echo (isset($task_id) and (!empty($task_id))) ? "Update" : "Add";  ?>">
    </form>
    <br><br>

<!-- Attachment form -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h1>Add attachment to your task:</h1>

        <select name="task_id" id="task_id" required>

            <option value="">Select a task</option>

            <?php foreach ($tasks as $task) { ?>
            <option 
                value="<?php echo $task['task_id'] ?>" 
            <?php if ($task_id === $task['task_id']) {echo 'selected';} ?>
            ><?php echo $task['task_title'] ?>
            </option>
            <?php } ?>
        </select>


        <label for="fileToUpload">
           <span>Attachment:</span>
        </label>
        <?php if (!empty($task_id)) { ?>
        <input type="hidden" name="task_id" value="<?php echo $task_id ?>" />
        <?php } ?>
        <input type="file" name="fileToUpload" id="fileToUpload">
            <input class="button" type="submit" value="<?php echo (isset($task_id) and (!empty($task_id))) ? "Update Image" : "Add Image";  ?>" name="submit">
    </form> 
    
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
