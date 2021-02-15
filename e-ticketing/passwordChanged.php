<?php

require_once('Connections/neticketing.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_POST)) {

    $userEmail = $_POST['userEmail'];
    $currentPassword = $_POST['currPassword'];
    $newPassword = $_POST['inputPassword'];
    $confirmPassword = $_POST['confirmPassword'];


//    print_r($userEmail);
    $query = "SELECT * FROM `user_info` WHERE `user_email` = '" . $userEmail . "'";
    $result = mysql_query($query);
    $checkPassword = mysql_fetch_assoc($result);


    session_start();
    if ($currentPassword == $checkPassword['user_password']) {
        if ($newPassword == $confirmPassword) {
            $passQuery = "UPDATE `nticketing_project`.`user_info` SET `user_password` = '" . $newPassword . "' WHERE `user_email` = '" . $userEmail . "'";
            mysql_query($passQuery);

            $_SESSION['passMsg'] = "Password Changed Successfully";
            header("location:changePassword.php");
        } else {
            $_SESSION['passMsg'] = "Password do not match";
            header("location:changePassword.php");
        }
    } else {
        $_SESSION['passMsg'] = "Wrong Password";
        header("location:changePassword.php");
    }
}
