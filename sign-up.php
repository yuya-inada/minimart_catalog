<?php
require 'connection.php';

function createUser($fn,$ln,$username,$pwd){
    $conn = connection();
    $secure_password = password_hash($pwd,PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (`first_name`,`last_name`,`username`,`password`)
    VALUES ('$fn','$ln','$username','$secure_password')";

    if($conn->query($sql)){
        // go to login page
        header("Location: login.php");
        exit;
    }else{
        die("Error adding new user:" . $conn->error);
    }
}

if(isset($_POST['btn_sign_up'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $pass = $_POST['password']; //password123
    $confirm_pass = $_POST['confirm_password'];//password123

    // check if password and confirm password are the same
    if($pass == $confirm_pass){
        //if  it does match
        createUser($first_name,$last_name,$username,$pass);
    }else{
        //if does not match
        echo '<p class="text-danger">Password and Password Confirm Does Not Match</p>';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto p-0">
                <div class="card-header text-success">
                    <h1 class="card-title h3 mb-0 text-center">
                        Create your account
                    </h1>
                </div>

                <div class="card-body">
                    <form method="post" action="">
                        <!-- First name input -->
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control mb-2" required placeholder=" Enter First name" autofocus>
                        <!-- Last name input -->
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control mb-2" required placeholder=" Enter last name" autofocus>
                        <!-- username input -->
                        <label for="username">User Name</label>
                        <input type="text" name="username" id="username" class="form-control mb-2" required placeholder=" Enter Username" autofocus maxlength="15">
                        <!-- password input -->
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" required placeholder=" Enter Password" autofocus>
                        <!-- Confirm password input -->
                        <label for="confirm-password">Password</label>
                        <input type="password" name="confirm_password" id="confirm-password" class="form-control mb-2" required placeholder=" Enter Password Again" autofocus required>
                        <!-- submit button -->
                        <button type="submit" class="btn btn-success w-100" name="btn_sign_up">Sign Up</button>
                    </form>

                    <!-- Login page -->
                    <div class="text-center mt-3">
                        <p class="small">
                            Already have an account?
                            <a href="login.php">
                                Log in.
                            </a>
                        </P>
                    </div>

                </div>
            </div>
        </div>


    </div>


    
</body>
</html>