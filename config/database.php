<?php
$conn =new mysqli("localhost","hassan","hassan1234","bookstore");
if(!$conn){
    echo "Connection error".mysqli_error($conn);
    die();
}

