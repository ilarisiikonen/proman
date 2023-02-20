<?php
if (!empty($_GET['project_id'])) {
    $title = 'Update Project';
} else {
    $title = 'Add Project';
}

ob_start();
require "nav.php";
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

        <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
        <input type="text" placeholder="New project" name="project_title" id="project_title" value="<?php echo $project_title; ?>" required>


        <label for="category">
        <span>Category:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>

        <select name="project_category" id="project_category" required>
            <option value="">Select a category</option>
            <option value="Professional"
            <?php if ($project_category == "Professional") {echo ' selected';} ?>>Professional</option>

            <option value="Personal"
            <?php if ($project_category == "Personal") {echo ' selected';} ?>>Personal</option>
            
            <option value="School"
            <?php if ($project_category == "School") {echo ' selected';} ?>>School</option>
        </select>


        <?php if (!empty($project_id)) { ?>
            <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
        <?php } ?>

        <input type="submit" name="submit" value="<?php echo (isset($project_id) and (!empty($project_id))) ? "Update" : "Add"; ?>" class="submit">


    </form>
</div>


<?php
$content = ob_get_clean();
include 'layout.php';
?>