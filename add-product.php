<?php
session_start();

require "connection.php";

if(isset($_POST['btn_add'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $section_id =$_POST['section_id'];

    createProduct($title,$description,$price,$section_id);

}

function createProduct($title,$description,$price,$section_id){
    $conn = connection();
    //connection is the function name from connection.php

    //sql command
    $sql = "INSERT INTO `products`(`title`,`description`,`price`,`section_id`)VALUES('$title','$description','$price','$section_id')";

    //execute the sql command to the query
    if($conn->query($sql)){
        //if successful
        header("location:products.php");
        exit;
    }else{
        die("Error adding new products:" .$conn->error);
    }
}

function getAllSections(){
    $conn = connection();
    $sql = "SELECT * FROM sections";
    //execute the sql command to the query
    if($result = $conn->query($sql)){
       return $result;
    }else{
        die("Error in retrieving all section:" .$conn->error);
    }

}



?>


<!doctype html>
<html lang="en">
<head>
    <title>New Product</title>
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
        <div class="card-header bg-success text-white">
            <h2 class="card-title h4 mb-0">Add New Product</h2>
        </div>
        <div class="card-body">
            <form method="post">
                <label for="title" class="form-label small">Title</label>
                <input type="text" name="title" id="title" class="form-control mb-2" required autofocus>

                <label for="description" class="form-label small">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control mb-2" required></textarea>

                <label for="price" class="form-label small">Price</label>
                <div class="input-group mb-2">
                    <div class="input-group-text">$</div>
                    <input type="number" name="price" id="price" class="form-control" required>
                </div>

                <label for="section-id" class="form-label small">Section</label>
                <select name="section_id" id="section-id" class="form-select mb-5" required>
                    <option value="" hidden>Select Section</option>
                    <?php
                    $sections_result = getAllSections();
                    while($sections_row = $sections_result->fetch_assoc()){
                        echo "<option value='".$sections_row['section_id']."'>".$sections_row['name']."</option>";
                    }
                    ?>
                </select>
                
                <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-success px-5" name="btn_add">Add</button>            
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