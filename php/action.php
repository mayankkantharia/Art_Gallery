<?php

session_start();
include "db.php";

if (isset($_POST["removeImage"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM images WHERE image_id = '$remove_id'";
	}
	if(mysqli_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Image is deleted</b>
				</div>";
		exit();
	}
}

if(isset($_POST["page"])){
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con,$sql);
	$count = mysqli_num_rows($run_query);
    $pageno = ceil($count/9);
    
	for($i=1;$i<=$pageno;$i++){
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}

// get_product ORDER BY RAND ()
if(isset($_POST["getproduct"])) {
    $limit = 12;
    if(isset($_POST["setpage"])) {
       $pageno = $_POST["pageno"];
       $start  = ($pageno * $limit) - $limit ;
    }else { $start = 0;}

    $product_query = "SELECT * FROM products  LIMIT $start,$limit";
    $run_query = mysqli_query($con,$product_query);

    if(mysqli_num_rows($run_query) > 0) {
        while ($row = mysqli_fetch_array($run_query)) {
            $pro_id    = $row['product_id'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
            $pro_image = $row['product_image'];
            echo "

            <style>
            .panel {
                background-color: #EBEBEB;
                border: 2px solid;
                border-style: rounded;
                border-radius: 10px;
            }
            .panel-heading{
                color: #000000;
                font-size: 20px;
            }
            .panel-footer{
                color: #000000;
                font-size: 16px;
                border-radius: 10px;
            }
            .btnAdd{
                color: #000000;
                background-color: #CDCDCD;
            }
            </style>

            <div class='col-md-4'>
                    <div class='panel'>
                        <div class='panel-heading'>$pro_title</div>
                        <div class='panel-body'> <img src='product_images/$pro_image' style='width:250px; height:250px;/></div>
                        <div class='price' style=><h3> ₹ $pro_price</h3></div>
                        <div class='panel-footer'>
                        <button pid='$pro_id' id='product' class='btnAdd'>Add To Cart</button>
                    </div>
                    </div>
                    </div>
            
            ";
        }
    }
}

if(isset($_POST["addProduct"])){
    if (isset($_SESSION["uid"])) {
        $p_id = $_POST["proId"];
        $user_id = $_SESSION["uid"];
        $sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id' ";
        $run_query = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run_query);
        if ($count > 0) {
            echo "Product is already added";
        }else {
            $sql = "SELECT * FROM products WHERE product_id='$p_id'";
            $run_query = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($run_query);
        
            $id=  $row["product_id"];
            $pro_name=$row["product_title"];
            $pro_image=$row["product_image"];
            $pro_price=$row["product_price"];
            
        $sql="INSERT INTO `cart` (`id`, `p_id`, `ip_add`, `user_id`, `qty`, `product_title`, `product_image`, `price`, `total_amt`) 
        VALUES (NULL, '$p_id', '0', '$user_id', '1', '$pro_name', '$pro_image', '$pro_price', '$pro_price');";
        
        if(mysqli_query($con,$sql)) {
            echo "
            <div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            <b>Product added to Cart</b>
            </div>
            ";
        }
        }

    }else {
       echo "
       <div class='alert alert-danger'>
       <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
       <b>Please sign in or register to add to cart</b>
       </div>   
       ";
    }

}


?>