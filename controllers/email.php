<?php
require_once "../model/model.php";

$to = "e2101365@edu.vamk.fi";
$subject = "Reminder";
$headers = "From: pro.man@proman.fi";
$tasks = get_tasks_reminder();
$text = array();

foreach ($tasks as $task) {
    $text[] = "Title: " . $task["title"] . "\n" . "Date: " . $task["date_task"];
}

 $txt = implode(", ",$text);


function sendEmail($to, $subject, $txt, $headers) {
    if (mail($to, $subject, $txt, $headers)) {
      return true;
    } else {
      return false;
    }
  }


  if (sendEmail($to, $subject, $txt, $headers)) {
          echo "Mail sent!";
  } else {
          echo "Error!";
  }
?>