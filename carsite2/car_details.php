<?php
  include_once "header.php";
  include_once "inc/db.inc.php";

  $carId = isset($_GET['id']) ? $_GET['id'] : '';

  $sql = "SELECT * FROM `cars`";
  if (!empty($carId)) {
      $sql .= " WHERE `carsId` = '$carId'";
  }
  $res = mysqli_query($conn, $sql);

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
        <section id="car">
          <div class="container">
            
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
