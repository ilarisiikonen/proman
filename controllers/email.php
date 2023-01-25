<?php




function db_connect() {
  try {
      $host = "mariadb.vamk.fi";
      $username = "e2101365";
      $password = "DMwn29xmsfe";
      $dbname = "e2101365_proman";
      $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

      $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
  } catch (PDOException $err) {
      echo "Database connection error. <br>" . $err->getMessage();
      exit;
  }
  return $connection;
}





function get_tasks_reminder() {
  try {
      $connection = db_connect();

      $sql = 'SELECT * FROM tasks WHERE date_task = CURDATE() + 2';
      $tasks= $connection->query($sql);


      return $tasks;
  } catch (PDOException $err) {
      echo $sql . "<br>" . $err->getMessage();
      exit;
  }
}

$to = "e2101365@edu.vamk.fi";
$subject = "Reminder";
$headers = "From: pro.man@proman.fi";
$tasks = get_tasks_reminder();
$text = array();

foreach ($tasks as $task) {
    $text[] = "Title: " . $task["title"] . "\n" . "Date: " . $task["date_task"];
}

 $txt = implode(", ", $text);


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
  if (sendEmail($to, $subject, $txt, $headers)) {
          echo "Mail sent!";
  } else {
          echo "Error!";
  }
?>