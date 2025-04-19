<?php
    session_start();
    include 'class_user.php';
    $user = new User();
    extract($_REQUEST);
    $insert= $user->reg_user($custcode,$username,$password,$custname,$mobile,$email,$birthdate);
    if($insert){
        //register success
        header("location:logincontroller.php");
    }else{
        //failed
        echo "Could not insert new member.";
    }
?>