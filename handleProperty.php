<?php
require_once 'StartSession.php';
require_once "connex.php";

foreach($_POST as $index => $value){
	$$index = $value;
}

if (isset($_POST['propertyId'])){
        $sql = "UPDATE montrealtorent.property SET propertyBedrooms = ?, propertyBathrooms = ?, propertyArea = ?, 
                propertyDescription = ?, propertyStreet = ?, propertyZipCode = ?, propertyAddressComp = ?, 
                propertyPrice = ?, propertyTypeId = ? WHERE propertyId = ?;";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute(array($propertyBedrooms, $propertyBathrooms, $propertyArea, $propertyDescription, 
                $propertyStreet, $propertyZipCode, $propertyAddressComp, $propertyPrice, $propertyTypeId, $propertyId))){
                header("Location:listProperties.php?msg=2");
        }else{
                print_r($stmt->errorInfo());
        }
}
else{
        $sql = "INSERT INTO montrealtorent.property (propertyBedrooms, propertyBathrooms, propertyArea, 
                propertyDescription, propertyStreet, propertyZipCode, propertyAddressComp, 
                propertyPrice, propertyTypeId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);

        if($stmt->execute(array($propertyBedrooms, $propertyBathrooms, $propertyArea, $propertyDescription, 
                $propertyStreet, $propertyZipCode, $propertyAddressComp, $propertyPrice, $propertyTypeId))){
                header("Location:insertProperty.php?msg=1");
        }else{
                print_r($stmt->errorInfo());
        }
}

?>