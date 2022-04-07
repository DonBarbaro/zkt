<?php
$conn = new mysqli( "mysql", "root", "root");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}else{
mysqli_set_charset($conn,"utf8");
}
$db_selected = mysqli_select_db($conn, 'firma');

if(!$db_selected){
    $sql = 'CREATE DATABASE firma';

    if(mysqli_query($conn,$sql)){
        mysqli_select_db($conn, 'firma');
        $database = 'database.sql';
        $templines = '';
        $lines = file($database);
        foreach ($lines as $line){
            if(substr($line,0,2) == '--' || $line == ''){
                continue;
            }
            $templines .= $line;
            if(substr(trim($line),-1,1) == ';'){
                mysqli_query($conn,$templines) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
                $templines = '';
            }
        }
        echo "Tables imported successfully";
    }
    else{
        echo "Error creating database: " . mysqli_error($conn) . "\n";
    }
}
else{
    $dbname = "firma";
    $conn = mysqli_connect("mysql", "root", "root", "firma");

    if(!$conn){
        die("Connection failed: ".mysqli_connect_error());
    }
}
?>