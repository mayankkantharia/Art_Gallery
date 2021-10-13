
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
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
            $insert = $con->query("INSERT into `images` (image_id,image,user_id) VALUES (NULL,'$imgContent',1)"); 
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
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
    <form  method="post" enctype="multipart/form-data">    
    <div class="pin_container">
            <div class="add_pin_modal">
                <div class="add_pin_container">
                    <div class="side" id="left_side">
                        <div class="section1">
                        <div class="mb-3">
                            
                            <input class="form-control" type="file" id="formFile" name="image" style="width: 370px">
                        </div>
                            <!-- <input type="file" name="image" id="image_choose"> -->
                            <!-- <div class="pin_icon_container">
                                <img src="./images/ellipse.png" alt="" class="pin_icon">
                            </div> -->
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
                           
                            <!-- <input type="file" name="upload_img_db" id="upload_img"> -->
                        </label>

                            <div class="modals_pin">
                                <div class="pin_image">
                                </div>
                            </div>

                        </div>
                        <!-- <div class="section3">
                            <div class="save_from_site">Save From Site</div>
                        </div> -->
                    </div>

                    <div class="side" id="right_side">
                        <div class="section1">
                            <div class="dropdown select_size">
                                <select name="pin_size" id="pin_size" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="" disabled selected>Select</option>
                                <option value="small" >Small</option>
                                <option value="medium" >Medium</option>
                                <option value="large" >Large</option>
                                </select>
                                <!-- <div class="btn btn-danger save_pin">Save</div> -->
                                <input class="btn btn-danger save_pin" name="save_pin_name" type="submit" value="Save">
                            </div>
                        </div>
                        <div class="section2">
                            <input placeholder="Add Your Title" type="text" class="new_pin_input" id="pin_title">
                            <input placeholder="Tell everyone what your image is about" type="text" class="new_pin_input" id="pin_description">
                            <input placeholder="Add a destination link" type="text" class="new_pin_input" id="pin_destination">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="./scripts/final_board.js"></script>
</body>

</html>