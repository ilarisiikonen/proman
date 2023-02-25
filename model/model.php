<?php
// model/model.php
require "connection.php";

$connection = db_connect();



//Projects
function get_all_projects() {
    try {
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY project_id ASC';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_jsons($project_id) {
    try {
        global $connection;

        $sql = 'SELECT task_title, project_category, project_title, task_date FROM projects RIGHT JOIN tasks ON project_id = tasks.project_id WHERE project_id = ?';
        $jsons = $connection->query($sql);
        $jsons->bindValue(1, $project_id, PDO::PARAM_INT);
        $jsons->execute();

        return $jsons;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_project($id) {
    try {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE project_id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_project_column_names() {
    try {
        global $connection;

        $sql = 'SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = "projects"';
        $columns = $connection->query($sql);

        return $columns;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_tasks_column_names() {
    try {
        global $connection;

        $sql = 'SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = "tasks"';
        $columns = $connection->query($sql);

        return $columns;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}



function get_all_projects_count() {
    try {
        global $connection;

        $sql = 'SELECT COUNT(project_id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}




//TASK
function get_all_tasks() {
    try {
        global $connection;

        $sql = 'SELECT tasks.task_id, tasks.task_title, tasks.task_date, tasks.task_time, tasks.project_id, DATE_FORMAT(tasks.task_date, "%d %M %Y"), projects.project_title FROM tasks LEFT JOIN projects ON projects.project_id = tasks.project_id';
        $tasks= $connection->query($sql);


        return $tasks;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_tasks_reminder() {
    try {
        global $connection;

        $sql = 'SELECT * FROM tasks WHERE task_date = CURDATE() + 2';
        $tasks= $connection->query($sql);


        return $tasks;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}


function get_all_tasks_count() {
    try {
        global $connection;

        $sql = 'SELECT COUNT(task_id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

//ADD PROJECT
function add_project($project_title, $project_category, $project_id) {
    
    try {
        global $connection;

        if ($project_id) {
            $sql = 'UPDATE projects SET project_title = ?, project_category = ? WHERE project_id = ?';
        } else {
            $sql = 'INSERT INTO projects(project_title, project_category) VALUES(?, ?)'; 
        }
        $statement = $connection->prepare($sql);
        $new_project = array($project_title, $project_category);

        if ($project_id) {
            $new_project = array($project_title, $project_category, $project_id);
        }

        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_task($task_id){
    try {
        global $connection;

        $sql =  'SELECT * FROM tasks WHERE task_id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $task_id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}


//ADD task
function add_task($task_id, $task_title, $task_date, $task_time, $project_id)
    {
        try {
            global $connection;
            print_r($_POST);
        
            if ($task_id) {
                $sql = 'UPDATE tasks SET task_title = ?, task_date = ?, task_time = ?, project_id = ? WHERE project_id = ?';
                $statement = $connection->prepare($sql);
                $update_task = array($task_title, $task_date, $task_time, $project_id, $task_id);
                $affectedLines = $statement->execute($update_task);
            } else {
                $sql =  'INSERT INTO tasks(task_title, task_date, task_time, project_id) VALUES(?, ?, ?, ?)';
                $statement = $connection->prepare($sql);
                $new_task = array($task_title, $task_date, $task_time, $project_id);
                $affectedLines = $statement->execute($new_task);
            }


            
            return $affectedLines;
        } catch (PDOException $err) {
            echo $sql . "<br>" . $err->getMessage();
            exit;
        }
    }  

//add task with comment
/* function add_task($task_id, $task_title, $task_date, $task_time, $project_id, $comment_id = null, $comment)
    {
        try {
            global $connection;
            print_r($_POST);
        
            if ($task_id) {
                $sql = 'UPDATE tasks SET task_title = ?, task_date = ?, task_time = ?, project_id = ? WHERE project_id = ?';
                $statement = $connection->prepare($sql);
                $update_task = array($task_title, $task_date, $task_time, $project_id, $task_id);
                $affectedLines = $statement->execute($update_task);
            } else {
                $sql =  'INSERT INTO tasks(task_title, task_date, task_time, project_id) VALUES(?, ?, ?, ?)';
                $statement = $connection->prepare($sql);
                $new_task = array($task_title, $task_date, $task_time, $project_id);
                $affectedLines = $statement->execute($new_task);
            }


            $task_id = $connection->lastInsertId($sql);
            echo "task id: add_task";
            echo $task_id;
            add_comment($comment_id, $comment, $task_id);
            return $affectedLines;
        } catch (PDOException $err) {
            echo $sql . "<br>" . $err->getMessage();
            exit;
        }
    }   */ 




//ATTACHMENT

function get_all_attachment() {
    try {
        global $connection;

        $sql = 'SELECT tasks.task_id, attachment, task_id, tasks.task_title
        FROM attachment 
        LEFT JOIN tasks 
        ON tasks.task_id = attachment.task_id';
        $tasks= $connection->query($sql);


        return $tasks;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

/* COMMENT */
function get_comment($task_id){
    try {
        global $connection;

        $sql =  'SELECT comment FROM comments WHERE task_id = ?';
        $comment = $connection->prepare($sql);
        $comment->bindValue(1, $task_id, PDO::PARAM_INT);
        $comment->execute();

        return $comment->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function get_all_comments() {
    try {
        global $connection;

        $sql = 'SELECT * FROM comments';
        $comments= $connection->query($sql);


        return $comments;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function add_comment($comment_id, $comment, $task_id) {
    try {
        global $connection;
        echo "add_commentissaaaaaaa ";
        print_r($_POST);
        if ($comment_id) {
            $sql = 'UPDATE comments SET comment = ? WHERE task_id = ?';
        } else {
            $sql = 'INSERT INTO comments(comment, task_id) VALUES(?, ?)'; 
        }

        $statement = $connection->prepare($sql);
        $new_comment = array($comment, $task_id);
        $affectedLines = $statement->execute($new_comment);

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
  


function add_file($file_path, $task_id, $attachment_id = null) {
    try {
        global $connection;
        $attachment_data = file_get_contents($file_path);

        if ($attachment_id) {
            $sql = 'UPDATE attachments SET attachment = ? WHERE attachment_id = ?';
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $attachment_data, PDO::PARAM_LOB);
            $statement->bindParam(2, $attachment_id, PDO::PARAM_INT);
        } else {
            $sql = 'INSERT INTO attachments (attachment, task_id) VALUES (?, ?)';
            $statement = $connection->prepare($sql);
            $statement->bindParam(1, $attachment_data, PDO::PARAM_LOB);
            $statement->bindParam(2, $task_id, PDO::PARAM_INT);
        }

        $affectedLines = $statement->execute();

        if ($attachment_id) {
            echo "File updated successfully"; 
        } else {
            echo "File added successfully";
        }

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}





//title exists

function projectTitleExists($table, $title) {
    try {
        global $connection;

        $sql = 'SELECT project_title FROM ' . $table . ' WHERE project_title = ?';
        $statement =$connection->prepare($sql);
        $statement->execute(array($title));

        if ($statement->rowCount() > 0) {
            return true;
        }
    }
    catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

function taskTitleExists($table, $title) {
    try {
        global $connection;

        $sql = 'SELECT task_title FROM ' . $table . ' WHERE task_title = ?';
        $statement =$connection->prepare($sql);
        $statement->execute(array($title));

        if ($statement->rowCount() > 0) {
            return true;
        }
    }
    catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}


//DELETE TASK 

function delete_task($task_id) {
    try {
        global $connection;

        $sql = 'DELETE FROM tasks WHERE task_id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $task_id, PDO::PARAM_INT);
        $task->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

//DELETE PROJECT

function delete_project($project_id) {
    try {
        global $connection;

        $sql = 'DELETE FROM projects WHERE project_id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $project_id, PDO::PARAM_INT);
        $project->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
