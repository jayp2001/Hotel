<?php 

session_start();
include "../action/db_conn.php";
$id = $_POST["id"];                    
$sql = "DELETE FROM hotel WHERE id='$id'";

$result = mysqli_query($conn , $sql);

if ($result) {
    echo "success";
}

?>