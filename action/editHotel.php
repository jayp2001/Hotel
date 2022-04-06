<?php 
    session_start();
    include "db_conn.php";
    if(isset($_POST['hotel_id']) && $_POST['hotel_id'] !== '' ) {
        // echo "hello";
        // echo ($_FILES['hotel_image']["name"] === '');
        if ($_FILES['hotel_image']["name"] !== '') {
            $image = $_FILES['hotel_image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image)); 
            $sql = "UPDATE hotel SET name='$_POST[hotelName]',address='$_POST[hotel_address]',contact_num='$_POST[contactNumber]',details='$_POST[details]',image='$imgContent' WHERE id='$_POST[hotel_id]'";
            $result = mysqli_query($conn , $sql);
        } else {

            $sql = "UPDATE hotel SET name='$_POST[hotelName]',address='$_POST[hotel_address]',contact_num='$_POST[contactNumber]',details='$_POST[details]' WHERE id='$_POST[hotel_id]'";
            $result = mysqli_query($conn , $sql);
        }
        if($result) {
            header("Location: ../admin_home.php");
        }
    }
?>