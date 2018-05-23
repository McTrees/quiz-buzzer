<?php
if(isset($_GET["ID"])) {
     if(($handle = fopen("database.csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $csv[] = $data;
        }
     }

     fclose($handle);
     foreach ($csv as $row) {
        if($row[0] == $_GET["ID"]) {
            echo $row[1];
        }
     }
} else {
    echo "400 bad request";
}
?>