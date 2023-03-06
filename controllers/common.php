<?php
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}



class Comment {
    public $comment;
    public $task_id;
    public function __construct($comment, $task_id) {
      $this->comment = $comment;
      $this->task_id = $task_id;
    }
  }
?>