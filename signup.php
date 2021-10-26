<?php
    session_start();
    include "php/db.php";
    $name = $_POST["name"];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nameVal = "/^[a-zA-Z ]+$/";
    $emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo 
        '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            PLease Fill all fields..!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        exit();
    } else {
        if (!preg_match($nameVal,$name)) {
            echo 
            '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <b>This '.$name.' is not valid</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            exit();
        }
       else if (!preg_match($emailValidation,$email)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <b>This Email is not valid...!</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            exit();
        }
      else  if(strlen($password) < 6 ){
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <b>Password is weak</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            exit();
        }
       else if(strlen($confirm_password) < 6 ){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <b>Password is weak</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            exit();
        }
        else if($confirm_password != $password){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <b>Password does not match</b>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            exit();
        }
        $sql = "SELECT user_id FROM users WHERE email ='$email' LIMIT 1";
        $check_query = mysqli_query($con ,$sql);
        $count_email = mysqli_num_rows($check_query);
        if ($count_email > 0 ) {
            echo 
            '   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email is already registerd, Please try with another account
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'    
            ;
            exit();
        } else {
            $password = $password;
            $sql = "INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES (NULL, '$name', '$email', '$password')";
            $run_query = mysqli_query($con,$sql);
            if ($run_query) {
                $_SESSION['email'] = $email; 
                $_SESSION["name"] = $name;
                echo "signupsuccess";               
            }
        }
    }
?>