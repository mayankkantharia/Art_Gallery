<?php
include "db.php";

session_start ();

if(isset($_POST["userLogin"])){
    $email = mysqli_real_escape_string ($con, $_POST["userEmail"]);
    $password = md5($_POST["userPassword"]);

    $sql = "SELECT * FROM users WHERE email='$email' AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    
    $count = mysqli_num_rows($run_query);
    if ($count == 1) {
        $row= mysqli_fetch_array($run_query);
            $_SESSION["uid"] = $row["user_id"]; 
            $_SESSION["name"] = $row["name"];
        echo "loginsuccess";
    }
    if($count == 0){
        echo "
    <div class='alert alert-danger'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>Invalid Details</b>
    </div>
    ";
    exit();
    }
}
?>