<?php

    include('components/header.php');
    include('createDB.php');
    $con = new DB();
    $title ='';

    $categories = $con->fetchCategories();

    if(isset($_POST['addProduct'])){
        $con->addProduct();
        }else{
            echo "product name is required";
        }

    if(isset($_POST['editProduct'])){
        $id = $_POST['id_to_edit'];
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($con->connection,$sql); 
        $product = mysqli_fetch_assoc($result);
    }

    if(isset($_POST['updateProduct'])){
        $id = $_POST['id_to_edit'];
        $sql = "UPDATE `products` SET `cat_id`='[value-2]',`product_name`='[value-3]' WHERE 1";
        if(mysqli_query($con->connection,$sql)){
            header("Location: products.php");
        }else{
            echo "qurey error: ".mysqli_error($con->connection);
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
    <div class="container py-3">
    <form action="addProduct.php" method="post">
        <label for="productName">Product name: </label>
                <?php if(isset($_POST['id_to_edit'])){ ?>
                    <input type="text" name="productName" value="<?php echo $product['product_name']?>">
                <?php }else{ ?>
                    <input type="text" name="productName" >
                <?php } ?>
        <select name="categories" id="">
            <?php foreach($categories as $cat): ?>
                <?php if(isset($_POST['id'])){?>
                    <option selected value="<?php  echo $cat['id']?>">
                        <?php echo $cat['title']?>
                    </option>
                    <?php }else{ ?>
                        <option selected value="<?php  echo $cat['id']?>">
                            <?php echo $cat['title']?>
                        </option>
                    <?php } ?>
                    <?php endforeach?>    
                </select>
                <?php if(isset($_POST['id'])){?>
                    <input type="submit" value="Update" name="updateProduct">
                    <?php }else{ ?>
                        <input type="submit" value="Submit" name="addProduct">
                        <input type="hidden" >
                        <?php } 
                    unset($_POST['id']);
                ?>

    </form>
    </div>
</body>
</html>