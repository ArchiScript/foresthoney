<?php if(isset($_SESSION["cart"])){
  
  $items = count($_SESSION["cart"]);
  } ?>
<header class="header">
  <div class="container">
    <div class="header__inner">
      <div class="header__logo"><a href="index.php"><img src="img/logo.png" alt=""></a></div>
      <div class="header__nav">
        <div class="header__list-block">
          <ul class="header__list">
            <li class="header__list-item"><a href="products.php?category=0">Продукты</a></li>
            <li class="header__list-item"><a href="">Сертификаты</a></li>
            <li class="header__list-item"><a href="">Доставка</a></li>
            <li class="header__list-item"><a href="">Контакты</a></li>
            <li class="header__list-item"><a href="">Обратная связь</a></li>

          </ul>
        </div>

        <div class="header__rest">
          <div class="cart-img"><a href="cart.php"></a><span
              class="<?php echo $items?"cart-count":"cart-count0"?>"><?=$items?></span></div>
          <div class="header__burger">
            <div class="header__burger-content"></div>
          </div>
        </div>

      </div>

    </div>

  </div>
  <div class="bee3 bee">
  </div>

</header>