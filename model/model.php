<?php
// model/model.php
require "connection.php";

$connection = db_connect();



//Projects
function get_all_projects() {
    try {
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY id ASC';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_jsons() {
    try {
        global $connection;

        $sql = 'SELECT t.title, category, p.title, date_task FROM projects AS p RIGHT JOIN tasks AS t ON p.id = t.project_id';
        $jsons = $connection->query($sql);

        return $jsons;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
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

        $sql = 'SELECT COUNT(id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_project($id) {
    try {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}




function get_json() {
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





//TASK
function get_all_tasks() {
    try {
        global $connection;

        $sql = 'SELECT tasks.id AS id, tasks.title AS title, tasks.date_task AS Date, tasks.time_task AS Time, tasks.project_id AS Project_ID, DATE_FORMAT(tasks.date_task, "%d %M %Y") AS ttime, projects.title AS Title FROM tasks LEFT JOIN projects ON projects.id = tasks.project_id
        ORDER BY projects.title ASC, tasks.date_task DESC';
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

        $sql = 'SELECT * FROM tasks WHERE date_task = CURDATE() + 2';
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

        $sql = 'SELECT COUNT(id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

//ADD PROJECT
function add_project($title, $category, $id) {
    
    try {
        global $connection;

        if ($id) {
            $sql = 'UPDATE projects SET title = ?, category = ? WHERE id = ?';
        } else {
            $sql = 'INSERT INTO projects(title, category) VALUES(?, ?)'; 
        }
        $statement = $connection->prepare($sql);
        $new_project = array($title, $category);

        if ($id) {
            $new_project = array($title, $category, $id);
        }

        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_task($id)
{
    try {
        global $connection;

        $sql =  'SELECT * FROM tasks WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

//ADD task


function add_task($id, $title, $date, $time, $project_id)
{
    try {
        global $connection;

       
        if ($id) {
            $sql = 'UPDATE tasks SET title = ?, date_task = ?, time_task = ?, project_id = ? WHERE id = ?';
            $statement = $connection->prepare($sql);
            $update_task = array($title, $date, $time, $project_id, $id);
            $affectedLines = $statement->execute($update_task);
        } else {
            $sql =  'INSERT INTO tasks(title, date_task, time_task, project_id) VALUES(?, ?, ?, ?)';
            $statement = $connection->prepare($sql);
            $new_task = array($title, $date, $time, $id);
            $affectedLines = $statement->execute($new_task);
        }

        return $affectedLines;
    } catch (PDOException $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}   


//title exists

function titleExists($table, $title) {
    try {
        global $connection;

        $sql = 'SELECT title FROM ' . $table . ' WHERE title = ?';
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

function delete_task($id) {
    try {
        global $connection;

        $sql = 'DELETE FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}

//DELETE PROJECT

function delete_project($id) {
    try {
        global $connection;

        $sql = 'DELETE FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return true;
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();
        exit;
    }
}
