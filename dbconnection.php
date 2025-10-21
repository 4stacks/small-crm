<?php
$con = mysqli_connect("db", getenv("MYSQL_USER"), getenv("MYSQL_PASSWORD"), getenv("MYSQL_DATABASE"));
if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error();
}
?>
