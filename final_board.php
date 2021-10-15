<?php 
// Include the database configuration file  
require_once 'php/db.php'; 
 
// Get image data from database 
$result = $con->query("SELECT * FROM images"); 
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/modal_styles.css">
    <link rel="stylesheet" href="./styles/pin_styles.css">
    <link rel="stylesheet" href="./styles/final_board.css">
</head>

<body>
    <div class="navigation_bar">
        <div class="pin_icon_container add_pin">
            <img src="./images/add.png" alt="add_pin" class="pin_icon">
        </div>
    </div>    
    <!-- <form action="php/final_board_upload.php" method="post" enctype="multipart/form-data"> -->
    <form method="post" action="" enctype="multipart/form-data">
        <div class="pin_container">
            <?php if($result->num_rows > 0){ ?>             
                <?php while($row = $result->fetch_assoc()){ ?> 
                    <!-- <h1  ><?php echo $row['size']; ?> </h1> -->
                    <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" height="300" width="300"/>    -->
                    <div class="card card_<?php echo $row['size'];?> ">
                        <div class="pin_title"><?php echo $row['title']; ?></div>
                        <div class="pin_modal">
                            <div class="modal_head">
                                <div class="save_card">Save</div>
                            </div>
                            <div class="modal_foot">
                                <div class="destination">
                                    <div class="pin_icon_container">
                                        <img src="./images/upper-right-arrow.png" alt="destination" class="pin_icon">
                                    </div>
                                    <span><?php echo $row['image_desc']; ?></span>
                                </div>
                                <div class="pin_icon_container">
                                    <img src="./images/send.png" alt="send" class="pin_icon">
                                </div>
                                <div class="pin_icon_container">
                                    <img src="./images/ellipse.png" alt="dot" class="pin_icon">
                                </div>
                            </div>
                        </div>
                        <div class="pin_image ">
                            <img class="pin_max_width pin_fit_img" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"/>
                        </div>
                    </div>            
                <?php } ?>
            <?php }else{ ?> 
                <p class="status error">Image(s) not found...</p> 
            <?php } ?>
        
            <div class="add_pin_modal">
                <div class="add_pin_container">
                    <div class="side" id="left_side">
                        <div class="section1">
                            <div class="mb-3">
                                <input class="form-control" type="file" id="formFile" name="image" style="width: 370px">
                            </div>
                        </div>
                        <div class="section2">
                            <label for="upload_img" id="upload_img_label">
                                <div class="upload_img_container">
                                    <div id="dotted_border">
                                        <div class="pin_icon_container">
                                            <img src="./images/up-arrow.png" alt="upload_img" class="pin_icon">
                                        </div>
                                        <div>Choose an image to Upload</div>
                                        <div id="recommendation">Recommendation: Use high-quality .jpg files less than 20 mb.</div>
                                    </div>
                                </div>
                            </label>
                            <div class="modals_pin">
                                <div class="pin_image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="side" id="right_side">
                        <div class="section1">
                            <div class="dropdown select_size">
                                <select name="image_pin_size" id="pin_size" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="" disabled selected>Select</option>
                                <option value="small" >Small</option>
                                <option value="medium" >Medium</option>
                                <option value="large" >Large</option>
                                </select>
                                <!-- <div class="btn btn-danger save_pin">Save</div> -->
                                <input class="btn btn-danger save_pin" name="save_pin_name" id="save_pin_name" type="submit" value="Save">
                            </div>
                        </div>
                        <div class="section2">
                            <input name="image_title" placeholder="Add Your Title" type="text" class="new_pin_input" id="pin_title">
                            <input name="image_description" placeholder="Tell everyone what your image is about" type="text" class="new_pin_input" id="pin_description">
                            <!-- <input placeholder="Add a destination link" type="text" class="new_pin_input" id="pin_destination"> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./scripts/final_board.js"></script>
    <script>
        $("#save_pin_name").click(function(event) {
            var title    = $("#pin_title").val();
            var pin_size = $("#pin_size").val();
            if(pin_size === ""){
                alert("Please select a size...!");
            }
            else if(title === ""){
                alert("Please give a title...!");                
            }
            else
            {
                <?php 
                    // Include the database configuration file  
                    require_once 'php/db.php';                    
                    // If file upload form is submitted 
                    $status = $statusMsg = ''; 
                    if(isset($_POST["save_pin_name"])){ 
                        $status = 'error'; 
                        if(!empty($_FILES["image"]["name"])) { 
                            // Get file info 
                            $fileName = basename($_FILES["image"]["name"]); 
                            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                            // Allow certain file formats 
                            $allowTypes = array('jpg','png','jpeg','gif','jfif'); 
                            if(in_array($fileType, $allowTypes)){ 
                                $image      = $_FILES['image']['tmp_name']; 
                                $imgContent = addslashes(file_get_contents($image)); 
                                $image_size = $_POST['image_pin_size'];
                                $title      = $_POST['image_title'];
                                $image_desc = $_POST['image_description'];
                                $insert = $con->query("INSERT into `images` (`image_id`,`image`,`user_email`,`size`,`title`,`image_desc`) VALUES (NULL,'$imgContent','mak@gmail.com','$image_size','$title','$image_desc')"); 
                                if($insert){ 
                                    $status = 'success'; 
                                    $statusMsg = "File uploaded successfully."; 
                                }else{ 
                                    $statusMsg = "File upload failed, please try again."; 
                                }  
                            }else{ 
                                $statusMsg = 'Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed to upload.'; 
                            } 
                        }else{ 
                            $statusMsg = 'Please select an image file to upload.'; 
                        } 
                    }                    
                    // Display status message 
                    // echo $statusMsg; 
                ?>
            }
        })
    </script>
</body>
</html>