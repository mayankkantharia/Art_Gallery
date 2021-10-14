<?php 
// Include the database configuration file  
require_once 'db.php'; 
 
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
        <div class="pin_container">
        
        <?php if($result->num_rows > 0){ ?> 
        <!-- <div class="gallery">  -->
            
            <?php while($row = $result->fetch_assoc()){ ?> 
            <!-- <h1  ><?php echo $row['size']; ?> </h1> -->
            
            <!-- <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" height="250" width="300" />  -->
            
<!-- <div>
    <div class="card">
        <div class="card_small">
            <div class="pin_max_width">
            <div class="pin_title"><?php $row['title']; ?></div>
                    <div class="pin_modal">
                        <div class="modal_head">
                            <div class="save_card">Save</div>
                        </div>
                        <div class="modal_foot">
                            <div class="destination">
                                <div class="pin_icon_container">
                                    <img src="./images/upper-right-arrow.png" alt="destination" class="pin_icon">
                                </div>
                                <span><?php $row['image_desc']; ?></span>
                            </div>
                            <div class="pin_icon_container">
                                <img src="./images/send.png" alt="send" class="pin_icon">
                            </div>
                            <div class="pin_icon_container">
                                <img src="./images/ellipse.png" alt="" class="pin_icon">
                            </div>
                        </div>
                    </div>
                    <div class="pin_image">         
                    </div>

            </div>
        </div>
    </div>

</div> -->



            <script>        
                const new_pin = document.createElement('DIV');
                const new_image = new Image();
                new_image.src = "data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>";
                new_pin.style.opacity = 0;
                new_image.onload = function() {
                    new_pin.classList.add('card');
                    new_pin.classList.add('card_<?php $row['size'];?>');
                    new_image.classList.add('pin_max_width');
                    new_pin.innerHTML = `<div class="pin_title"><?php $row['title']; ?></div>
                    <div class="pin_modal">
                        <div class="modal_head">
                            <div class="save_card">Save</div>
                        </div>
                        <div class="modal_foot">
                            <div class="destination">
                                <div class="pin_icon_container">
                                    <img src="./images/upper-right-arrow.png" alt="destination" class="pin_icon">
                                </div>
                                <span><?php $row['image_desc']; ?></span>
                            </div>
                            <div class="pin_icon_container">
                                <img src="./images/send.png" alt="send" class="pin_icon">
                            </div>
                            <div class="pin_icon_container">
                                <img src="./images/ellipse.png" alt="" class="pin_icon">
                            </div>
                        </div>
                    </div>
                    <div class="pin_image">         
                    </div>`;

                    document.querySelector('.pin_container').appendChild(new_pin);
                    new_pin.children[2].appendChild(new_image);

                    if (new_image.getBoundingClientRect().width >= new_image.getBoundingClientRect().height) {
                        new_image.classList.remove('pin_max_width');
                        new_image.classList.add('pin_fit_img');
                    } else
                    if (new_image.getBoundingClientRect().width < new_image.parentElement.getBoundingClientRect().width || new_image.getBoundingClientRect().height < new_image.parentElement.getBoundingClientRect().height) {
                        new_image.classList.remove('pin_max_width');
                        new_image.classList.add('pin_max_height');
                    }
                }
                new_pin.style.opacity = 1;
            </script>



        <?php } ?>
           
        <!-- </div>  -->
        <?php }else{ ?> 
            <p class="status error">Image(s) not found...</p> 
        <?php } ?>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </body>
    </html>
    <!-- <script src="./scripts/final_board.js"></script> -->
    
