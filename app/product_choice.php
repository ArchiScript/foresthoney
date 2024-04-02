<?php
session_start();
require_once "functions.php";
require_once "catalog.php";

if (isset($_GET['product'])) {
    $product_id = (int) $_GET['product'];
    $prod       = get_product($product_id);
   
}
if(empty($_SESSION["cart"])){
  $_SESSION["cart"]= array();
}
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
  <title><?php echo "Медонос | " . $prod->prodname; ?></title>
</head>

<body>
  <div class="wrapper">
    <?php include "header.php";?>

    <div class="content-main">

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


      <div class="content-inner">
        <div class="products__navigate">

          <div class="products__categories">
            <a id="allproducts_link" href="products.php?category=0">Все товары</a>
            <ul class="category_menu">
              <?php echo $categories_menu; ?>
            </ul>
          </div>

        </div>

        <div class="product__item">

          <div class="product__inner">
            <div class="product__title section__title"><?=$prod->prodname;?></div>
            <div class="product__img"><img src="<?=$prod->img;?>" alt=""></div>
            <div class="product__price"><?=$prod->price;?> р/кг</div>
            <div class="product__product-rating">
              <span class="fa fa-star <?php if ($prod->rating >= 1) {echo "checked";}?>"></span>
              <span class="fa fa-star <?php if ($prod->rating >= 2) {echo "checked";}?>"></span>
              <span class="fa fa-star <?php if ($prod->rating >= 3) {echo "checked";}?>"></span>
              <span class="fa fa-star <?php if ($prod->rating >= 4) {echo "checked";}?>"></span>
              <span class="fa fa-star <?php if ($prod->rating >= 5) {echo "checked";}?>"></span>
            </div>
            <div class="product__description"><?=$prod->description;?></div>
          </div>


          <form method="post" action="cart.php?action=add&id=<?=$prod->id;?>&category=<?=$prod->category_id;?>"
            class="add-form">
            <input type="hidden" class="form__hidden-id" name="hidden_id" value="<?=$prod->id;?>">
            <input type="hidden" class="form__hidden-price" name="hidden_price" value="<?=$prod->price;?>">
            <button id="btn-less" name="less_button">-</button>
            <label for="hinput" id="counting" class="quan-label"></label>
            <input type="hidden" name="quantity" id="hinput" value="">
            <button id="btn-more">
              +</button>
            <input type="submit" name="add" value="Добавить в корзину" class=" button">
          </form>

          <div class="add-message">
            <!-- <p>Продукт добавлен в корзину</p> -->
            <p> <a href="cart.php">Показать корзину</a></p>
          </div>

        </div>
      </div>
    </div>
    <?php include "footer.php";?>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/libs.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>