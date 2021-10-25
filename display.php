<?php 
    include 'php/db.php';
    session_start();
    $myemail = $_SESSION["email"];
    $myname = $_SESSION["name"]; 
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
                <a href="php/logout.php" type="button" class="btn btn-success mr-2"  
                    style="text-decoration: none; color:white; margin-left: 30px;" >
                    Logout
                </a>
            </div>
            </div>
        </div>
    </nav>
    <div class="pin_container">
        <?php if($result->num_rows > 0){ ?>             
            <?php while($row = $result->fetch_assoc()){ ?>
                <div class="card card_<?php echo $row['size'];?> ">
                    <div class="pin_title"><?php echo $row['title']; ?></div>
                    <div class="pin_modal">
                        <div class="modal_foot">
                            <div class="destination">
                                <div class="pin_icon_container">
                                    <img src="./images/upper-right-arrow.png" alt="destination" class="pin_icon">
                                </div>
                                <span><?php echo $row['title']; ?></span>
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
    
