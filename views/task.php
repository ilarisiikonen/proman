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


        

        <br><br>

        
        <?php if (!empty($task_id)) { ?>
        <input type="hidden" name="task_id" value="<?php echo $task_id ?>" />
        <?php } ?>
        <input type="submit"  name="submit"
        value="<?php echo (isset($task_id) and (!empty($task_id))) ? "Update" : "Add";  ?>">
    </form>

  <!-- Attachment form -->

    
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
