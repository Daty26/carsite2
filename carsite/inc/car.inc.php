<?php
    session_start();
    if(isset($_POST["submit"])){
        $userId = $_SESSION["usersid"];
        $carBrand = $_POST["brand"];
        $carModel = $_POST["model"];
        $carYear = $_POST["year"];
        $carTrans = $_POST["transmission"];
        $carMileage = $_POST['mileage'];
        $carPrice = $_POST["price"];


        $carImgName = $_FILES["img"]["name"];
        $carImgSize = $_FILES["img"]["size"];
        $carImgTmp = $_FILES["img"]["tmp_name"];
        $error = $_FILES["img"]["error"];
        

        require_once "db.inc.php";
        require_once "functions.inc.php";

        // dump($userId);
        // dump($carBrand);
        // dump($carModel);
        // dump($carYear);
        // dump($carTrans);
        // dump($carMileage);
        // dump($carPrice);
        // dump($carImgName);

        if(emptyCar($carBrand, $carModel, $carYear, $carTrans, $carMileage, $carPrice) !== false){
            header("location: ../index.php?error=caremptyinputscar");
            exit();
        }
        if(preg_match('/\.(jpg|jpeg|png|svg)$/', $carImgName)){
            $productImg = insertImg($carImgName, $carImgSize, $carImgTmp, $error);
        }else{
            header("location: ../index.php?error=wrongtypefile");
            exit();
        }
        dump($productImg);
        addCar($conn, $carBrand, $carModel, $carYear, $carTrans, $carMileage, $carPrice, $productImg, $userId);
    }else{
        header("location: ../index.php?error=notsubmitted");
    }