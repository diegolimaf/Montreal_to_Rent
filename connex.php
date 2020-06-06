<?php

$username = "montrealtorent";
$password = "Fk33W1jR8!!2"; //localhost password

if($pdo = new PDO('mysql:host=den1.mysql3.gear.host; dbname = montrealtorent', $username, $password)){
    //echo "connected!";
}
else{
    echo "Not connected";
}

$pdo -> exec("set names utf8")
?>