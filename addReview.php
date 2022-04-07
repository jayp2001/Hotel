<?php 
    session_start();
    include "action/db_conn.php";
     if(isset($_POST['hotel_id'])){

     
        $getPwd = "SELECT * FROM hotel WHERE id='$_POST[hotel_id]'";
        $result = mysqli_query($conn , $getPwd);
        $getImg = "SELECT * FROM image WHERE id='$_POST[hotel_id]'";
        $img = mysqli_query($conn , $getImg);
        if($result ){
            $row = mysqli_fetch_assoc($result);
        }

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
                        <link rel="stylesheet" href="./scss/review.scss"></link>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    
                            <!-- test -->
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                            <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                    </head>
                    <body>
                        <div>
                            <div class="navi-bar grid grid-rows-1">
                                <div class="grid grid-cols-12 content-center navi">
                                    <div class="col-span-8 flex justify-start gap-7">
                                        <a href="#" class="navi-link">
                                            Home
                                        </a>
                                        <a class="navi-link-active">
                                            Hotel
                                        </a>
                                        <a class="navi-link">
                                            Review
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="grid grid-rows-1 row_1">
                                    <div class="grid grid-cols-12 row1-cols mt-2 ml-5 mr-5">
                                        <div class="col-start-2 col-span-10 row1-col1">
                                            <div class="carouselCard grid grid-cols-12 justify-between">
                                            <div id="carouselExampleControls" class="carousel slide col-span-12" data-ride="carousel" data-interval="4000">
                                                <div class="carousel-inner">
                                                    <?php
                                                        if($row['image']){
                                                            echo '<div class="carousel-item active">
                                                                    <img class="d-block w-100" src="data:image;base64,'.base64_encode($row['image']).'" style="width:100%; height:400px" alt="First slide">
                                                                </div>';
                                                        }
                                                        if($img) {
                                                            for($index=1; $index <= mysqli_num_rows($img) ; $index++) {
                                                                $hotelImg = mysqli_fetch_assoc($img);
                                                                    echo '<div class="carousel-item">
                                                                            <img class="d-block w-100" src="data:image;base64,'.base64_encode($hotelImg['img']).'" style="width:100%; height:400px" alt="Second slide">
                                                                        </div>';
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="height:400px;width: 10%;">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="height:400px;width: 10%;">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                            </div>
                                            <div class="grid grid-cols-12">
                                                <div class="title col-start-5 col-span-4">
                                                    <?php echo $row['name'];?>
                                                </div>
                                            </div>
                                            <div class="table_row grid grid-cols-12 justify-between content-center">
                                                <div class="col-span-3 rows nameField">
                                                    Address 
                                                </div>
                                                <div class="col-span-8 rows" style="text-align: center;">
                                                    <?php echo $row['address'];?>
                                                </div>
                                            </div>
                                            <div class="table_row grid grid-cols-12 justify-between content-center">
                                                <div class="col-span-3 rows nameField">
                                                    Contact Number
                                                </div>
                                                <div class="col-span-8 rows" style="text-align: center;">
                                                    <?php echo $row['contact_num'];?>
                                                </div>
                                            </div>
                                            <div class="table_row grid grid-cols-12 justify-between content-center">
                                                <div class="col-span-3 rows nameField">
                                                    Email
                                                </div>
                                                <div class="col-span-8 rows" style="text-align: center;">
                                                    <?php echo $row['email'];?>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-12">
                                                <div class="title_review col-start-0 col-span-2">
                                                    Reviews
                                                </div>
                                            </div>
                                            <form action="rewiewAdd.php" method="post">
                                                <div class="table_row grid grid-cols-12 justify-between content-center">
                                                    <div class="col-span-3 rows nameField rowTitle" style="text-align: left;">
                                                        Discription
                                                    </div>
                                                    <div class="col-span-3 rows" style="text-align: left;">
                                                        
                                                    </div>
                                                    <div class="col-span-5 rows">
                                                        <input type="text" placeholder="Enter Your Review Discription" class="input_field"/>
                                                    </div>
                                                </div>
                                                <div class="table_row grid grid-cols-12 justify-between content-center">
                                                    <div class="col-span-3 rows nameField rowTitle" style="text-align: left;">
                                                        Rseview
                                                    </div>
                                                    <div class="col-span-3 rows" style="text-align: left;">
                                                        
                                                    </div>
                                                    <div class="col-span-5 rows">
                                                        <select placeholder="Enter User Name" class="input_field form-select">
                                                            <option value="worst" selected>Worst</option>
                                                            <option value="poor">Poor</option>
                                                            <option value="ok">Ok</option>
                                                            <option value="good">Good</option>
                                                            <option value="best">Best</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="table_footer flex justify-end">
                                                    <div><button class="saveBtn">Save</button></div>
                                                    </form>
                                                    <div><button class="cancelBtn">Cancel</button></div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </body>
                </html>
            <?php 
        }
    }
?>