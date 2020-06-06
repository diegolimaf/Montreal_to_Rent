<?php
require_once 'StartSession.php';
require_once "connex.php";
require_once "classes/PasswordHash.php";

foreach($_POST as $index => $value){
	$$index = $value;
}

if (isset($_POST['clientUserId'])){
    $userId = $clientUserId;
    $sql = "UPDATE montrealtorent.user SET userUsername = ?, userCityId = ? WHERE UserId = ?;";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(array($userUsername, $userCityId, $clientUserId))){
        $sql = "UPDATE montrealtorent.client SET clientName = ?, clientEmail = ?, clientBirthday = ?, 
        clientPhone = ?, clientStreet = ?, clientAddressComp = ?, clientZipCode = ? 
        WHERE clientUserId = ?;";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute(array($clientName, $clientEmail, $clientBirthday, 
        $clientPhone, $clientStreet, $clientAddressComp, $clientZipCode, $clientUserId))){
            header("Location:listClients.php?msg=2");
        }else{
            print_r($stmt->errorInfo());
        }
    }else{
        print_r($stmt->errorInfo());
    }
}
else{
    $passwordHash = new PasswordHash(null, null);
    $hashedPassword = $passwordHash -> HashPassword($userPassword);

    $sql = "INSERT INTO montrealtorent.user (userUsername, userPassword, userCityId, userPrivilegeId) VALUES (?, ?, ?, ?);";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(array($userUsername, $hashedPassword, $userCityId, $userPrivilegeId))){
        $clientUserId = $pdo -> lastInsertId();
        $sql = "INSERT INTO montrealtorent.client (clientUserId, clientName, clientEmail, clientBirthday, 
        clientPhone, clientStreet, clientAddressComp, clientZipCode) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute(array($clientUserId, $clientName, $clientEmail, $clientBirthday, 
        $clientPhone, $clientStreet, $clientAddressComp, $clientZipCode))){
            header("Location:insertclient.php?msg=2");
        }else{
            print_r($stmt->errorInfo());
        }
    }else{
        print_r($stmt->errorInfo());
    }
}
        
?>