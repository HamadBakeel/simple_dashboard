<!DOCTYPE html>
<html lang="en">
    <?php
        include('components/header.php');
        include('createDB.php');
        $con = new DB();

        $categories = $con->fetchCategories();
    
        if(isset($_POST['deleteCategory'])){
            $con->deleteCategory();
        }
        
        mysqli_close($con->connection);
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

            </div>
        </div>
    </div>
</body>
</html>