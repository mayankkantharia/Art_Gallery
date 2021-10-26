<?php 
    include 'php/db.php'; 
    session_start();
    $myemail = $_SESSION["email"];
    $myname = $_SESSION["name"];
    $result = mysqli_query($con, "SELECT * FROM images WHERE user_email = '$myemail'"); 
    if(isset($_POST["save_pin_name"]) && isset($_POST['image_pin_size'])){ 
        $status = $statusMsg = ''; 
        $status = 'error'; 
        if(!empty($_FILES["image"]["name"])) { 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            $allowTypes = array('jpg','png','jpeg','gif','jfif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image      = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
                $image_size = $_POST['image_pin_size'];
                $title      = $_POST['image_title'];
                $image_desc = $_POST['image_description'];
                $insert = $con->query("INSERT into `images` (`image_id`,`image`,`user_email`,`size`,`title`,`image_desc`) VALUES (NULL,'$imgContent','$myemail','$image_size','$title','$image_desc')"); 
                if($insert){ 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully.";
                    header('location: final_board.php');
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, JFIF & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        } 
    }else{
        $statusMsg = 'Please select all inputs';
    }    
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/modal_styles.css">
    <link rel="stylesheet" href="./styles/pin_styles.css">
    <link rel="stylesheet" href="./styles/final_board.css">
    <link rel="stylesheet" href="./scripts/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./display.php">Art Gallery</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link" href="./final_board.php">My Gallery<span class="sr-only"></span></a>
                    </li>
                </ul>
                <div class="d-flex">
                <div>
                    <h5 class="user_welcome" style="color: cyan; margin-right:30px">
                        Welcome <?php echo $myname ?>
                    </h5>
                </div>
                <div class="my_pin_add">
                    <div class="pin_icon_container add_pin">
                        <img src="./images/add.png" alt="add_pin" class="pin_icon">
                    </div>
                </div>
                <a href="php/logout.php" type="button" class="btn btn-success mr-2" style="text-decoration: none; color:white; margin-left: 30px;" >
                    Logout
                </a>
            </div>
            </div>
        </div>
    </nav>
    <form method="post" action="" enctype="multipart/form-data">
        <div class="pin_container">
            <?php if($result){ ?>             
                <?php while($row = $result->fetch_assoc()){ ?>                  
                    <div class="card card_<?php echo $row['size'];?>" id="card_<?php echo $row['image_id'];?>">
                        <div class="pin_title"><?php echo $row['title']; ?></div>
                        <div class="pin_modal">
                            <div class="modal_foot">
                                <div class="destination">
                                    <div class="pin_icon_container">
                                        <img src="./images/ellipse.png" alt="destination" class="pin_icon">
                                    </div>
                                    <span><?php echo $row['title']; ?></span>
                                </div>
                                <div class="pin_icon_container">
                                    <button class="btn btn-danger" name="delete_image"  value="<?php echo $row['image_id']; ?>">
                                        <i class="fas fa-trash-alt" style="color: white;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="pin_image">
                            <img class="pin_max_width pin_fit_img" id="the_image" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"/>
                        </div>
                    </div>           
                <?php } ?>
            <?php }else{ ?> 
                <p class="status error">Image(s) not found...</p> 
            <?php } ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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
                                            <div>Choosen image will appear here.</div>                                            
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
                                    <input class="btn btn-danger save_pin" name="save_pin_name" id="save_pin_name" type="submit" value="Save">
                                </div>
                            </div>
                            <div class="section2">
                                <input name="image_title" placeholder="Add Your Title" type="text" class="new_pin_input" id="pin_title">
                                <input name="image_description" placeholder="Tell everyone what your image is about" type="text" class="new_pin_input" id="pin_description">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </form> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="scripts/final_board.js"></script>
    <script src="scripts/ajax.js"></script>
    <script>
        $("#save_pin_name").click(function(event) {
            var title    = $("#pin_title").val();
            var pin_size = $("#pin_size").val();
            if(pin_size === null) {
                alert("Please select a size...!");
            }
            else if(title === ""){
                alert("Please give a title...!");                
            }
        });
    </script>
</body>
</html>