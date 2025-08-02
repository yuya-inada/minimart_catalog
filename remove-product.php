<?php
session_start();

require "connection.php";

$prod_row = getProduct($_GET['prod_id']);

function getProduct($prod_id){
    $conn = connection();
    $sql = "SELECT * FROM products WHERE id = $prod_id";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();
    }else{
        die("Error retrieving the product: " .$conn->error);
    }
}

function deleteProduct($prod_id){
    $conn = connection();
    $sql = "DELETE FROM products WHERE id = $prod_id";

    if($conn->query($sql)){
        header("location: products.php");
        exit;
    }else{
        die("Error deleting the products:" . $conn->error);
    }
}
if(isset($_POST['btn_delete'])){
    $prod_id = $_GET['prod_id'];
    deleteProduct($prod_id);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Remove-Product</title>
</head>
<body>
    
<?php
include "main-nav.php";
?>
<main class="card w-25 mx-auto border-0 my-5">
    <div class="card-header bg-white border-0">
        <h2 class="card-title text-center text-danger h4 mb-0">Delete Product</h2>
    </div>
    <div class="card-body text-center">
        <i class="fas fa-exclamation-triangle text-warning display-4 d-block mb-2"></i>
        <p class="fw-bold mb-0">Are you sure you want to dalete "<?= $prod_row['title']?>"?</p>
    </div>
    <div class="row">
        <div class="col">
            <a href="products.php" class="btn btn-secondary w-100">Cancel</a>
        </div>
        <div class="col">
            <form method="post">    
                <button type="submit" class="btn btn-outline-danger w-100" name="btn_delete">Delete</button>
            </form>
        </div>
    </div>
</main>

</body>
</html>