<?php
  include_once "header.php";
  include_once "inc/db.inc.php";

  $brand = isset($_GET['brand']) ? $_GET['brand'] : '';
  $model = isset($_GET['model']) ? $_GET['model'] : '';

  $sql = "SELECT * FROM `cars`";
  if (!empty($brand)) {
      $sql .= " WHERE `brand` = '$brand'";
      if (!empty($model)) {
          $sql .= " AND `model` = '$model'";
      }
  }
  $res = mysqli_query($conn, $sql);
  $no_matches = true;


?>
        <section id="home">
          <div class="container">
            <div class="d-flex h-100 homeCont">
              <div class="homeTitle">
                <h1>Продайте свою машину <br> за секунду </h1>
                <p class="mt-4">Мы являемся самой крупной компанией по продаже б/у машин в Казахстане</p>
                <button class="viewButton mt-4">Посмотреть машины</button>
              </div>
              <div class="mainImg">
                <img src="img/purepng.com-tesla-model-s-red-carcarvehicletransporttesla-961524657832miq7l.png" width="720px">
            </div>
            </div>
          </div>
        </section>
        <section id="filter">
          <div class="container">
            <div class="py-5 d-flex justify-content-center">
              <div class="filterCont">
                <h3 class="text-center my-5">Найдите машину по бренду</h3>
                <form action="fetch_cars.php" method="GET" class="car-forms" onsubmit="return validateForm1()">
                  <select name="brand" class="form-select filter-select text-center brand-select" id="brandFilter1">
                      <option value="">Выберите бренд</option>
                      <option value="Toyota">Toyota</option>
                      <option value="Honda">Honda</option>
                      <option value="BMW">BMW</option>
                      <option value="Mercedes">Mercedes</option>
                      <option value="Lexus">Lexus</option>
                  </select>
                  <select name="model" class="form-select filter-select text-center model-select" id="modelFilter1">
                      <option value="">Выберите модель</option>
                  </select>
                  <button type="submit" class="btn filterBtn" id="showCount">Показать</button>
                </form>
              </div>
            </div>
          </div>
        </section>
        <section id="car">
          <div class="container">
            <div class="col-md-12 my-5 mainTitle">
              <p>Доверяемый сайт по продаже авто</p>
              <h2>Все обьявления</h2>
              <div class="carItems my-5">

                <?php 
                    while($row = mysqli_fetch_assoc($res)){
                        $no_matches = false;
                        $brand = $row['brand'];
                        $model = $row['model'];
                        $year = $row['year'];
                        $transmission = $row['transmission'];
                        $mileage = $row['mileage'];
                        $price = $row['price'];
                        $carImg = $row['carImg'];
                        if($transmission == "auto"){
                          $autot = "Автомат";
                        }elseif($transmission == "manual"){
                          $autot = "Механика";
                        }elseif($transmission == "variator"){
                          $autot = "Вариатор";
                        }elseif($transmission == "robot"){
                          $autot = "Робот";
                        }
                        echo "<div class='carItemCorr'>
                        <div class='carItem'>
                            <div class='carItemCont'>
                                <div class='ci-image' style='background-image:url(\"img/$carImg\");'>
                                </div>
                            </div>
                            <div class='ciBody'>
                                <div class='ciName'>
                                    <h3 class='my-3'>
                                        $brand $model $year 
                                    </h3>
                                </div>
                                <div class='ciPrice'>
                                    $price ₸
                                </div>
                                <div class='carDescr'>
                                    <div class='carDescrItem py-3'>
                                        <div class='icon'>
                                            <i class='bx bx-run'></i>
                                        </div>
                                        <div class='carDescrName'>
                                            <p class='type text-cente'>Пробег</p>
                                            <span class='name text-center'>$mileage км</span>
                                        </div>
                                    </div>
                                    <div class='carDescrItem right py-3'>
                                        <div class='icon'>
                                            <i class='bx bxs-map-pin'></i>
                                        </div>
                                        <div class='carDescrName'>
                                            <p class='type text-center'>КПП</p>
                                            <span class='name text-center'>$autot</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }
                    if ($no_matches) {
                        echo "<span class='noMatches'>There are no matches.</span>";
                    }
                ?>


                
              </div>
            </div>
          </div>
        </section>
            <script>
                window.onload = function() {
                    let mainSection = document.getElementById('car');
                    mainSection.scrollIntoView({ behavior: 'smooth' });
                };
            </script>
        <?php
        include_once "footer.php";
        ?>
