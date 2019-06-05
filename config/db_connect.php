<?php 

//connect to db
$connect = mysqli_connect('localhost', 'michael', 'test1234', 'smileys');

//check connection
if(!$connect){
    echo "Connection error: " . mysqli_connect_error(); 
}

?>