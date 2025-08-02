<?php
session_start();

require "connection.php";


function updatePhoto($user_id,$photo_name,$photo_tmp){

$conn = connection();
$sql ="UPDATE users SET photo = '$photo_name' WHERE id = '$user_id'";

if($conn->query($sql)){
    $destination = "assets/images/$photo_name";
    move_uploaded_file($photo_tmp,$destination);
    header("refresh: 0");
}else{
    die("Error uploading photo:" . $conn->error);
}
}

if(isset($_POST['btn_upload_photo'])){
    $user_id = $_SESSION['user_id'];
    $photo_name = $_FILES['photo']['name'];
    $photo_tmp = $_FILES['photo']['tmp_name'];

    updatePhoto($user_id,$photo_name,$photo_tmp);
}

$user_details = getUser($_SESSION['user_id']);

function getUser($user_id){
    $conn = connection();
    $sql = "SELECT * FROM users WHERE id = $user_id";

    if($result = $conn->query($sql)){
        return $result->fetch_assoc();

    }else{
        die("Error getting user: " .$conn->error);
    }
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
    <title>Profile</title>
</head>
<body>
    
<?php
include "main-nav.php";
?>


<main class="container mt-5 text-center">
    <div class="card w-25 mx-auto">
        <?php
        if($user_details['photo']){
            
            ?>
            <img src ="assets/images/<?= $user_details['photo']?>" alt="" class="card-img-top">
            <?php
        }else{
            ?>
            <i class="fas fa-user text-secondary fa-2x"></i>
            <?php
        }
        ?>
        <div class="card-body">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="input-group mb-2">
                    <input type="file"name="photo" class="form-control" aria-label="Choose-photo">
                    <button type ="submit" class="btn btn-outline-secondary" name="btn_upload_photo">Update
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>



</body>
</html>