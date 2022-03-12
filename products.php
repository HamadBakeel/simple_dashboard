<!DOCTYPE html>
<html lang="en">
    <?php include('components/header.php');
    include('createDB.php');
    $con = new DB();

    $products = $con->fetchProducts();
    if(isset($_POST['delete'])){
        $con->deleteProduct();
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
                            $category = $con->fetchCategory($products[$i]['cat_id']);
                            print($category['title']);
                            ?>
                        </p>
                        <div class="row d-flex justify-content-end">
                            <form action="products.php" method="post" class="w-25">
                                <input type="hidden" name="id_to_delete" value="<?php echo $products[$i]['id'] ?>">
                                <input type="submit" value="Delete" name="delete" style="font-size: 12px;" class="py-0  rounded btn-danger">
                            </form>
                            <form action="createDB.php" method="post" class="w-25">
                                <input type="hidden" name="id_to_edit" value="<?php echo $products[$i]['id'] ?>">
                                <input type="submit" value="Edit" name="editProduct" style="font-size: 12px;" class="py-0  rounded btn-secondary">
                            </form>
                        </div>
                    </div>
                <?php endfor;
                mysqli_close($con->connection);
                
                ?>
            </div>
        </div>
    </div>
</body>
</html>