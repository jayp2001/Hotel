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
                <link rel="stylesheet" href="./scss/hotelList.scss"></link>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            </head>
            <body>
                <div class="">
                    <div class="nav-bar grid grid-rows-1">
                        <div class="grid grid-cols-12 content-center nav">
                            <div class="col-span-8 flex justify-start gap-7">
                                <a href="#" class="nav-link-active">
                                    Home
                                </a>
                                <a class="nav-link">
                                    Hotels
                                </a>
                                <a class="nav-link">
                                    Review
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="grid grid-rows-1 row_1">
                            <div class="grid grid-cols-12 row1-cols mt-20 ml-5 mr-5">
                                <div class="col-start-3 col-span-8 row1-col1">
                                    <div class="table_header">
                                        Hotels
                                    </div>

                                    <?php 
                                        include "action/db_conn.php";
                                        
                                        $getData = "SELECT * FROM hotel";
                                        $result = mysqli_query($conn , $getData);

                                        if (mysqli_num_rows($result) > 0) {
                                           
                                            for($index=1; $index <= mysqli_num_rows($result) ; $index++) {
                                                $row = mysqli_fetch_assoc($result);
                                                echo '
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-1 rows justify-center">' . $index . '
                                                        </div>
                                                        <div class="col-span-1">
                
                                                        </div>
                                                        <div class="col-span-6 rows" style="text-align: left;">' . $row['name'] . '
                                                        </div>
                                                        <div class="col-span-3 rows" style="text-align: left;">' . $row['country'] . '
                                                        </div>
                                                        <div class="col-span-1 rows view_detalis">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                        else {
                                            echo '
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-6 col-start-6">
                                                            NO DATA FOUND
                                                        </div>
                                                    </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
        <?php
    }
    else {
        header("Location: index.php");
    }
?>