<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="./scss/login.scss"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="">
        <div class="grid">
            <div class="grid grid-rows-1 row_1">
                <div class="grid grid-cols-12 row1-cols mt-20 ml-5 mr-5">
                    <div class="col-start-5 col-span-4 row1-col1">
                        <div class="card">
                            <form class="grid grid-rows-4 content-center" method="post" action="action/login.php">
                                <div class="card_header">
                                    Sign In
                                </div>
                                <?php 
                                    if(isset($_GET['error']) && $_GET['error']) {
                                        echo "<div style='width:100%; height: 34px; color:#fff; background-color: #ff375f;text-align: center; padding: 5px 10px;border-radius: 5px;'>" . $_GET['error'] . "</div>";
                                    }
                                ?>
                                <div>
                                    <input type="text" name = "uname" placeholder="Enter User Name" class="input_field"/>
                                </div>
                                <div>
                                    <input type="password" name = "pwd" placeholder="Enter password" class="input_field"/>
                                </div>
                                <div class="flex justify-between">
                                    <div><button class="signIn_btn" name='submit' value='sign'>Sign In</button></div>
                                    <div><button class="forgot_btn" name='submit' value="forgot">Forgot password</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>