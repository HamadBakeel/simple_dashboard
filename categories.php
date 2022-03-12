<!DOCTYPE html>
<html lang="en">
    <?php
        include('components/header.php');
        include('components/db_connect.php');
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($connection,$sql);
        $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        // echo "<pre>";
        // print_r($categories);
        if(isset($_POST['deleteCategory'])){
            $id = $_POST['id'];
            $sql = "DELETE FROM categories WHERE id = $id" ;
            if(mysqli_query($connection,$sql)){
                header("Location: categories.php");
                unset($_POST['deleteCategory']);
            }else{
                echo 'query error: '. mysqli_error($connection);
            }
        }
        
        mysqli_close($connection);
    ?>
<body>
    <h1 class="text-center">Categories</h1>
    <div class="row d-flex align-items-center">
        <?php include('components/sidebar.php');?>
        <div class="col-10 d-flex flex-column ">
            <div class="row justify-content-end me-5">
                <a href="addCategory.php" class="w-auto btn btn-info text-white m-3 ">Add Category</a>
            </div>
            <div class="row">
                <?php  foreach($categories as $cat):?>
                    <div class="shadow w-25 p-2 m-3">
                            <p class="text-secondary text-center"><?php echo htmlspecialchars($cat['title']);?></p>
                            <div class="row d-flex justify-content-end">
                                <form action="categories.php" method="post" class="w-25">
                                    <input type="hidden" name="id" value="<?php echo $cat['id']?>">
                                    <input type="submit" value="Delete" name="deleteCategory" style="font-size: 12px;" class="py-0  rounded btn-danger">
                                </form>
                                <form action="categories.php" method="post" class="w-25">
                                    <input type="hidden" name="id" value="<?php echo $cat['id']?>">
                                    <input type="submit" value="Edit" name="editCategory" style="font-size: 12px;" class="py-0  rounded btn-secondary">
                                </form>
                            </div>
                    </div>
                <?php endforeach;?>
                <!-- <div class="shadow w-25 p-2 m-3">
                        <p class="text-secondary text-center">aa</p>
                        <div class="row d-flex justify-content-end">
                            <form action="categories.php" method="post" class="w-25">
                                <input type="submit" value="Delete" name="deleteProduct" style="font-size: 12px;" class="py-0  rounded btn-danger">
                            </form>
                            <form action="categories.php" method="post" class="w-25">
                                <input type="submit" value="Edit" name="editProduct" style="font-size: 12px;" class="py-0  rounded btn-secondary">
                            </form>
                        </div>
                </div> -->

            </div>
        </div>
    </div>
</body>
</html>