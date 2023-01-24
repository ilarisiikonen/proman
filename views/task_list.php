<?php
require "common.php";
$title = 'Tasks list';

ob_start();
require 'nav.php';

if (isset($error_message)) {
    echo "<p class='message_error'>$error_message</p>";
}
if (isset($confirm_message)) {
    echo "<p class='message_ok'>$confirm_message</p>";
}
?>

<div class="container">
   

    <h1><?php echo $title . " (" . $taskCount . ")" ?></h1>

    <button><a href="/~e2101365/php/proman/controllers/csv_task.php">Download CSV</a></button>


    <!-- if data missing -->
    <?php if ($taskCount == 0) { ?>
        <div>
            <p>You have not yet added any task</p>
            <p><a href='../controllers/tasks.php'>Add task</a></p>
        </div>
    <?php } ?>

    <ul>
        <?php foreach ($tasks as $task) : ?>
        <li>
            <a href="../controllers/task.php?id=<?php echo $task['id']; ?>">
            <?php
            echo "Title: " . $task["title"] . " (Date: " . $task["ttime"] . ", Project: " . $task["Project_ID"] .")";
            ?> 
            </a>
            <form method="post">
            <input type="hidden" value="<?php echo $task["id"]; ?>" name="delete">
            <input type="submit" value="Delete">
            </form>
                        
        </li>
        <?php endforeach; ?>
    </ul>
</div>


<?php
$content = ob_get_clean();
include 'layout.php'
?>