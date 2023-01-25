<?php
require_once "../model/model.php";
$jsons = get_json();
$fileName = 'proman'. time() . '.json';
$fileContent = "";


 
/* print_r($jsons); */

/* foreach ($jsons as $json) {
    echo json_encode($json);
} */

foreach ($jsons as $json) {
    echo $json[0] ;
    exit;
}
//for loop foreach 
/* echo json_decode($jsons); */





if (is_writable($fileName)) {

    if(!$fp = fopen($fileName, 'w')) {
        echo "Cannot open file ($fileName)";
        exit;
    }
    if (fwrite($fp, $fileContent) === FALSE) {
        echo "Cannot write to file ($fileName)";
        exit;
    }


    echo $fileContent;
    

    fclose($fp);
}
 
echo $fileContent;

header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=".$fileName);
header("Content-Type: application/json; "); 

?>