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






/* function get_json() {
    try {
        global $connection;

      
        $sql = 'SELECT JSON_OBJECT("id", p.id, "title", p.title, "category", p.category, "task_title", t.title, "date", t.date_task) FROM projects AS p RIGHT JOIN tasks AS t ON p.id = t.project_id';

        
        $result = $connection->query($sql);

        return $result;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}
 */




//TASK
function get_all_tasks() {
    try {
        global $connection;

        $sql = 'SELECT tasks.task_id, tasks.task_title, tasks.task_date, tasks.task_time, tasks.project_id, DATE_FORMAT(tasks.task_date, "%d %M %Y"), projects.project_title FROM tasks LEFT JOIN projects ON projects.project_id = tasks.project_id
        ORDER BY projects.project_title ASC';
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

function add_file($attachment, $attachment_id) {
    try {
        global $connection;
        
        if ($attachment_id) {
            $sql = 'UPDATE attachment SET attachment = ? WHERE task_id = ?';
            $statement = $connection->prepare($sql);
            $add_file = array($attachment, $attachment_id);
            $affectedLines = $statement->execute($add_file);
        } else {
            $sql =  'INSERT INTO attachment(attachment, task_id) VALUES(?, ?)';
            $statement = $connection->prepare($sql);
            $add_file = array($attachment, $attachment_id);
            $affectedLines = $statement->execute($add_file);
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
