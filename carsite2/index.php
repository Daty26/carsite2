<?php
  include_once "header.php";
  include_once "inc/db.inc.php";
  $limit = 9; 
  $page = isset($_GET['page']) ? $_GET["page"] : 1;
  $start = ($page - 1) * $limit;

  $res1 = mysqli_query($conn, "SELECT count(carsId) AS cars FROM cars");
  $carCount = mysqli_fetch_assoc($res1);
  $total = $carCount['cars'];
  $pages = ceil($total / $limit);
  

  if(isset($_GET['page'])){
    echo "<script>
            window.onload = function() {
              let mainSection = document.getElementById('car');
              mainSection.scrollIntoView({ behavior: 'smooth' });
            };
          </script>";
  }



?>
        <section id="home">
          <div class="container">
            <div class="d-flex h-100 homeCont">
              <div class="homeTitle">
                <h1>Продайте свою машину <br> за секунду </h1>
                <p class="mt-4">Мы являемся самой крупной компанией по продаже б/у машин в Казахстане</p>
                <a href="#car"><button class="viewButton mt-4">Посмотреть машины</button></a>
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
                <form action="fetch_cars.php" method="GET" class="car-forms" onsubmit="return validateForm()">
                  <select name="brand" class="form-select filter-select text-center brand-select" id="brandFilter">
                      <option value="">Выберите бренд</option>
                      <option value="Toyota">Toyota</option>
                      <option value="Honda">Honda</option>
                      <option value="BMW">BMW</option>
                      <option value="Mercedes">Mercedes</option>
                      <option value="Lexus">Lexus</option>
                  </select>
                  <select name="model" class="form-select filter-select text-center model-select" id="modelFilter">
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
                    $res = mysqli_query($conn, "SELECT * FROM `cars` LIMIT $start, $limit");
                    while($row = mysqli_fetch_assoc($res)){
                        $carId = $row['carsId'];
                        $userId = $row['userId'];
                        $brand = $row['brand'];
                        $model = $row['model'];
                        $year = $row['year'];
                        $transmission = $row['transmission'];
                        $mileage = $row['mileage'];
                        $mil = number_format($mileage, 0, '', ' ');
                        $price = $row['price'];
                        $num = number_format($price, 0, '', ' ');
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
                        <a href='car_details.php?id=$carId' class='hrefRemove'>
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
                                    $num ₸
                                </div>
                                <div class='carDescr'>
                                    <div class='carDescrItem py-3'>
                                        <div class='icon'>
                                            <i class='bx bx-run'></i>
                                        </div>
                                        <div class='carDescrName'>
                                            <p class='type text-cente'>Пробег</p>
                                            <span class='name text-center'>$mil км</span>
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
                        </a>
                    </div>";
                    }
                ?>


                <!-- <div class="carItemCorr">
                  <div class="carItem">
                      <div class="carItemCont">
                      <div class="ci-image" style="background-image:url('img/161011-kia-red-free-transparent-image-hq.png');">
                        </div>
                      </div>
                      <div class="ciBody">
                        <div class="ciName">
                          <h3 class="my-3">
                            Kia Seltos 2017
                          </h3>
                        </div>
                        <div class="ciPrice">
                          $27,000 
                        </div>
                        <div class="carDescr">
                          <div class="carDescrItem py-3">
                            <div class="icon">
                            <i class='bx bxs-gas-pump' ></i>  
                            </div>
                            <div class="carDescrName">
                              <p class="type text-cente">Пробег</p>
                              <span class="name text-center">50 км</span>
                            </div>
                          </div>
                          <div class="carDescrItem right py-3">
                            <div class="icon">
                              <i class='bx bxs-map-pin' ></i>
                            </div>
                            <div class="carDescrName">
                              <p class="type text-center">КПП</p>
                              <span class="name text-center">Автомат</span>
                            </div>
                          </div>
                        </div>
                        <div class="carLine my-4"></div>
                        <div class="more">
                          <button class="btn">Подробнее</button>
                        </div>
                      </div>
                  </div>
                </div> -->


                
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="?page=<?php echo ($page-1); ?>">Previous</a></li>
                  <?php for($i = 1; $i<= $pages; $i++){ ?>
                  <li class="page-item <?php if($page == $i){ echo 'active'; } ?>"><a class="page-link" href="?page=<?= $i;?>"><?= $i;?></a></li>
                  <?php } ?>
                  <li class="page-item <?php if($page >= $pages){ echo 'disabled'; } ?>"><a class="page-link" href="?page=<?php echo ($page+1); ?>">Next</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </section>
        <?php
        include_once "footer.php";
        ?>