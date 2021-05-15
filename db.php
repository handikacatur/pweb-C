<?php
$DBHOSTNAME = "mysql:host=localhost;dbname=test";
$UDB = "root";
$PDB = "";

try {
    $connection = new PDO($DBHOSTNAME, $UDB, $PDB);
}catch (PDOException $exception){
    var_dump("DB Error dengan kode" . $exception->getMessage());
}
