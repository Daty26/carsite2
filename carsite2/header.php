<?php
  session_start();
  ?>
  <script> let loggedIn = false</script>
  <?
  if(isset($_SESSION["usersid"])){
    ?><script>loggedIn = true</script>
    <?
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/reg_forms.css">
    <link rel="stylesheet" href="styles/yearpicker.css">

    <title>CarShop</title>
</head>
    <body>

    <?
        //Login ----------------------------------
    ?>
    <section class="forms" id="auth" style="display: none;">
            <div class="form login">
                <div class="exit-reg" onclick="$('#auth').fadeOut('slow')">
                    <div>
                        <i class='bx bx-x'></i>
                    </div>
                </div>
                <div class="form-content ">
                    <header>Войти</header>


                    <form action="inc/login.inc.php" method="post">
                        <div class="field input-field input-field-login">
                            <input type="text" name="userName" placeholder="Логин/email" class="username">
                        </div>
                        <div class="field input-field input-field-login">
                            <input type="password" name="pass" placeholder="Пароль" class="password">
                            <i class='bx bx-hide'></i>
                        </div>
                        <div class="field button-field" id="button-field-login">
                            <button name="submit">Войти</button>
                        </div>
                        <div class="form-link">
                            <span>Еще нету аккаунта? <a href="#" onclick="closeAuthOpenReg()" class="signup-link link">Создать аккаунт</a></span>
                        </div>
                        <div class="allert">

                            <?php
                            if(isset($_GET["error"])){
                                if (substr($_GET["error"], -2) == "li") {
                                    ?>
                                    <script>
                                        if(window.getComputedStyle(document.querySelector('#auth')).getPropertyValue("display") == "none"){
                                            document.querySelector('#auth').style["display"] = "flex";
                                        }
                                    </script>
                            <?php
                                }
                                    if(isset($_GET["error"])){
                                        if($_GET["error"] == "emptyinputli"){
                                            echo "<p class='red'>Заполните поля</p>";
                                        }
                                        else if($_GET["error"] == "wrongusernameli"){
                                            echo "<p class='red'>Вы ввели неверный логин</p>";
                                        }
                                        else if($_GET["error"] == "wrongpassli"){
                                            echo "<p class='red'>Вы ввели неверный пароль</p>";
                                        }else if($_GET["error"] == "notRegisteredli"){
                                            echo "<p class='red'>Пожайлуста войдите!</p>";
                                        }
                                    }
                            }
                            ?> 
                        </div>
                    </form>

                    
                </div>
            </div>
        </section>


        <?

        //SignUp ----------------------------------
        
        ?>
        <section class="forms" id="reg" style="display: none;">
            <div class="form login">
                <div class="exit-reg" onclick="$('#reg').fadeOut('slow')">
                    <div>
                        <i class='bx bx-x'></i>
                    </div>
                </div>
                <div class="form-content">
                    <header>Регистрация</header>

                    <form action="inc/signup.inc.php" method="post">
                        <div class="field input-field">
                            <input type="text" name="username" placeholder="Логин" class="username">
                        </div>
                        <div class="field input-field">
                            <input type="email" name="email" placeholder="E-mail" class="email">
                        </div>
                        <div class="field input-field">
                            <input type="password" name="pass" placeholder="Пароль" class="password">
                            <i class='bx bx-hide'></i>
                        </div>
                        <div class="field input-field">
                            <input type="password" name="passrep" placeholder="Пароль" class="password">
                            <i class='bx bx-hide'></i>
                        </div>
                        <div class="field button-field">
                            <button name="submit">Зарегестрироваться</button>
                        </div>
                        <div class="form-link">
                            <span>Уже есть аккаунт? <a href="#" onclick="closeRegOpenAuth()" class="login-link link">Войти в аккаунт</a></span>
                        </div>
                        <div class="allert">
                             <?php
                                if(isset($_GET["error"])){
                                    if($_GET["error"] == "none"){
                                        echo "<p class='green'>Вы успешно авторизовались!</p>";
                                        ?>
                                        <script>
                                            if(window.getComputedStyle(document.querySelector('#auth')).getPropertyValue("display") == "none"){
                                                document.querySelector('#auth').style["display"] = "flex";
                                            }
                                        </script>
                                        <?php
                                    }else{
                                        if (substr($_GET["error"], -2) == "su") {
                                        ?>
                                        <script>
                                            if(window.getComputedStyle(document.querySelector('#reg')).getPropertyValue("display") == "none"){
                                                document.querySelector('#reg').style["display"] = "flex";
                                            }
                                        </script>
                                        <?php
                                        }
                                        if($_GET["error"] == "emptyinputsu"){
                                            echo "<p class='red'>Вы заполнили не все поля поля!</p>";
                                        }
                                        else if($_GET["error"] == "wrongloginsu"){
                                            echo "<p class='red'>Введите подходящий логин!</p>";
                                        }
                                        else if($_GET["error"] == "wrongemailsu"){
                                            echo "<p class='red'>Введите подходящий email!</p>";
                                        }
                                        else if($_GET["error"] == "passdontmatchsu"){ 
                                            echo "<p class='red'>Пароли не соотвествуют друг к другу!</p>";
                                        }
                                        else if($_GET["error"] == "loginexistssu"){
                                            echo "<p class='red'>Такой логин уже существует!</p>";
                                        }
                                        else if($_GET["error"] == "stmtfailedsu"){
                                            echo "<p class='red'>Произошла техническая ошибка!</p>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </section>



        <?
            //Add car
        ?>
        <section class="forms" id="addCar" style="display: none;">
            <div class="form login">
                <div class="exit-reg" onclick="$('#addCar').fadeOut('slow')">
                    <div>
                        <i class='bx bx-x'></i>
                    </div>
                </div>
                <div class="form-content">
                    <header>Подать объявление</header>

                    <form action="inc/car.inc.php" class="car-forms" method="post" enctype="multipart/form-data">
                        <div class="field select">
                            <select name="brand" class="form-select carAddSelect brand-select">
                                <option value="" >Выберите бренд</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Honda">Honda</option>
                                <option value="Bmw">BMW</option>
                                <option value="Mercedes">Mercedes</option>
                                <option value="Lexus">Lexus</option>
                            </select>
                        </div>
                        <div class="field select">
                            <select name="model" class="form-select carAddSelect model-select">
                                <option value="" >Выберите модель</option>
                            </select> 
                        </div>
                        <div class="field input-field">
                            <input type="text" placeholder="Выберите год выпуска" name="year" class="yearpicker form-control" value="" />
                        </div>
                        <div class="field select">
                            <select name="transmission" class="form-select">
                                <option value="">Коробка передач</option>
                                <option value="auto">Автомат</option>
                                <option value="manual">Механика</option>
                                <option value="variator">Вариатор</option>
                                <option value="robot">Робот</option>
                            </select> 
                        </div>
                        <div class="field input-field">
                            <input type="number" name="mileage" min="0" step="0" placeholder="Пробег" class="form-control" value="" />
                        </div>
                        <div class="field input-field">
                            <input type="number" min="1" name="price" step="0" placeholder="Цена" class="form-control" value="" />
                        </div>
                        <div class="field input-field">
                            <input type="file" class="w3-input" id="img" name="img" style="padding-top: 6px;">
                        </div>
                        <div class="field button-field">
                            <button name="submit">Добавить машину</button>
                        </div>
                        <div class="allert">
                             <?php
                                if(isset($_GET["error"])){
                                    if($_GET["error"] == "none"){
                                        echo "<p class='green'>Вы успешно добавили машину!</p>";
                                        ?>
                                        <script>
                                            if(window.getComputedStyle(document.querySelector('#auth')).getPropertyValue("display") == "none"){
                                                document.querySelector('#auth').style["display"] = "flex";
                                            }
                                        </script>
                                        <?php
                                    }else{
                                        if (substr($_GET["error"], -3) == "car") {
                                        ?>
                                        <script>
                                            if(window.getComputedStyle(document.querySelector('#addCar')).getPropertyValue("display") == "none"){
                                                document.querySelector('#addCar').style["display"] = "flex";
                                            }
                                        </script>
                                        <?php
                                        }
                                        if($_GET["error"] == "caremptyinputscar"){
                                            echo "<p class='red'>Вы заполнили не все поля поля!</p>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </form>


                </div>
            </div>
        </section>
        

        
        <div class="container fixed-top">
          <nav class="navbar navbar-expand-md navbar-light justify-content-between">
            <a href="index.php" class="navbar-brand mb-o h1">FuelFlip</a>
            <button type="button"data-bs-toggle="collapse" aria-controls="navbarNav"aria-expanded="false" aria-label="Посмотреть навигацию" data-bs-target="#navbarNav" class="navbar-toggler">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a href="#home" class="nav-link">
                    Главная
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#filter" class="nav-link">
                    Фильтры
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#car" class="nav-link">
                    Машины
                  </a>
                </li>
              </ul>
            </div>
            <div id="loginbutt" style="margin-right: 0px;"> 
              <i class='bx bx-user'></i>
            </div>
            <ul class="user-items" style="display: none;">
                <?php
                    if(!isset($_SESSION["usersid"])){
                ?>
                <li class="sub-item log-in">
                    <span class="si-item"> <i class='bx bx-log-in-circle'></i></span>
                    <p>Войти</p>
                </li>
                <?php
                    }
                ?>
                <?php
                    if(isset($_SESSION["usersid"])){
                        echo "<li class='sub-item add-car' onclick='fadeInCar()'>
                        <span class='si-item'> <i class='bx bx-plus-circle'></i></span>
                        <p>Добавить</p>
                    </li>
                    <a href='inc/logout.inc.php'> 
                        <li class='sub-item log-out'>
                            <span class='si-item'> <i class='bx bx-log-out-circle' ></i></span>
                            <p>Выйти</p>
                        </li>
                    </a>
                    ";
                }?>
            </ul>
          </nav>
        </div>