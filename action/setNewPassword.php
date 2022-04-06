<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    session_start();
    include "db_conn.php";
    if(isset($_POST['submit']) && $_POST['submit'] === 'reset') {
        function validate($data){
            $data = trim($data);
            return $data;
        }

        if(validate($_POST['userId']) === '' || validate($_POST['current_pwd']) === '' || validate($_POST['new_pwd']) === '' || validate($_POST['confirm_pwd']) === '') {
            header ("Location: ../resetPassword.php?error=Please Fill All Fields");
            exit();
        }
        else {
            $userName = validate($_POST['userId']);
            $oldPwd = validate($_POST['current_pwd']);
            $newPwd = validate($_POST['new_pwd']);
            $confirmPwd = validate($_POST['confirm_pwd']);
        }

        $getPwd = "SELECT * FROM user WHERE uname='$userName'";
        $result = mysqli_query($conn , $getPwd);

        if (mysqli_num_rows($result) === 1) {
            $pwd = mysqli_fetch_assoc($result);
            if ($pwd['uname'] === $userName && $pwd['password'] === $oldPwd) {
                if ($newPwd === $confirmPwd) {
                    $updateSql = "UPDATE user SET password='$newPwd' WHERE uname='$userName'";
                    $isUpdate = mysqli_query($conn , $updateSql);
                    if($isUpdate) {
                        $to = $pwd['email'];
                        $subject = "Success";
                        $message = "Your Password has been changed successfully";
                        require("../vendor/autoload.php");
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->SMTPDebug = 1; 
                        $mail->SMTPSecure = 'tls'; 
                        $mail->Host = "tls://smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->Username = "hotel.reviev@gmail.com"; 
                        $mail->Password = "admin1222"; 
                        $mail->Port = 587;
                        $mail->IsHTML(true);
                        $mail->From = "hotel.reviev@gmail.com";
                        $mail->FromName = "ADMIN";
                        $mail->Subject = $subject;
                        $mail->Body = $message;
                        $mail->AddAddress($to);
                        
                        header ("Location: ../index.php");
                        exit();
                    }
                    else{
                        header ("Location: ../resetPassword.php?error=Could not Update Password");
                    exit();
                    }
                }
                else {
                    header ("Location: ../resetPassword.php?error=Please Confirm Password");
                    exit();
                }
            }
            else {
                header ("Location: ../resetPassword.php?error=Please Enter Valid Password");
                exit();
            }
        }
    } else {
        header ("Location: ../profile.php");
        exit();
    }

?>