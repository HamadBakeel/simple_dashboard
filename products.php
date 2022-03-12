<!DOCTYPE html>
<html lang="en">
    <?php include('components/header.php');
        include('components/db_connect.php');
        $sql = "SELECT * FROM products";
        $result = mysqli_query($connection,$sql);
        $products = mysqli_fetch_all($result,MYSQLI_ASSOC);

        mysqli_free_result($result);
        if(isset($_POST['deleteProduct'])){

            $id = $_POST['id_to_delete'];
            $sql = "DELETE FROM products WHERE id = $id";
            if(mysqli_query($connection,$sql)){
                header("Location: products.php");
            }else{
                echo "qurey error: ".mysqli_error();
            }

            unset($_POST['deleteProduct']);
        }

    ?>
<body>
    <h1 class="text-center">Products</h1>
    <div class="row d-flex align-items-center">
        <?php include('components/sidebar.php');?>
        <div class="col-10 d-flex flex-column ">
            <div class="row justify-content-end me-5">
                <a href="addProduct.php" class="w-auto btn btn-info text-white m-3 ">Add Product</a>
            </div>
            <div class="row">
                <?php for($i=0; $i<count($products); $i++): ?>
                    <div class="shadow w-25 p-2 m-3">
                        <p class="text-center"><?php echo $products[$i]['product_name']?></p>
                        <p class="text-secondary text-center"><?php 
                            $id = $products[$i]['cat_id'];  
                            $sql = "SELECT `title` FROM categories WHERE id = $id";
                            $result = mysqli_query($connection,$sql);
                            $category = mysqli_fetch_assoc($result);
                            mysqli_free_result($result);
                            // echo $category;
                            print($category['title']);
                            ?></p>
                        <div class="row d-flex justify-content-end">
                            <form action="products.php" method="post" class="w-25">
                                <input type="hidden" name="id_to_delete" value="<?php echo $products[$i]['id'] ?>">
                                <input type="submit" value="Delete" name="deleteProduct" style="font-size: 12px;" class="py-0  rounded btn-danger">
                            </form>
                            <form action="addProduct.php" method="post" class="w-25">
                                <input type="hidden" name="id_to_edit" value="<?php echo $products[$i]['id'] ?>">
                                <input type="submit" value="Edit" name="editProduct" style="font-size: 12px;" class="py-0  rounded btn-secondary">
                            </form>
                        </div>
                    </div>
                <?php endfor;
                mysqli_close($connection);
                
                ?>
            </div>
        </div>
    </div>
</body>
</html>