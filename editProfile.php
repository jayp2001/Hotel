<?php 
    session_start();
    include "action/db_conn.php"; 
    $userId = $_SESSION['uname'];       
    $getData = "SELECT * FROM user WHERE uname='$userId'";
    $result = mysqli_query($conn , $getData);
    $row = mysqli_fetch_assoc($result);

    if (isset($_SESSION['uname']) && isset($_SESSION['password']) && isset($_GET['user']) && $_GET['user'] !== '') {
        ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <script src="https://cdn.tailwindcss.com"></script>
                    <link rel="stylesheet" href="./scss/editProfile.scss"></link>
                    <link rel="stylesheet" href="./scss/profile_logout.scss"></link>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                    <script type="text/javascript">
                        function open_file(){
                            document.getElementById('img2').click();
                        }
                        function handleImgChange(){
                            const img = document.getElementById('img1').files[0];
                            document.getElementById('img_preview').src = window.URL.createObjectURL(img)
                        }

                        function open_img(){
                            document.getElementById('img1').click();
                        }
                    </script>
                </head>
                <body>
                    <div class="">
                        <div class="navi-bar grid grid-rows-1">
                            <div class="grid grid-cols-12 content-center navi">
                                <div class="col-span-8 flex justify-start gap-7">
                                     <?php 
                                    if($_SESSION['rights'] === '1') {
                                        echo '
                                            <a href="admin_home.php" class="navi-link">
                                                Home
                                            </a>
                                            <a href="home.php" class="navi-link">
                                                Hotels
                                            </a>';
                                    }
                                    else {
                                        echo '  <a href="home.php" class="navi-link">
                                                Home
                                            </a>';
                                    }
                                ?>
                                </div>
                                <div class="col-span-3 flex justify-end gap-7">
                                
                                </div>
                                <div class="col-span-1 flex justify-end gap-7">
                                    <a href="action/logout.php" class="logout">
                                        LOGOUT
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form action="action/profileEdit.php" enctype="multipart/form-data" method="post">
                            <div class="grid">
                                <div class="grid grid-rows-1">
                                    <div class="grid grid-cols-12">
                                        <div class="flex col-span-8 col-start-3 imgDP justify-center">
                                            <div class="grid content-center">
                                                <div class="dp">
                                                    <?php echo '<img class="img_preview" id="img_preview" src="data:image;base64,'.base64_encode($row['img']).'">';?>
                                                    <div><div class="changeImg" for="#img1" onclick="open_img()" style = "text-align:center">Change</div></div>
                                                    <input type="file" onchange="handleImgChange()" hidden id="img1" name="profileImg" accept="image/*">
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
                                            <div class="col-start-5 col-span-4 row1-col1">
                                                <div class="card">
                                                    <div class="grid grid-rows-5 content-center">
                                                        <div class="card_header">
                                                            Edit Profile
                                                        </div>
                                                        <?php 
                                                            echo '<div>
                                                                    <input type="text" placeholder="Name" name="name" class="input_field" value="'. $row["name"] .'"/>
                                                                </div>
                                                                <div>
                                                                    <input type="text" placeholder="Email" name="email" class="input_field" value="'. $row["email"] .'"/>
                                                                </div>
                                                                <div>
                                                                    <input type="number" placeholder="Contact Number" name="contact_no" class="input_field" value="'. $row["contact_no"] .'"/>
                                                                </div>
                                                                <div>
                                                                    <input type="text" placeholder="Country" name="country" class="input_field" value="'. $row["country"] .'"/>
                                                                </div>';
                                                        ?>
                                                        
                                                        <div class="table_footer flex justify-between">
                                                            <div><button class="saveBtn" name="submit" value="save">Save Changes</button></div>
                                                            <div><button class="cancelBtn" name="submit" value="cancel">Cancel</button></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </body>
            </html>
        <?php
    }
?>