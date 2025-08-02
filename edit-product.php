<?php
session_start();

require "connection.php";

function getSections(){
 $conn = connection();
 $sql = "SELECT * FROM sections";

 if($result = $conn->query($sql)){
    return $result;
 }else{
    die("Error retrieving product types:" . $conn->$error);
 }

}

$prod_id = $_GET['prod_id'];
$prod_row = getProduct($prod_id);
 //$prod_row is an associative array

 function getProduct($prod_id){
    $conn = connection();
    $sql = "SELECT * FROM products WHERE id = $prod_id";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();
          // return an associative array
          // Since we are ecpecting 1 row only
    }else{
        die("Error retrieving the products: " .$conn->error);
    }
 }


function updateProducts($id,$title,$description,$price,$section_id){
    $conn = connection();
    $sql = "UPDATE `products` SET `title` = '$title', `description` = '$description', `price` = '$price', `section_id` = '$section_id' WHERE `id` = '$id' ";

    if($conn->query($sql)){
        header("location: products.php");
        exit;
    }else{
        die("Error updating product: " .$conn->error);
    }

}

if(isset($_POST['btn_save'])){
    $id = $_GET['prod_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $section_id = $_POST['section_id'];

    updateProducts($id,$title,$description,$price,$section_id);
}

?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit Product</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php
    include "main-nav.php";
    ?>
    <main class="card w-25 mx-auto my-5">
        <div class="card-header bg-secondary text-white">
            <h2 class="card-title h4 mb-0">Edit Product Details</h2>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <!-- Copy the form from add-product.php but change the submit button -->
                <label for="title" class="form-label small">Title</label>
                <input type="text" name="title" id="title" class="form-control mb-2" value="<?= $prod_row['title']?>" required autofocus>

                <label for="description" class="form-label small">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control mb-2" required><?= $prod_row['description']?></textarea>

                <label for="price" class="form-label small">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">$</div>
                    <input type="number" name="price" id="price" class="form-control" value="<?= $prod_row['price']?>" required>
                </div>

                <label for="section_id" class="form-label small">Section</label>
                <select name="section_id" id="section_id" class="form-select mb-5" required>
                    <option value="" hidden>Select Section</option>
                    <?php
                    $sections_result = getSections();
                    while($sec_row = $sections_result->fetch_assoc()){
                        if($sec_row['id']==$prod_row['section_id']){
                    ?>   
                        <option value="<?= $sec_row['id']?>" selected><?= $sec_row['name']?></option> ;
                        <?php
                        }else{
                        ?>
                        
                            <option value="<?= $sec_row['id']?>"><?= $sec_row['name']?></option>;
                        <?php
                           }
                        }
                        ?>
                </select>

                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-secondary px-5" name="btn_save">Save</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>