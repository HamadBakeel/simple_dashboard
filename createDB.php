<?php
class DB{
    public $connection;
    
    public function __construct(){
        $this->connection = mysqli_connect('localhost','hamad','user_hamad','simple_dashboard');
        if(!$this->connection){
            echo "Connection error: " . mysqli_connect_error(); 
        }
    }

    public function addCategory($title){
        $sql = "INSERT INTO categories (title) VALUES ('$title')";
        if(mysqli_query($this->connection,$sql)){
            header("Location: categories.php");
        }else{
            echo "qurey error: ".mysqli_error($con->connection);
        }
    }

    public function addProduct(){
        if(!empty($_POST['productName'])){
            $productName = mysqli_real_escape_string($this->connection,$_POST['productName']);
            $category = $_POST['categories'] ;
            $sql = "INSERT INTO products (product_name,cat_id) VALUES ('$productName','$category')";
            if(mysqli_query($this->connection,$sql)){
                header("Location: products.php");
            }else{
                echo "qurey error: ".mysqli_error($con->connection);
            }
        }
    }
    
    public function fetchProducts(){
        $sql = "SELECT * FROM products";
        $result = mysqli_query($this->connection,$sql);
        $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $products;
    }

    public function fetchCategories(){
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->connection,$sql);
        $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_free_result($result);
        return $categories;
    }

    public function fetchCategory($id){
        $sql = "SELECT `title` FROM categories WHERE id = $id";
        $result = mysqli_query($this->connection,$sql);
        $category = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $category;
    }

    public function deleteProduct(){
            if(isset($_POST['id_to_delete'])){
                $id = $_POST['id_to_delete'];
                $sql = "DELETE FROM products WHERE id = $id";
                if(mysqli_query($this->connection,$sql)){
                    header("Location: products.php");
                }else{
                    echo "qurey error: ".mysqli_error();
                }
            }
    }

    public function deleteCategory(){
        $id = $_POST['id'];
        $sql = "DELETE FROM categories WHERE id = $id" ;
        if(mysqli_query($this->connection,$sql)){
            header("Location: categories.php");
            unset($_POST['deleteCategory']);
        }else{
            echo 'query error: '. mysqli_error($con->connection);
        }
    }

}

?>