<?php

session_start();
include "db.php";

if (isset($_POST["rid"])) {
	$remove_id = $_POST["rid"];
	$sql = "DELETE FROM `images` WHERE `image_id` = '$remove_id'";
    mysqli_query($con,$sql);
}
?>