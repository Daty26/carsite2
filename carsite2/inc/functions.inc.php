<?php
    function dump($variables){
        echo "<pre>";
            var_dump($variables);
        echo "</pre>";
    }
    function emptyInputSignUp($username, $email, $pass, $passRep){
        if(empty($username) || empty($email) || empty($pass) || empty($passRep)){
            return true;
        }else{
            return false;
        }
    }
    function wrongLogin($username){
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            return true;
        }else{
            return false;
        }
    }
    function wrongEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    function passMatch($pass, $passRep){
        if($pass !== $passRep){
            return true;
        }else{
            return false;
        }
    }
    function loginExists($conn, $username, $email) {
        $sql = "SELECT * FROM users WHERE usersName = '$username' OR usersEmail = '$email';";
        $result = mysqli_query($conn, $sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            if($row){
                mysqli_free_result($result);
                return $row;
            }else{
                mysqli_free_result($result);
                return false;
            }
        }else{
            header("location: ../index.php?error=sqlerror");
            exit();
        }
    }
    function createUser($conn, $username, $email, $pass){
        $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (usersName, usersEmail, usersPass) VALUES ('$username', '$email', '$hashedpass')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: ../index.php?error=none");
            exit();
        } else {
            header("location: ../index.php?error=sqlerror");
            exit();
        }
    }
    function emptyInputLogin($username, $pass){
        if(empty($username) || empty($pass) ){
            return true;
        }else{
            return false;
        }
    }
    
    function loginUser($conn, $username, $pass){
        $check = loginExists($conn, $username, $username);
        if($check === false){
            header("location: ../index.php?error=wrongusernameli");
            exit();
        }
        $passHashed = $check["usersPass"];
        $checkPass = password_verify($pass, $passHashed);

        if($checkPass === false){
            header("location: ../index.php?error=wrongpassli");
            exit();
        }else if($checkPass === true){
            session_start();
            $_SESSION["usersid"] =  $check["usersId"];
            $_SESSION["usersname"] =  $check["usersName"];
            header("location: ../index.php");
            exit();
        }
    }

    function emptyCar($carBrand, $carMode, $carYear, $carTrans, $carMileage, $carPrice){
        if(empty($carBrand) || empty($carMode) || empty($carYear) || empty($carTrans) || empty($carMileage) || empty($carPrice)){
            return true;
        }else{
            return false;
        }
    }

    function insertImg($productImgName, $productImgSize, $productImgTmp, $error) {
        if($error === 0){
            if($productImgSize > 5000000000){
                header("location: ../index.php?error=yourfileistoolarge");
                exit();
            }else{
                $img_ex = pathinfo($productImgName, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $newImgName = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../img/' . $newImgName;

                move_uploaded_file($productImgTmp, $img_upload_path);
            }
        }else{
            header("location: ../index.php?error=unknownerror!");
        }
        return $newImgName;
    }
    function addCar($conn, $carBrand, $carModel, $carYear, $carTrans, $carMileage, $carPrice, $productImg, $userId){
        $carMileage = mysqli_real_escape_string($conn, $carMileage);
        $carPrice = mysqli_real_escape_string($conn, $carPrice);
        $productImg = mysqli_real_escape_string($conn, $productImg);

        $sql = "INSERT INTO cars (userId, brand, model, year, transmission, mileage, price, carImg) 
        VALUES ('$userId', '$carBrand', '$carModel', '$carYear', '$carTrans', '$carMileage', '$carPrice', '$productImg')";

        if (mysqli_query($conn, $sql)) {
            header("location: ../index.php?car=added");
            exit();
        } else {
            header("location: ../index.php?error=prodsql");
            exit();
        }
    }


    