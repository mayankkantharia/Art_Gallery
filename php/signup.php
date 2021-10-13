<?php
include "db.php";

$name = $_POST["name"];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$nameVal = "/^[a-zA-Z ]+$/";
$emailValidation = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";

if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "
    <div class='alert alert-warning'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>PLease Fill all fields..!</b>
    </div>
    ";
    exit();
} else {
if (!preg_match($nameVal,$name)) {
    echo "
    <div class='alert alert-warning'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<b>this $name is not valid</b>
	</div>
    ";
    exit();
}
if (!preg_match($emailValidation,$email)) {
    echo "
    <div class='alert alert-warning'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>this $email is not valid</b>
    </div>
    ";
    exit();
}
if(strlen($password) < 6 ){
    echo "
    <div class='alert alert-warning'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>Password is weak</b>
    </div>
    ";
    exit();
}
if(strlen($confirm_password) < 9 ){
    echo "
	<div class='alert alert-warning'>
	<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	<b>Password is weak</b>
    </div>
    ";
    exit();
}



$sql = "SELECT user_id FROM users WHERE email ='$email' LIMIT 1";
$check_query = mysqli_query($con ,$sql);
$count_email = mysqli_num_rows($check_query);
if ($count_email > 0 ) {
    echo "
    <div class='alert alert-danger'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <b>Email is already registerd with another account</b>
    </div>
    ";
    exit();
} else {
    $password = md5($password);
    $sql = "INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES (NULL, '$name', '$email', '$password')";
    $run_query = mysqli_query($con,$sql);
    if ($run_query) {
        echo "
        <div class='alert alert-success'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <b>Account is created succesfully</b>
        </div>
        ";
    }
}
}

?>