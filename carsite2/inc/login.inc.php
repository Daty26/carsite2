<?php
    if(isset($_POST["submit"])){
        $username = $_POST["userName"];
        $pass = $_POST["pass"];

        require_once "db.inc.php";
        require_once "functions.inc.php";

        if(emptyInputLogin($username, $pass) !== false){
            header("location: ../index.php?error=emptyinputli");
            exit();
        }
        loginUser($conn, $username, $pass);
    }else{
        header("location: ../index.php");
    }