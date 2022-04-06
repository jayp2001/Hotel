<?php 
    session_start();
    include "db_conn.php";
    count($_FILES['new_hotel_img']["name"]);
    if(count($_FILES['new_hotel_img']["name"]) === 1) {
        // echo "Success";
        $image = $_FILES['new_hotel_img']['tmp_name'][0];
        $imgContent = addslashes(file_get_contents($image)); 
        $sql = "INSERT INTO `hotel` (`id`, `name`, `contact_num`, `email`, `address`, `country`, `image`, `details`) VALUES (NULL ,'$_POST[hotelName]','$_POST[contactNumber]','$_POST[email]','$_POST[address]','$_POST[country]','$imgContent','$_POST[details]')";
        $result = mysqli_query($conn , $sql);
        if($result){
            
        }
    }
    else if (count($_FILES['new_hotel_img']["name"]) > 1) {
        $image = $_FILES['new_hotel_img']['tmp_name'][0];
        $imgContent = addslashes(file_get_contents($image)); 
        $sql = "INSERT INTO `hotel` (`id`, `name`, `contact_num`, `email`, `address`, `country`, `image`, `details`) VALUES (NULL ,'$_POST[hotelName]','$_POST[contactNumber]','$_POST[email]','$_POST[address]','$_POST[country]','$imgContent','$_POST[details]')";
        $result = mysqli_query($conn , $sql);
        if($result){
            $hotelId = $conn->insert_id;
            foreach($_FILES['new_hotel_img']['name'] as $id=>$val) {
                if($id > 0){
                    $image = $_FILES['new_hotel_img']['tmp_name'][$id];
                    $imgContent = addslashes(file_get_contents($image));
                    $insertImg = "INSERT INTO image(id,img) VALUES ('$hotelId', '$imgContent')";
                    $isInserted = mysqli_query($conn , $insertImg);
                }
            }
            
        }

    }

        // if ($_FILES['hotel_image']["name"] !== '') {
        //     $image = $_FILES['hotel_image']['tmp_name'];
        //     $imgContent = addslashes(file_get_contents($image)); 
        //     $sql = "INSERT INTO hotel SET name='$_POST[hotelName]',address='$_POST[hotel_address]',contact_num='$_POST[contactNumber]',details='$_POST[details]',image='$imgContent' WHERE id='$_POST[hotel_id]'";
        //     $result = mysqli_query($conn , $sql);
        // } else {

        //     $sql = "UPDATE hotel SET name='$_POST[hotelName]',address='$_POST[hotel_address]',contact_num='$_POST[contactNumber]',details='$_POST[details]' WHERE id='$_POST[hotel_id]'";
        //     $result = mysqli_query($conn , $sql);
        // }
        // if($result) {
        //     header("Location: ../admin_home.php");
        // }
?>