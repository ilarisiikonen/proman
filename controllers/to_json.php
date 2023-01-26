<?php
require_once "../model/model.php";
?>
<form method="get">
    <input name="project_id">
    <input type="submit">
</form>

<?php

$jsons = get_jsons($_GET['project_id']);

$fileName = 'proman'. time() . '.json';
$fileContent = array();



foreach ($jsons as $json) {
   $fileContent[] = $json;
} 

$file = json_encode($fileContent);


if (is_writable($fileName)) {

    if(!$fp = fopen($fileName, 'w')) {
        echo "Cannot open file ($fileName)";
        exit;
    }
    if (fwrite($fp, $file) === FALSE) {
        echo "Cannot write to file ($fileName)";
        exit;
    }

    echo $file;
    

    fclose($fp);
}
 


echo $file;

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/json; "); 

?>