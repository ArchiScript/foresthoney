<?php session_start();
require_once "functions.php";
require_once "catalog.php";

if (!(isset($_SESSION["cart"]))) {
    $_SESSION["cart"] = array();

}
if (isset($_POST["clear_cart"])) {$_SESSION["cart"] = array();}

if (isset($_POST["add"])) {
    if (isset($_SESSION["cart"])) {
      
      
           $item_array_id = array_column($_SESSION["cart"], "product_id");
        if (!in_array($_POST["hidden_id"], $item_array_id)) {
            
            $count = count($_SESSION["cart"]);
            $item_array = array(
                'product_id'    => $_GET["id"],
                'item_quantity' => $_POST["quantity"],
                'product_price' => $_POST["hidden_price"],
            );

            $_SESSION["cart"]["$count"] = $item_array;
            $count += 1;
            // echo '<script>window.location="cart.php"</script>';
            
        } else {
            echo '<script>alert("Товар уже добавлен в корзину")</script>';
            echo '<script>window.location="cart.php</script>';
        }
    } else {
        
        $item_array = array(
            'product_id'    => $_POST["hidden_id"],
            'item_quantity' => $_POST["quantity"],
            'product_price' => $_POST["hidden_price"],
        );
        $_SESSION["cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
      
        foreach ($_SESSION["cart"] as $keys => $value) {
            if ($value["product_id"] == $_GET["id"]) {
               
               unset($_SESSION["cart"][$keys]);
                
                $_SESSION["cart"] = array_values($_SESSION["cart"]);
                
                
            }
        }
    }
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
  <title><?php echo "Медонос | Корзина"; ?></title>
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
          Продолжить покупки
          <div class="products__categories-topnav">
            <a id="allproducts_link" href="products.php?category=0">Все товары</a>
            <ul class="category_menu">
              <?php echo $categories_menu; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="product__title section__title">
        <?php
$count_loc = count($_SESSION["cart"]);
if ($count_loc == 0) {echo "Ваша корзина пуста";} elseif ($count_loc == 1) {echo "В вашей корзине " . $count_loc . " товар";} elseif ($count_loc < 5) {echo "В вашей корзине " . $count_loc . " товара";} elseif ($count_loc > 5) {echo "В вашей корзине " . $count_loc . " товаров";}

?>
      </div>
      <div class="content-inner">
        <?php if($count_loc ==0){echo "<div class='content-inner__emptycartimg'>
         
        </div>";} ?>
        <!--  <img src='img/sadEmptycart.png'> -->
        <div class="products__navigate">

          <div class="products__categories">
            <a id="allproducts_link" href="products.php?category=0">Все товары</a>
            <ul class="category_menu">
              <?php echo $categories_menu; ?>
            </ul>
          </div>

        </div>


        <div class="cart__table">
          <!-- <a href='products.php?category=0'>Продолжить покупки</a> -->


          <form class="cart__clear-form <?php if($count_loc == 0){echo "dn";} ?>" method="post" action="cart.php"><input
              class="button" name="clear_cart" type="submit" value="очистить корзину">
          </form>

          <?php
if (!empty($_SESSION["cart"])) {
 
    $total = 0;
    foreach ($_SESSION["cart"] as $key => $value) {
        $subtotal = 0;
        $chosenprod = get_product($value["product_id"]);
       

        ?>
          <div class="cart__table">
            <div class="cart__item">
              <div class="products__product ">
                <div class="products__product-img"><img src="<?=$chosenprod->img?>" alt=""></div>
                <div class="products__product-title-group">
                  <div class="products__product-title"><?=$chosenprod->prodname?>
                  </div>
                  <div class="products__product-subtitle"><?=$chosenprod->harvestdate?></div>
                </div>
                <div class="products__product-price-group">
                  <div class="products__product-rating">
                    <span class="fa fa-star <?php if ($chosenprod->rating >= 1) {echo "checked";}?>"></span>
                    <span class="fa fa-star <?php if ($chosenprod->rating >= 2) {echo "checked";}?>"></span>
                    <span class="fa fa-star <?php if ($chosenprod->rating >= 3) {echo "checked";}?>"></span>
                    <span class="fa fa-star <?php if ($chosenprod->rating >= 4) {echo "checked";}?>"></span>
                    <span class="fa fa-star <?php if ($chosenprod->rating >= 5) {echo "checked";}?>"></span>
                  </div>
                  <div class="products__product-price"><?=$chosenprod->price?> р/кг</div>
                  <div
                    class="products__product-stock <?php if ($chosenprod->stock < 3) {echo "out-ofstock";} else {echo "in-stock";}?>"><?php
                    if ($chosenprod->stock < 3) {echo "заканчивается";} else {echo "в наличии";}
                      ?>

                  </div>
                </div>
              </div>

              <div class="cart__details">
                <div class="cart__clear-item"><a
                    href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?> ">Удалить товар</a></div>
                <div class="cart__quantity">

                  <form method="get" action="cart.php" class="add-form">

                    <button id="btn-less<?=$key?>" name="less_button">-</button>
                    <label for="hinput" id="counting<?=$key?>" class="quan-label"></label>
                    <input type="hidden" name="quantity" id="hinput<?=$key?>" value="">
                    <button id="btn-more<?=$key?>">
                      +</button>

                  </form>
                </div>



                <div class="cart__subtotal<?=$key?>">

                </div>
              </div>
            </div>

          </div>
          <?php

    } ?>
          <div class="cart__total">
          </div>
          <?php
  }
  ?>

          <div class="<?php if($count_loc ==0){echo "cart-count0";}else{ echo "order";} ?>">
            <div class="order__title"></div>
            <p>Оформление заказа:</p>
            <form action="mail.php" class="order__form form"><input type="name" name="name" placeholder="Имя"><input
                type="email" placeholder="Электронная почта" name="email"><input type="text"
                placeholder="Адрес доставки">
              <input type="tel" placeholder="Номер телефона">
              <input type="submit" class="button" value="Оформить заказ"></form>
          </div>


        </div>


      </div>

    </div>
    <?php include "footer.php";?>
  </div>
  <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
  <script src="js/libs.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>