<?php

    include('components/header.php');
    include('createDB.php');
    $con = new DB();
    
    $title ='';
    if(isset($_POST['addCat'])){
        if(!empty($_POST['title'])){
            $title = mysqli_real_escape_string($con->connection,$_POST['title']);
            $con->addCategory($title);
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
        <input type="submit" value="Submit" name="addCat">
    </form>
    </div>
</body>
</html>