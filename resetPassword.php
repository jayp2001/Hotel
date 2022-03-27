<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./scss/resetpwd.scss"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="">
        <div class="grid">
            <div class="grid grid-rows-1 row_1">
                <div class="grid grid-cols-12 row1-cols mt-20 ml-5 mr-5">
                    <div class="col-start-5 col-span-4 row1-col1">
                        <div class="card">
                            <form class="grid grid-rows-5 content-center" action="action/setNewPassword.php" method="post">
                                <div class="card_header">
                                    Reset Password
                                </div>
                                <?php 
                                    if(isset($_GET['error']) && $_GET['error']) {
                                        echo "<div style='width:100%; height: 34px; color:#fff; background-color: #ff375f;text-align: center; padding: 5px 10px;border-radius: 5px;'>" . $_GET['error'] . "</div>";
                                    }
                                ?>
                                <div>
                                    <input type="text" name="current_pwd" placeholder="Enter Your Current Password" class="input_field"/>
                                    <input type="hidden" name="userId" value="user"/>
                                </div>
                                <div>
                                    <input type="password" name="new_pwd" placeholder="Enter New Password" class="input_field"/>
                                </div>
                                <div>
                                    <input type="password" name="confirm_pwd" placeholder="Confirm New Password" class="input_field"/>
                                </div>
                                <div class="flex justify-between">
                                    <div><button name="submit" value="reset" class="signIn_btn">Reset</button></div>
                                    <div><button name="submit" value="cancle" class="forgot_btn">Cancle</button></div>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="table_footer flex justify-end">
                            <div><button class="insert_btn">Add Hotel</button></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>