<?php 
    session_start();
    include "db_conn.php";

    if((isset($_POST['rating']) || isset($_POST['discription'])) && $_POST['submit']) {
        $sql = "INSERT INTO reviews (user,review,rating,hotel_id) VALUES ('$_SESSION[uname]','$_POST[discription]','$_POST[rating]','$_POST[submit]')";
        $result = mysqli_query($conn , $sql);
        // echo $conn->error;
        header("Location: ../view_hotel.php?id=$_POST[submit]");
    } else {
        header("Location: ../home.php");
    }
?>