<?php 
    session_start();

    if (isset($_SESSION['uname']) && isset($_SESSION['password'])) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <script src="https://cdn.tailwindcss.com"></script>
                    <link rel="stylesheet" href="./scss/profile.scss"></link>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                </head>
                <body>
                    <div class="">
                        <div class="navi-bar grid grid-rows-1">
                            <div class="grid grid-cols-12 content-center navi">
                                <div class="col-span-8 flex justify-start gap-7">
                                    <a href="#" class="navi-link">
                                        Home
                                    </a>
                                    <a class="navi-link">
                                        Hotels
                                    </a>
                                    <a class="navi-link">
                                        Review
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php 
                            include "action/db_conn.php";      
                             $userId = $_SESSION['uname'];       
                            $getData = "SELECT * FROM user WHERE uname='$userId'";
                            $result = mysqli_query($conn , $getData);
                            $row = mysqli_fetch_assoc($result);
                            if (mysqli_num_rows($result) === 1) {
                                $_SESSION['img'] = $row['img'];
                                echo '
                                    <div class="grid">
                                        <div class="grid grid-rows-1">
                                            <div class="grid grid-cols-12">
                                                <div class="flex col-span-8 col-start-3 imgDP justify-center">
                                                    <div class="grid content-center">
                                                        <div class="dp">
                                                            <img class="img_preview" id="img_preview" src="data:image;base64,'.base64_encode($row['img']).'">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid">
                                        <div class="grid grid-rows-1 row_1">
                                            <div class="grid grid-cols-12 row1-cols ml-5 mr-5">
                                                <div class="col-start-4 col-span-6 row1-col1">
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-5 rows nameField">
                                                            Name 
                                                        </div>
                                                        <div class="col-span-7 rows" style="text-align: center;">
                                                            ' . $row['name'] . '
                                                        </div>
                                                    </div>
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-5 rows nameField">
                                                            Email 
                                                        </div>
                                                        <div class="col-span-7 rows" style="text-align: center;">
                                                            ' . $row['email'] . '
                                                        </div>
                                                    </div>
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-5 rows nameField">
                                                            Contact Number 
                                                        </div>
                                                        <div class="col-span-7 rows" style="text-align: center;">
                                                            ' . $row['contact_no'] . '
                                                        </div>
                                                    </div>
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-5 rows nameField">
                                                            Country 
                                                        </div>
                                                        <div class="col-span-7 rows" style="text-align: center;">
                                                            ' . $row['country'] . '
                                                        </div>
                                                    </div>
                                                    <form action="action/profileAction.php" method="post">
                                                        <div class="table_footer flex justify-between">
                                                            <input type="hidden" name="user" value=' . $row['uname'] . '/>
                                                            <div><button class="resetPwd" name="submit" value="resetPwd">Reset Password</button></div>
                                                            <div><button class="editProfile" name="submit" value="editProfile">Edit Profile</button></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';

                            }
                            // else{
                            //     header ("Location: home.php");
                            //     exit();
                            // }
                        ?>

                        <!-- <div class="grid">
                            <div class="grid grid-rows-1">
                                <div class="grid grid-cols-12">
                                    <div class="flex col-span-8 col-start-3 imgDP justify-center">
                                        <div class="grid content-center">
                                            <div class="dp">
                                                <img class="img_preview" id="img_preview" src="data:image/jpeg;base64,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">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid">
                            <div class="grid grid-rows-1 row_1">
                                <div class="grid grid-cols-12 row1-cols ml-5 mr-5">
                                    <div class="col-start-4 col-span-6 row1-col1">
                                        <div class="table_row grid grid-cols-12 justify-between content-center">
                                            <div class="col-span-5 rows nameField">
                                                Name 
                                            </div>
                                            <div class="col-span-7 rows" style="text-align: center;">
                                                Jay Parmar
                                            </div>
                                        </div>
                                        <div class="table_row grid grid-cols-12 justify-between content-center">
                                            <div class="col-span-5 rows nameField">
                                                Email 
                                            </div>
                                            <div class="col-span-7 rows" style="text-align: center;">
                                                jay.parmar@gmail.com
                                            </div>
                                        </div>
                                        <div class="table_row grid grid-cols-12 justify-between content-center">
                                            <div class="col-span-5 rows nameField">
                                                Contact Number 
                                            </div>
                                            <div class="col-span-7 rows" style="text-align: center;">
                                                9825312229
                                            </div>
                                        </div>
                                        <div class="table_row grid grid-cols-12 justify-between content-center">
                                            <div class="col-span-5 rows nameField">
                                                Country 
                                            </div>
                                            <div class="col-span-7 rows" style="text-align: center;">
                                                India
                                            </div>
                                        </div>
                                        <form action="action/profileAction.php" method="post">
                                            <div class="table_footer flex justify-between">
                                                <input type="hidden" name="user" value='jay'/>
                                                <div><button class="resetPwd" name="submit" value="resetPwd">Reset Password</button></div>
                                                <div><button class="editProfile" name="submit" value="editProfile">Edit Profile</button></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </body>
            </html>
        <?php
    }
?>