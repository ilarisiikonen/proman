<?php
require "common.php";
$title = 'Projects list';

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
    

    <h1><?php echo $title . " (" . $projectCount . ")" ?></h1>


    <button><a href="/~e2101365/php/proman/controllers/csv.php">Download CSV</a></button>
    <button><a href="/~e2101365/php/proman/controllers/to_json.php?projects">Download JSON</a></button>

    <!-- if data missing -->
    <?php if ($projectCount == 0) { ?>
        <div>
            <p>You have not yet added any project</p>
            <p><a href='../controllers/projects.php'>Add project</a></p>
        </div>
    <?php } ?>

    <ul>
        <?php foreach ($projects as $project) : ?>
        <li>
            <a href="../controllers/project.php?project_id=<?php echo $project['project_id']; ?>">
                <?php echo escape($project["project_title"]) ?>
            </a>

            <form method="post">
            <input type="hidden" value="<?php echo $project["project_id"]; ?>" name="delete">
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