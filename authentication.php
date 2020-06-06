<?php
require_once "connex.php";
require_once "classes/PasswordHash.php";

foreach($_POST as $index=>$value){
    $$index = $value;
}
//check username in Database
$sql = "SELECT * FROM montrealtorent.user WHERE userUsername = ?;";
$stmt = $pdo -> prepare($sql);
$stmt -> execute(array($userUsername));

//count number of rows to confirm that only one user is being returned
$count = $stmt -> rowCount();

if ($count==1){
    //check password
    $user = $stmt -> fetchAll();
    $dbPassword = $user[0]['userPassword'];

    $passwordHash = new PasswordHash(null, null);
    if ($passwordHash -> CheckPassword($userPassword, $dbPassword)){
        // create a session
        session_start();
        require_once 'classes/SecureSession.php';

        $ss = new SecureSession();
        $ss -> check_browser = TRUE;
        $ss -> check_ip_block = 3;
        $ss -> secure_word = "j@v@";
        $ss -> regenerate_id = TRUE;
        $ss -> Open();

        $_SESSION['logged_in'] = true;

        header("Location:dashboard.php");

    }else{
        header("Location:index.php?msg=1");
    }
}else{
    header("Location:index.php?msg=1");
}
?>