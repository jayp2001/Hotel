<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./scss/forgotpwd.scss"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="">
        <div class="grid">
            <div class="grid grid-rows-1 row_1">
                <div class="grid grid-cols-12 row1-cols mt-20 ml-5 mr-5">
                    <div class="col-start-5 col-span-4 row1-col1">
                        <div class="card">
                            <form class="grid grid-rows-3 content-center" action="action/sendPassword.php" method="post">
                                <div class="card_header">
                                    Forgot Password
                                </div>
                                <?php 
                                    if(isset($_GET['error']) && $_GET['error']) {
                                        echo "<div style='width:100%; height: 34px; color:#fff; background-color: #ff375f;text-align: center; padding: 5px 10px;border-radius: 5px;'>" . $_GET['error'] . "</div>";
                                    }
                                ?>
                                <div>
                                    <input type="text" placeholder="Enter Registered Email" class="input_field" name="email"/>
                                </div>
                                <div class="flex justify-between">
                                    <div><button class="signIn_btn">Submit</button></div>
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