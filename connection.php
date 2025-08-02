<?php

function connection(){
    $server_name = "localhost";
    $user_name = "root";
    $password = "root"; //$password = "root" for mac/MAMP users
    $db_name = "minimart_catalog";

    //Create a connection
    $conn = new mysqli($server_name,$user_name,$password,$db_name);
    // $conn holds the connection
    //$conn - object
    //mysqli - class (contains different function and variables inside)
    //mysql improved

    //Check the connection
    if($conn->connect_error){
        //There is an error
        die("connection failed:" . $conn->connect_error);
        //die() will terminate the current script
    }else {
        // No error in the connection
        return $conn;
    }
    // -> object operator (object is on the left)
    // connect_error contains a string value of the error
}


?>