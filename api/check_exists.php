<?php
$csv = "database.csv";
$csv = str_getcsv($csv);
if(isset($_GET["ID"])) {
    $csv = array();

     if(($handle = fopen("database.csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $csv[] = $data;
        }
     }

     fclose($handle);
     foreach ($csv as $row) {
        if($row[0] == $_GET["ID"]) {
            echo "true";
            die();
        }
     }
     echo "false";
     die();
} else {
    echo "400 bad request";
    die();
}
?>