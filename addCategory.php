<?php

    include('components/header.php');
    include('components/db_connect.php');
    $title ='';
    // if(!array_filter($errors)){
    if(isset($_POST['addCat'])){

        if(!empty($_POST['title'])){
            $title = mysqli_real_escape_string($connection,$_POST['title']);

            $sql = "INSERT INTO categories (title) VALUES ('$title')";
            // echo "adfdas";
            if(mysqli_query($connection,$sql)){
                header("Location: categories.php");
            }else{
                echo "qurey error: ".mysqli_error($connection);
            }
        }else{
            echo "title is required";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add category</title>
</head>
<body>
    <div class="container">
    <form action="addCategory.php" method="post">
        <label for="title">Category name: </label>
        <input type="text" name="title" >
        <!-- <div class="text-danger"><?PHP echo $errors['title'] ?></div> -->
        <input type="submit" value="Submit" name="addCat">
    </form>
    </div>
</body>
</html>