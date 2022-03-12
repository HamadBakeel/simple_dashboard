<?php
    $connection = mysqli_connect('localhost','hamad','user_hamad','simple_dashboard');
    // $connection = mysqli_connect('localhost','hamad','ninja_pizza','ninja_pizza');

    if(!$connection){
            echo "Connection error: " . mysqli_connect_error(); 
    }
    

?>