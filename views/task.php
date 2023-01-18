<?php
if (!empty($_GET['id'])) {
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

    <form method="post">
        <label for="project">
            <span>Project:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>

        <select name="project_id" id="project_id" required>
            <option value="">Select a project</option>
            <?php foreach ($projects as $project) { ?>
            <option value="<?php echo $project['id'] ?>" 
            <?php if ($project_id === $project['id']) {echo 'selected';} ?>
            ><?php echo $project['title'] ?></option>
            <?php } ?>
        </select>
        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" placeholder="New task" name="title" id="title"
        value="<?php echo $task_title; ?>" required>

        <label for="date">
            <span>Date:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="date" name="date" id="date"
        value="<?php echo $date; ?>" required>

        <label for="time">
            <span>Time:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="number" name="time" id="time"
        value="<?php echo $time; ?>" required>

        
        <?php if (!empty($id)) { ?>
        <input type="hidden" name="id" value="<?php echo $id ?>" />
        <?php } ?>
        <input type="submit" name="submit"
        value="<?php echo (isset($id) and (!empty($id))) ? "Update" : "Add";  ?>">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
