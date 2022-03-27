<?php 
    session_start();
    include "db_conn.php";

    if(isset($_POST['submit']) && isset($_POST['user']) && !($_POST['user'] === '') && $_POST['submit'] === 'resetPwd') {
        $userToPass = $_POST['user'];
        header ("Location: ../resetPassword.php?user=$userToPass");
        exit();
    }
    else if (isset($_POST['submit']) && isset($_POST['user']) && !($_POST['user'] === '') && $_POST['submit'] === 'editProfile'){
        $userToPass = $_POST['user'];
        header ("Location: ../editProfile.php?user=$userToPass");
        exit();
    }
    else {
        header ("Location: ../profile.php");
        exit();
    }