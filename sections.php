<?php
session_start();
require "connection.php";
function createSection($name){
    // connection
    $conn = connection();
    //SQL
    $sql = "INSERT INTO sections(name) VALUE('$name')";
    //Execution
    if($conn->query($sql)){
        //Success
        //Refresh the current page after 0 seconds
        header("refresh: 0");
    }else{
        //Fail
        die("Error adding new product section: " . $conn->error);
    }
}

function getAllsections(){
    $conn = connection();
    $sql = "SELECT * FROM sections";
    if($result = $conn->query($sql)){
        return $result;
    }else{
        die("Error retrieving all sections:" . $conn->error);
    }
}
if(isset($_POST['btn_add'])){
    $name = $_POST['name'];
    createSection($name);
}
?>

<!doctype html>
<html lang="en">
    <head>
        <title>New Section</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- ✅ 最新のFont Awesome 6 CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-wRHDLBr0qeG6Y1ZT7m4WTfGekOwh9+Jz9HEjPSpGEyYkkKwQnz0xru6YGiW4ylPY/kOi8yphNmVG4pWGlTz0bg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
    <?php
    include "main-nav.php";
    ?>
        <main class="py-5">
            <div class="card w-25 mx-auto mb-5">
                <div class="card-header bg-info text-white text-center">
                    <h1>
                        Add New Section
                    </h1>
                </div>
                <div class="card-body text-center">
                    <form action="" method="post">
                        <label for="title" class="form-label small float-start">Secton title</label>
                        <input type="text" name="title" id="title" class="form-control mb-4" required autofocus>

                        <a href="products.php" class="btn btn-outline-secondary" style="width: 150px;">Cancel</a>
                        <button type="submit" class="btn btn-info px-5" name="btn_add" style="width: 150px;">Add</button>
                    </form>
                </div>
            </div>      
            <div class="w-25 mx-auto">
                <h5 class="text-muted">Section List</h5>
                <table class="table table-hover mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>TITLE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_sections = getAllsections();
                        while($section = $all_sections->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?=$section['section_id']?></td>
                            <td><?=$section['name']?></td>
                            <td class="text-center">
                                <form method="post">
                                    <button type="submit" name="btn_delete" value="<?=$section['section_id']?>" class="btn btn-lutline-danger border-0" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>