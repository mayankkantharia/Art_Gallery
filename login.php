<?php
    if(isset($_POST['login']))
    {
        session_start();
        include 'php/db.php';        
        $p_email = $_POST['email'];
        $p_password = $_POST['password'];
        $s = " select * from users where email = '$p_email' && password ='$p_password' ";
        $result = mysqli_query($con, $s);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $row  = mysqli_fetch_array($result);
            $_SESSION["email"]=$row['email'];
            $_SESSION["name"]=$row['name'];
            header('location: final_board.php');
        }else{
            header('location: signup.html');
            exit();
        }
        mysqli_close($conn);
    }
?>



