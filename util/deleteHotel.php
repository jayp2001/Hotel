<?php 

session_start();
include "../action/db_conn.php";
$id = $_POST["id"];                    
$sql = "DELETE FROM hotel WHERE id='$id'";
$reviews = "DELETE FROM reviews WHERE hotel_id='$id'";
$images = "DELETE FROM image WHERE id='$id'";
$result = mysqli_query($conn , $reviews);
$result = mysqli_query($conn , $images);
$result = mysqli_query($conn , $sql);

if ($result) {
    echo "success";
}

?>