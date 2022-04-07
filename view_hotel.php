<?php 
    session_start();
    include "action/db_conn.php";
    if(isset($_POST['hotel_id']) && $_POST['hotel_id'] !== '') {
        $getPwd = "SELECT * FROM hotel WHERE id='$_POST[hotel_id]'";
        $result = mysqli_query($conn , $getPwd);
        $getReview = "SELECT * FROM reviews WHERE hotel_id='$_POST[hotel_id]'";
        $review = mysqli_query($conn , $getReview);
        $getImg = "SELECT * FROM image WHERE id='$_POST[hotel_id]'";
        $img = mysqli_query($conn , $getImg);
        if($result ){
            $row = mysqli_fetch_assoc($result);
        }
        // if($review) {
        //     $reviews = $review
        // }
        ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <link rel="stylesheet" href="./scss/hotelDetails.scss"></link>
                <link rel="stylesheet" href="./scss/profile_logout.scss"></link>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <link href='https://fonts.googleapis.com/css?family' rel='stylesheet'>

                    <!-- test -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

                    <!-- <script type="text/javascript">
                        $(document).ready(function () {
                            $('.insert_btn').on('click',function (e) {
                                alert('jay');
                                // let id = this.value;
                                // $.ajax('addReview.php', {
                                //     type: 'POST',  // http method
                                //     data: { hotel_id: id },
                                //     // success: function (response) {
                                //     //     // location.reload();
                                //     // },
                                //     // error: function () {
                                //     //     console.log("Error Occured")
                                //     // }
                                // });
                            })
                        });
                    </script> -->
            </head>
            <body>
                <div>
                    <div class="navi-bar grid grid-rows-1">
                        <div class="grid grid-cols-12 content-center navi">
                            <div class="col-span-8 flex justify-start gap-7">
                                <?php 
                                    if($_SESSION['rights'] === '1') {
                                        echo '<a href="admin_home.php" class="navi-link">
                                                Home
                                            </a>
                                            <a class="navi-link" href="home.php">
                                                Hotels
                                            </a>
                                            <a  class="navi-link-active">
                                                Hotel
                                            </a>';
                                    }
                                    else {
                                        echo '
                                            <a class="navi-link" href="home.php">
                                                Home
                                            </a>
                                            <a class="navi-link-active">
                                                Hotel
                                            </a>';
                                    }
                                ?>
                            </div>
                            <div class="col-span-3 flex justify-end gap-7">
                                <a href="profile.php">
                                    <div class="profile">
                                     <?php echo '<img class="profile" src="data:image;base64,'.base64_encode($_SESSION['img']).'">'; ?>
                                    </div>
                                </a>
                            </div>
                            <div class="col-span-1 flex justify-end gap-7">
                                <a href="action/logout.php" class="logout">
                                    LOGOUT
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
                                    <?php 
                                        if($review){
                                            for($index=1; $index <= mysqli_num_rows($review) ; $index++) {
                                                $reviews = mysqli_fetch_assoc($review);
                                                echo '<div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-1 rows justify-center">
                                                            '. $index .'
                                                        </div>
                                                        <div class="col-span-1">
                
                                                        </div>
                                                        <div class="col-span-3 rows" style="text-align: left;">
                                                            '. $reviews['user'] .'
                                                        </div>
                                                        <div class="col-span-5 rows" style="text-align: left;">
                                                            '. $reviews['review'] .'
                                                        </div>
                                                        <div class="col-span-2 rows">
                                                            '. $reviews['rating'] .'
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                    ?>
                                    <div class="table_footer flex justify-end">
                                        <form action="addReview.php" method="post"><button class="insert_btn" name="hotel_id" value=<?php echo $row['id']?>>Add Review</button></form>
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
?>