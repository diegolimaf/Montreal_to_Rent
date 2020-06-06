<?php
require_once 'StartSession.php';
require_once "connex.php";

foreach($_POST as $index => $value){
	$$index = $value;
}

$sql = "INSERT INTO montrealtorent.contract (contractClientId, contractPropertyId, contractStart, 
        contractEnd, contractPrice) VALUES (?, ?, ?, ?, ?);";
$stmt = $pdo->prepare($sql);

if($stmt->execute(array($contractClientId, $contractPropertyId, $contractStart, 
                    $contractEnd, $contractPrice))){
    header("Location:insertContract.php?msg=1");
}else{
	print_r($stmt->errorInfo());
}

?>