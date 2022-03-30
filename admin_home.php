<?php 
    session_start();
    include "action/db_conn.php";
                                        
    $getData = "SELECT * FROM hotel";
    $result = mysqli_query($conn , $getData);

    if (isset($_SESSION['uname']) && isset($_SESSION['password']) && (isset($_SESSION['rights']) && $_SESSION['rights'] === '1')) {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <script src="https://cdn.tailwindcss.com"></script>
                <link rel="stylesheet" href="./scss/mainPage.scss"></link>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                <!-- test -->
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script type="text/javascript">
                    function open_file(){
                        document.getElementById('img2').click();
                    }
                    function handleImgChange(){
                        const img = document.getElementById('img2').files[0];
                        document.getElementById('img_preview2').src = window.URL.createObjectURL(img)
                    }

                    function open_img(){
                        document.getElementById('img1').click();
                    }
                    function handleImgUpload(){
                        const img = document.getElementById('img1').files[0];
                        document.getElementById('img_preview').src = window.URL.createObjectURL(img)
                    }
                   $(document).ready(function () {
                    
                        $('.edit_btn').on('click',function(e) {
                            let name = document.getElementById("name_model");
                            let address = document.getElementById("address_model");
                            let contact = document.getElementById("contact_model");
                            let details = document.getElementById("details_model");
                            let image = document.getElementById("img_preview_edit");
                            let hotel = document.getElementById("hotel");
                            clicked_id = this.id;
                            $.ajax('util/editHotelPopUp.php', {
                                type: 'POST',  // http method
                                data: { id: clicked_id },  // data to submit
                                success: function (response) {
                                    let jsonData = JSON.parse(response);
                                    name.value = jsonData.name;
                                    address.value = jsonData.address
                                    contact.value = jsonData.contact
                                    details.value = jsonData.details
                                    hotel.value = jsonData._id
                                    image.src = "data:image;base64," + jsonData.img
                                },
                                error: function () {
                                        console.log("Error Occured");
                                }
                            });
                            
                        });

                        $('.delete_btn').on('click',function (e) {
                            let id = this.value;
                            if(confirm('Are you sure you want to delete this record?')){
                                $.ajax('util/deleteHotel.php', {
                                    type: 'POST',  // http method
                                    data: { id: id },
                                    success: function (response) {
                                        location.reload();
                                    },
                                    error: function () {
                                        console.log("Error Occured")
                                    }
                                });
                            }
                        })
                   });
                </script>
            </head>
            <body>
                <div class="">
                    <div class="navi-bar grid grid-rows-1">
                        <div class="grid grid-cols-12 content-center navi">
                            <div class="col-span-8 flex justify-start gap-7">
                                <a href="#" class="navi-link-active">
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
                    <div class="grid">
                        <div class="grid grid-rows-1 row_1">
                            <div class="grid grid-cols-12 row1-cols mt-20 ml-5 mr-5">
                                <div class="col-start-3 col-span-8 row1-col1">
                                    <div class="table_header">
                                        Hotels
                                    </div>
                                    <?php 
                                        
                                        if (mysqli_num_rows($result) > 0) {
                                           
                                            for($index=1; $index <= mysqli_num_rows($result) ; $index++) {
                                                $row = mysqli_fetch_assoc($result);
                                                echo '
                                                    <div class="table_row grid grid-cols-12 justify-between content-center">
                                                        <div class="col-span-1 rows justify-center">' . $index . '
                                                        </div>
                                                        <div class="col-span-1">
                
                                                        </div>
                                                        <div class="col-span-5 rows" style="text-align: left;">' . $row['name'] . '
                                                        </div>
                                                        <div class="col-span-3 rows" style="text-align: left;">' . $row['country'] . '
                                                        </div>
                                                        <button class="col-span-1 rows edit_btn" id="'. $row['id'] .'" >
                                                            <div class="edit" data-toggle="modal" data-target="#editHotel">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </div>
                                                        </button>
                                                        <button class="col-span-1 rows delete_btn" value="'. $row['id'] .'">
                                                            <i class="fa fa-trash-o"></i>
                                                        </button>
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
                                    <div class="table_footer flex justify-end">
                                        <div><button class="insert_btn" data-toggle="modal" data-target="#addHotel">Add Hotel</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- The Modal -->
                    <div class="modal fade" id="addHotel">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modelTitleAdd">Add Hotel</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="grid grid-rows-1">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-8 col-start-3 imgDiv">
                                            <img class="img_preview" id="img_preview" src="">
                                            <div class="grid"><button class="uploadImg_btn" for="#img1" onclick="open_img()">Upload Image</button></div>
                                            <input type="file" onchange="handleImgUpload()" hidden id="img1" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <form name="hotelDetail">
                                    <div class="grid grid-rows-4">
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Hotel Name</label>
                                                <input type="text" placeholder="Enter Hotel Name" class="input_field" name="hotelName"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Contact Number</label>
                                                <input type="number" placeholder="Enter Contact Number" class="input_field" name="contactNumber"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Address</label>
                                                <textarea rows="3"name="address" class="input_area" name="address" placeholder="Enter Address" form="hotelDetail"></textarea>
                                            </div> 
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Details</label>
                                                <textarea rows="3"name="address" class="input_area" placeholder="Enter Hotel Details" name="details" form="hotelDetail"></textarea>
                                            </div> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <div><button class="insert_btn" data-toggle="modal" data-target="#myModal">Add Hotel</button></div>
                                <button type="button" class="close_btn" data-dismiss="modal">Close</button>
                            </div>
                            
                        </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editHotel">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h4 class="modelTitleEdit">Edit Hotel</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <form name="editHotelForm" method="post" action="action/editHotel.php">
                            <div class="modal-body">
                          
                                <div class="grid grid-rows-1">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-8 col-start-3 imgDiv">
                                            <img class="img_preview" id="img_preview_edit" src="">
                                            <div class="grid"><button class="changeImg_btn" for="#img2" onclick="open_file()">Change Image</button></div>
                                                <input type="file" onchange="handleImgChange()" hidden id="img2" name="image" accept="image/*">
                                                <input type="hidden" name="hotel_id" value="" id="hotel">
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="grid grid-rows-4">
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Hotel Name</label>
                                                
                                                   <input type="text" placeholder="Enter Hotel Name" id="name_model" class="input_field"  name="hotelName"/>
                                                
                                                <!-- <input type="text" placeholder="Enter Hotel Name" class="input_field" name="hotelName"/> -->
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Contact Number</label>
                                                <input type="number" id="contact_model" placeholder="Enter Contact Number" class="input_field" name="contactNumber"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Address</label>
                                                <textarea rows="3"name="address" id="address_model" class="input_area" name="address" placeholder="Enter Address" form="hotelDetail"></textarea>
                                            </div> 
                                        </div>
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-8 col-start-3">
                                                <label>Details</label>
                                                <textarea rows="3"name="address" id="details_model" class="input_area" placeholder="Enter Hotel Details" name="details" form="hotelDetail"></textarea>
                                            </div> 
                                        </div>
                                    </div>
                               
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <div><button class="modelSave_btn" data-toggle="modal" data-target="#myModal" onclick = "jay()">Save</button></div>
                            <button type="button" class="close_btn" data-dismiss="modal">Close</button>
                            </div>
                            </form>
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
        exit();
    }
?>