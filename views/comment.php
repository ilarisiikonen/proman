<?php

$title = 'Add Comment'; 
$task_title = get_task($_GET['task_id']);

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
        
        <!-- 
            task
            vanhat commentit
            uus commentti + add
         -->
        
        <h2>
            <?php 
            echo $task_title['task_title'];  ?>
        </h2>

     
        <h3>Previous Comments: </h3>
            
        <br>

        <?php 
            foreach ($comments as $comment) {
               if ($comment["task_id"] == $_GET['task_id']) {
               ?> <p><?php echo   $comment["comment"];?> </p> <?php
               }
            }
        ?>

        <br>
        
        <label for="comment">
            <span>comment:</span>
        </label>
        <input type="text" placeholder="New comment" name="comment" id="comment"
        value="" required>

        <br>
        <p>Note: Comments can't be deleted. Think carefully what you write.</p>
        <?php if (!empty($task_id)) { ?>
        <input type="hidden" name="task_id" value="<?php echo $task_id ?>" />
        <?php } ?>
        <input class="button" type="submit"  name="submit"
        value="Add comment">
    
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
