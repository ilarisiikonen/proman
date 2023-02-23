DROP TABLE IF EXISTS attachments, comments, tasks, projects; 

CREATE TABLE projects (
    project_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    project_title VARCHAR(100) NOT NULL UNIQUE,
    project_category VARCHAR(100) NOT NULL
);

CREATE TABLE tasks (
    task_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    task_title VARCHAR(100) NOT NULL UNIQUE,
    task_date DATE NOT NULL,
    task_time INT(3) NOT NULL,
    project_id INT(11) NOT NULL,
    CONSTRAINT fk_tas_pro
        FOREIGN KEY (project_id)
        REFERENCES projects(project_id)
        ON DELETE CASCADE
);

CREATE TABLE attachments (
    attachment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    attachment LONGBLOB NOT NULL,
    task_id INT(11) NOT NULL,
    CONSTRAINT fk_att_pro
        FOREIGN KEY (task_id)
        REFERENCES tasks(task_id)
        ON DELETE CASCADE
);


CREATE TABLE comments (
    comment_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(144) NOT NULL,
    task_id INT(11) NOT NULL,
    CONSTRAINT fk_com_pro
        FOREIGN KEY (task_id)
        REFERENCES tasks(task_id)
        ON DELETE CASCADE
);
