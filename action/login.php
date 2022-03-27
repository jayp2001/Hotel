<?php 
    session_start();
    include "db_conn.php";

    if(isset($_POST['submit']) && $_POST['submit'] === 'forgot') {
        header ("Location: ../forgetPassword.php");
        exit();
    }
    else {
        if(isset($_POST['uname']) && isset($_POST['pwd'])) {
            function validate($data){
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        }
    
        $username = validate($_POST['uname']);
        $userpassword = validate($_POST['pwd']);
    
        if(empty($username)){
            header ("Location: ../index.php?error=user name is require");
            exit();
        }
        if(empty($userpassword)){
            header ("Location: ../index.php?error=password is require");
            exit();
        }
    
        $sql = "SELECT * FROM user WHERE uname='$username' AND password='$userpassword'";
    
        $result = mysqli_query($conn , $sql);
        if (mysqli_num_rows($result) === 1) {
    
            $row = mysqli_fetch_assoc($result);
    
            if ($row['uname'] === $username && $row['password'] === $userpassword) {
                $_SESSION['uname'] = $row['uname'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['rights'] = $row['rights'];
                
                if($row['rights'] === '0'){
                    header ("Location: ../home.php");
                    exit();
                }
                else if($row['rights'] === '1') {
                    header ("Location: ../admin_home.php");
                    exit();
                }
                else {
                    header ("Location: ../index.php?error=Invalid User Name");
                    exit();
                }
            }
            else {
                header ("Location: ../index.php?error=Invalid User Name");
                exit();
            }
            
        }
        else {
            header ("Location: ../index.php?error=Invalid Username/Password");
            exit();
        }
    }
?>