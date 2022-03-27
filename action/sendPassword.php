<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    session_start();
    include "db_conn.php";
    function validate($data){
        $data = trim($data);
        return $data;
    }
    
    if(validate($_POST['email']) === '') {
        header ("Location: ../forgetPassword.php");
        exit();
    }
    else {
        $userEmail = validate($_POST['email']);
    }
    $sql = "SELECT * FROM user WHERE email='$userEmail'";
    $result = mysqli_query($conn , $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $password = $row['password'];
        $from = 'jay.m.parmar2001@gmail.com';
        $to = $userEmail;
        $subject = "Your Password";
        $message = "Your forgotten password is :- " . $password;
        require("../vendor/autoload.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "tls://smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "hotel.reviev@gmail.com"; // Enter your email here
        $mail->Password = "admin1222"; //Enter your passwrod here
        $mail->Port = 587;
        $mail->IsHTML(true);
        $mail->From = "hotel.reviev@gmail.com";
        $mail->FromName = "ADMIN";
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($to);
        if (!$mail->Send()) {
            header ("Location: ../forgetPassword.php?error=Unable to send Email");
            exit();
        } else {
            header ("Location: ../index.php");
            exit();
        }
    }
    else {
        header ("Location: ../forgetPassword.php?error=Email is not registered");
        exit();
    }
?>