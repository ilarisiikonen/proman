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
    <button class="button" id="showComments" >Show comments</button>

    <!-- if data missing -->
    <?php if ($taskCount == 0) { ?>
        <div>
            <p>You have not yet added any task</p>
            <p><a href='../controllers/tasks.php'>Add task</a></p>
        </div>
    <?php } 

    

    $coms = array();
    foreach ($comments as $comment) {
        array_push($coms, new Comment($comment["comment"], $comment["task_id"]));
    }

    ?>
    

    

    <ul>
        <?php foreach ($tasks as $task) : ?>
        <li class="card">

            <!-- TASK -->
            <h4><?php echo "Title: " . $task["task_title"] . " Task id: " . $task["task_id"] ." (Date: " . $task["task_time"] . ", Project: " . $task["project_id"] .")"; ?></h4>
            
            

            <!-- comment -->
            
            <div class="comments" style="display: none;">
            <h4>Comments: </h4>
                <?php
                foreach ($coms as $comment) {
                    if ($comment->task_id == $task["task_id"]) {
                        echo $comment->comment . "<br>";
                    }
                }
                ?>
            </div>
            
            <a class="button" href="../controllers/comment.php?task_id=<?php echo $task['task_id']; ?>">Add comment</a>

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

<script>
    /* show comments */
    const showComments = document.getElementById('showComments');
    const comments = document.querySelectorAll('.comments');
    
    showComments.addEventListener('click', () => {
        console.log("show comments toggle")
        if (comments[0].style.display === 'none') {
            comments.forEach((comment) => {
                comment.style.display = 'block'
                showComments.innerHTML = "Hide Comments"
            })
            
        } else {
            comments.forEach((comment) => {
                comment.style.display = 'none'
                showComments.innerHTML = "Show Comments"
            })
        }
    })
</script>

<?php
$content = ob_get_clean();
include 'layout.php'
?>