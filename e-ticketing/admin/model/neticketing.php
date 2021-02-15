<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_neticketing = "localhost";
$database_neticketing = "nticketing_project";
$username_neticketing = "root";
$password_neticketing = "";
$conn = mysql_connect($hostname_neticketing, $username_neticketing, $password_neticketing) or die('Unable to Connect with Server'); 
$neticketing = mysql_selectdb($database_neticketing, $conn) or die('unable to connect with DB');
?>