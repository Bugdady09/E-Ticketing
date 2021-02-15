<?php

include_once '../../Connections/neticketing.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of adminLogin
 *
 * @author Abir
 */
if (isset($_POST['inputEmail'])) {

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    $query = "SELECT * FROM `user_info` WHERE `user_email`= '" . $email . "'";
    $result = mysql_query($query);
    print_r($result);
    if (!$result) {
        trigger_error("dbget: " . mysql_error() . " in " . $query);
        return false;
    }
//    die();
    if ($result) {
        $userData = mysql_fetch_assoc($result);
    }

//    echo "<pre>";
//    print_r($userData);
//    echo "<pre>";
//    die();

    if (isset($userData)) {
        if ($password == $userData['user_password'] && $userData['admin'] == 1) {
            session_start();
            $_SESSION['user_email'] = $email;
            header("Location:http://localhost/ticketing/admin/dashboard.php");
        }
    } else {
        header("Location:http://localhost/ticketing/admin/");
    }
} else {
    header("Location:http://localhost/ticketing/admin/");
}

