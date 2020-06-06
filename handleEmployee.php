<?php
require_once 'StartSession.php';
require_once "connex.php";
require_once "classes/PasswordHash.php";

foreach($_POST as $index => $value){
	$$index = $value;
}

if (isset($_POST['employeeUserId'])){

    $userId = $employeeUserId;
    $sql = "UPDATE montrealtorent.user SET userUsername = ?, userCityId = ? WHERE UserId = ?;";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(array($userUsername, $userCityId, $employeeUserId))){
        $sql = "UPDATE montrealtorent.employee SET employeeName = ?, employeeEmail = ?, employeeBirthday = ?, 
        employeePhone = ?, employeeStreet = ?, employeeAddressComp = ?, employeeZipCode = ?,
        employeeStartDate = ?, employeeEndDate = ?, employeeSalary = ? WHERE employeeUserId = ?;";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute(array($employeeName, $employeeEmail, $employeeBirthday, 
        $employeePhone, $employeeStreet, $employeeAddressComp, $employeeZipCode, 
        $employeeStartDate, $employeeEndDate, $employeeSalary, $employeeUserId))){
            header("Location:listEmployees.php?msg=2");
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
        $employeeUserId = $pdo -> lastInsertId();
        $sql = "INSERT INTO montrealtorent.employee (employeeUserId, employeeName, employeeEmail, employeeBirthday, 
        employeePhone, employeeStreet, employeeAddressComp, employeeZipCode, employeeStartDate, employeeEndDate,
        employeeSalary) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute(array($employeeUserId, $employeeName, $employeeEmail, $employeeBirthday, 
        $employeePhone, $employeeStreet, $employeeAddressComp, $employeeZipCode, 
        $employeeStartDate, $employeeEndDate, $employeeSalary))){
            header("Location:insertEmployee.php?msg=2");
        }else{
            print_r($stmt->errorInfo());
        }
    }else{
        print_r($stmt->errorInfo());
    }
}
        
?>