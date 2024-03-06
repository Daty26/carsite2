<?php

    if(isset($_POST["submit"])){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $passRep = $_POST["passrep"];

        require_once "db.inc.php";
        require_once "functions.inc.php";

        if(emptyInputSignUp($username, $email, $pass, $passRep) !== false){
            header("location: ../index.php?error=emptyinputsu");
            exit();
        }
        if(wrongLogin($username) !== false){
            header("location: ../index.php?error=wrongloginsu");
            exit();
        }
        if(wrongEmail($email) !== false){
            header("location: ../index.php?error=wrongemailsu");
            exit();
        }
        if(passMatch($pass, $passRep) !== false){
            header("location: ../index.php?error=passdontmatchsu");
            exit();
        }
        if(loginExists($conn, $username, $email) !== false){
            header("location: ../index.php?error=loginexistssu");
            exit();
        }
        createUser($conn, $username, $email, $pass);
    }else{
        header("location: ../index.php");
    }