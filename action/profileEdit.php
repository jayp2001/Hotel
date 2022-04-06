<?php 
    session_start();
    include "db_conn.php";

    if(isset($_SESSION["uname"]) && $_POST["submit"] === "save") {
        $userId = $_SESSION['uname'];
        if ($_FILES['profileImg']["name"] !== '') {
            $image = $_FILES['profileImg']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $setData = "UPDATE user SET name='$_POST[name]',email='$_POST[email]',contact_no='$_POST[contact_no]',country='$_POST[country]',img='$imgContent' WHERE uname='$userId'";
        }
        else {
            $setData = "UPDATE user SET name='$_POST[name]',email='$_POST[email]',contact_no='$_POST[contact_no]',country='$_POST[country]' WHERE uname='$userId'";
        }
        $result = mysqli_query($conn , $setData);
        echo $conn -> error;
        header("Location: ../profile.php");
        
    } else {
        header("Location: ../profile.php");
    }
?>