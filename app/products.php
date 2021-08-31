<?php session_start();
include "functions.php";
include "catalog.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="apple-touch-icon" sizes="180x180" href="img/ico/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="img/ico//favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="img/ico//favicon-16x16.png">
  <link rel="manifest" href="img/ico//site.webmanifest">
  <link rel="mask-icon" href="img/ico//safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <title><?php echo "Медонос | ". $active_link; ?></title>
</head>

<body>
  <div class="wrapper">
    <?php include "header.php"?>

    <div class="products container">

      <div class="products__content-topnav">

        <div class="products__breadcrumbs">
          <!-- Хлебные крошки -->
          <?=$breadcrumbs?> </div>
        <div class="products__navigate-topnav ">

          Выбрать категорию
          <div class="products__categories-topnav">
            <a id="allproducts_link" href="products.php?category=0">Все товары</a>
            <ul class="category_menu">
              <?php echo $categories_menu; ?>
            </ul>
          </div>
        </div>
      </div>


      <div class="products__inner-section">
        <div class="products__navigate">

          <div class="products__categories">
            <a id="allproducts_link" href="products.php?category=0">Все товары</a>
            <ul class="category_menu">
              <?php echo $categories_menu; ?>
            </ul>
          </div>

        </div>
        <div class="products__content-section">
          <div class="products__title section__title"><?php
                echo $active_link;
              ?></div>
          <div class="products__content">

            <?php

                  for ($i = 0; $i <= (count($arr) - 1); $i++) { 
                  $prod_category = $arr[$i]->category_id;
                  $prod_id = $arr[$i]->id;
                  $prodname=$arr[$i]->prodname;
                  $cat = $arr[$i]->category;
                  $stock = $arr[$i]->stock;
                  $price = $arr[$i]->price;
                  $img = $arr[$i]->img;
                  $harvestdate = $arr[$i]->harvestdate;
                  $rating = $arr[$i]->rating;

                  ?>

            <div class="products__product product">
              <div class="products__product-img"><img src="<?php echo $img ?>" alt=""></div>
              <div class="products__product-title-group">
                <div class="products__product-title"><a target="_blank"
                    href="product_choice.php?category=<?=$prod_category?>&product=<?=$prod_id?>"><?php echo $prodname ?></a>
                </div>
                <div class="products__product-subtitle"><?php echo $harvestdate ?></div>
              </div>
              <div class="products__product-price-group">
                <div class="products__product-rating">
                  <span class="fa fa-star <?php if ($rating >= 1) {echo "checked";}?>"></span>
                  <span class="fa fa-star <?php if ($rating >= 2) {echo "checked";}?>"></span>
                  <span class="fa fa-star <?php if ($rating >= 3) {echo "checked";}?>"></span>
                  <span class="fa fa-star <?php if ($rating >= 4) {echo "checked";}?>"></span>
                  <span class="fa fa-star <?php if ($rating >= 5) {echo "checked";}?>"></span>
                </div>
                <div class="products__product-price"><?php echo $price; ?> р/кг</div>
                <div
                  class="products__product-stock <?php if ($stock < 3) {echo "out-ofstock";} else {echo "in-stock";}?>"><?php
                    if ($stock < 3) {echo "заканчивается";} else {echo "в наличии";}
                      ?>
                </div>

              </div>
            </div>

            <?php };?>

          </div>
        </div>

      </div>


    </div>
    <div class="products__count">
      <?php echo "Найдено товаров: " . count($arr); ?>
    </div>

    <?php include "footer.php"?>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/libs.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>