<?php 

session_start();
include "../action/db_conn.php";
$id = $_POST["id"];                    
$sql = "SELECT * FROM hotel WHERE id='$id'";
$imgSql = "SELECT * FROM image WHERE id='$id'";
$result = mysqli_query($conn , $sql);
// $imgResult = mysqli_query($conn , $imgSql);

if (mysqli_num_rows($result) > 0) {
    // $image = mysqli_fetch_assoc($imgResult);
    for($index=1; $index <= mysqli_num_rows($result) ; $index++) {
        $row = mysqli_fetch_assoc($result);

        
        echo json_encode(array('_id' => $row['id'],'name' => $row['name'] , 'address' => $row['address'] , 'contact' => $row['contact_num'], 'details' => $row['details'],'img' => base64_encode($row['image'])));
    }
}

?>