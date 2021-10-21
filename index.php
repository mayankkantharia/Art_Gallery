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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Art Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/normalize.css">
    <link rel="stylesheet" href="./styles/modal_styles.css">
    <link rel="stylesheet" href="./styles/pin_styles.css">
    <link rel="stylesheet" href="./styles/final_board.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="">Welcome To Art Gallery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container-fluid" >
            <div></div>
            <div>
                <a href="login.html" type="button" class="btn btn-success mr-2">Login</a>
                <a href="signup.html" type="button" class="btn btn-success mr-2">SignUp</a>
            </div>
        </div>
    </nav>
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
                                <span><?php echo $row['title']; ?></span>
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
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
    
