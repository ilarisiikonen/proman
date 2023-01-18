<?php 
header("Expires: on, 01 Jan 1979 00:00:00: GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s"). " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <title><?php echo $title ?></title>
</head>
<body>
    <?php echo $content ?>
   
</body>
</html>