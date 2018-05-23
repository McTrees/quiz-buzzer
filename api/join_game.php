<?php
function editfile($data, $file, $line){
$contents = file_get_contents($file);
$contents = str_replace($line, $data, $contents);
file_put_contents($file, $contents);
}
if(isset($_GET["ID"])) {
    $_GET["name"] = strtolower($_GET["name"]);
     if(($handle = fopen("database.csv", "r")) !== FALSE) {
        while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $csv[] = $data;
        }
     }

     fclose($handle);
     foreach ($csv as $index => $row) {
        if($row[0] == $_GET["ID"]) {
            //Find our row
			$oldrow = $row;
            //Check that our nickname isn't taken already
            $names = explode(":", $row[1]);
            if (in_array($_GET["name"], $names)) {
                die("err_name_taken");
            }
            //If it isn't update the CSV
            $row[1] = $row[1] . ":" . $_GET["name"];
            $csv[array_search($row, $csv)] = $row;
            editfile(implode(",",$row), "database.csv", implode(",",$oldrow));
            die("true");
        }
     }
} else {
    echo "400 bad request";
}


?>