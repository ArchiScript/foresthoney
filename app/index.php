<?php session_start();
include "functions.php";
require_once "Connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Медонос | Главная</title>
   <link rel="stylesheet" href="css/style.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="apple-touch-icon" sizes="180x180" href="img/ico/apple-touch-icon.png">
   <link rel="icon" type="image/png" sizes="32x32" href="img/ico//favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="16x16" href="img/ico//favicon-16x16.png">
   <link rel="manifest" href="img/ico//site.webmanifest">
   <link rel="mask-icon" href="img/ico//safari-pinned-tab.svg" color="#5bbad5">
   <meta name="msapplication-TileColor" content="#da532c">
   <meta name="theme-color" content="#ffffff">
</head>

<body>
   <div class="wrapper">
      <?php include "header.php"?>
      <div class="greet" style="background-image: url('img/headerbg.png');">
         <div class="greet__container">
            <div class="greet__honey-dipper"></div>
            <div class="greet__box">
               <div class="greet__box-inner container">
                  <div class="greet__info">
                     <div class="greet__info-imgtitle"><img src="img/titleimg.png" alt=""></div>
                     <h1 class="greet__info-title">лесной мёд</h1>
                     <h2 class="greet__info-subtitle">Природные дары лесной пасеки</h2>
                     <div class="button greet__info-button"><a href="products.php?category=1">Отведать</a></div>
                  </div>
               </div>


            </div>
            <div class="greet__image">
               <img class="greet__honeyset" src="img/honeyset.png" alt="">
               <img class="bee bee1" src="img/bee1.png" alt=""><img class="bee bee2" src="img/bee2.png" alt=""></div>
            <div class="greet__downarrows"><img src="img/downarrows.svg" alt=""></div>
         </div>
      </div>
      <section class="products-category ">
         <div class="container">
            <div class="products-category__title section__title">Наша продукция</div>
            <div class="products-category__slider">
               <a href="products.php?category=5">
                  <div class="products-category__item">
                     <div class="product-category-title">Перга</div>
                     <img src="img/perga.png" alt="" class="products-category__img">
                  </div>
               </a>
               <a href="products.php?category=3">
                  <div class="products-category__item">
                     <div class="product-category-title">Мёд в сотах</div>
                     <img src="img/honeypieces.png" alt="" class="products-category__img">
                  </div>
               </a>
               <a href="products.php?category=1">
                  <div class="products-category__item">
                     <div class="product-category-title">Жидкий мед</div>
                     <img src="img/lighthoney.png" alt="" class="products-category__img">
                  </div>
               </a>
               <a href="products.php?category=2">
                  <div class="products-category__item">
                     <div class="product-category-title">Гомогенат</div>
                     <img src="img/gomogenate.png" alt="" class="products-category__img">
                  </div>
               </a>
               <a href="products.php?category=4">
                  <div class="products-category__item">
                     <div class="product-category-title">Медовые миксы</div>
                     <img src="img/mix.png" alt="" class="products-category__img">
                  </div>
               </a>
               <a href="products.php?category=6">
                  <div class="products-category__item">
                     <div class="product-category-title">Воск</div>
                     <img src="img/wax.png" alt="" class="products-category__img">
                  </div>
               </a>
            </div>
         </div>

      </section>
      <section class="popular section__format">
         <div class="overlay"></div>
         <div class="container">
            <div class="popular__title section__title">Самые популярные товары</div>
            <div class="popular__products">
               <?php
      $con = new Connection();
      $arr =$con->queryObj("SELECT * FROM `honeyproducts` WHERE `rating` = 5 ORDER BY `price` DESC LIMIT 5");
      for ($i = 0; $i <= count($arr) - 1; $i++) {
         $id = $arr[$i]->id;
         $cat_id = $arr[$i]->category_id;
         $prodname    = $arr[$i]->prodname;
         $cat         = $arr[$i]->category;
         $stock       = $arr[$i]->stock;
         $price       = $arr[$i]->price;
         $img         = $arr[$i]->img;
         $harvestdate = $arr[$i]->harvestdate;
         $rating      = $arr[$i]->rating;
     
         ?>

               <div class="popular__product product">
                  <div class="popular__product-img"><img src="<?php echo $img ?>" alt=""></div>
                  <div class="popular__product-title"><a
                        href="product_choice.php?category=<?=$cat_id?>&product=<?=$id?>"><?php echo $prodname ?></a>
                  </div>
                  <div class="popular__product-subtitle"><?php echo $harvestdate ?></div>

                  <div class="popular__product-price-group">
                     <div class="popular__product-rating">
                        <span class="fa fa-star <?php if ($rating >= 1) {echo "checked";}?>"></span>
                        <span class="fa fa-star <?php if ($rating >= 2) {echo "checked";}?>"></span>
                        <span class="fa fa-star <?php if ($rating >= 3) {echo "checked";}?>"></span>
                        <span class="fa fa-star <?php if ($rating >= 4) {echo "checked";}?>"></span>
                        <span class="fa fa-star <?php if ($rating >= 5) {echo "checked";}?>"></span>
                     </div>
                     <div class="popular__product-price"><?php echo $price; ?> р/кг</div>
                     <div
                        class="popular__product-stock <?php if ($stock < 3) {echo "out-ofstock";} else {echo "in-stock";}?> out-ofstock"><?php
                      if ($stock < 3) {echo "заканчивается";} else {echo "в наличии";}
      ?></div>
                  </div>
               </div>
               <?php } ?>

            </div>
         </div>

      </section>
      <section class="media ">
         <div class="container">

            <div class="media__articles "><span class="section__title">Статьи</span>
               <div class="media__articles-item">
                  <div class="media__article-title ">Осмотр пчелиной семьи</div>
                  <div class="media__article-frame">
                     <div class="media__article-img"><img src="img/beesonframe.png" alt=""></div>
                     <div class="media__article-content">
                        <div class="media__article-txt">Пчелиные семьи осматривать в определенной последовательности:
                           1. К улью надо подходить сбоку, «из-под солнца», для лучшей видимости.
                           2. Дымарем впустите в леток несколько клубов дыма. Сколько? ...</div>
                        <div class="media__article-button button"><a href="#">Читать далее..</a></div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="media__video "><span class="section__title"> ВИДЕООБЗОРЫ</span>

               <div class="media__video-item">
                  <div class="media__video-title">Обработка улья от болезней</div>
                  <div class="media__video-vid"><img src="img/beekeeper.png" alt=""></div>
               </div>
            </div>
         </div>
      </section>
      <?php include "footer.php"?>

   </div>


   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="js/libs.min.js"></script>
   <script src="js/main.js"></script>
</body>

</html>