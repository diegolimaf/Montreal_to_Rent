<?php
session_start();
require_once 'classes/SecureSession.php';

$ss = new SecureSession();
$ss -> check_browser = TRUE;
$ss -> check_ip_block = 3;
$ss -> secure_word = "j@v@";
$ss -> regenerate_id = TRUE;

if (!$ss -> Check())
{
    header("location:index.php");
}
?>