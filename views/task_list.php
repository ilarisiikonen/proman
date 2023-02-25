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



    <button class="button"><a href="/~e2101365/php/proman/controllers/csv_task.php">Download CSV</a></button>
    <button class="button"><a href="/~e2101365/php/proman/controllers/to_json.php?tasks">Download JSON</a></button>


    <!-- if data missing -->
    <?php if ($taskCount == 0) { ?>
        <div>
            <p>You have not yet added any task</p>
            <p><a href='../controllers/tasks.php'>Add task</a></p>
        </div>
    <?php } ?>

    <ul>
        <?php foreach ($tasks as $task) : ?>
        <li class="card">

            <!-- TASK -->
            <h4><?php echo "Title: " . $task["task_title"] . " (Date: " . $task["task_time"] . ", Project: " . $task["project_id"] .")"; ?></h4>
            
            

            <!-- comment -->
            
                
            
                <?php 
                    foreach ($comments as $comment) {
                        if ($comment["task_id"] == $task["task_id"]) {
                            if ($comment["comment"] != "") {
                               ?><p><?php echo $comment["comment"]/*  . "\n" */; ?></p><?php 
                            }
                            
                        } 
                    } 
                ?> 
            
               
                
                
            
            
                
            
        


            <!-- Edit -->
            <a class="button" href="../controllers/task.php?task_id=<?php echo $task['task_id']; ?>">Edit task</a>




            <form method="post">   
            <!-- delete -->
            <input type="hidden" value="<?php echo $task["task_id"]; ?>" name="delete">
            <input class="button" type="submit" value="Delete">
            </form>
                        
        </li>
        <?php endforeach; ?>
    </ul>
</div>


<?php
$content = ob_get_clean();
include 'layout.php'
?>