$(function () {
  $(".products-category__slider").slick({
    prevArrow:
      '<div class="slider__arrow-container"><div class="product-category__slider-arrowleft"></div></div>',
    nextArrow:
      '<div class="slider__arrow-container"><div class="product-category__slider-arrowright"></div></div>',

    infinite: true,
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1400,
        settings: {
          // arrows: false,
          slidesToShow: 3,
          // dots: true,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 620,
        settings: {
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1,
        },
      },
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ],
  });

  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 1) {
      $(".greet__downarrows").addClass("dn");
    } else {
      $(".greet__downarrows").removeClass("dn");
    }
  });

  // ------------cart.php--------------------------------
  $.ajax({
    dataType: "json",
    url: "./getjson.php",
    mothod: "GET",
    success: function (data) {
      let items = data.length;
      function countTotal() {
        let total = 0;
        for (let i = 0; i < data.length; i++) {
          total += data[i].subtotal;
        }
        return total;
      }
      for (let i = 0; i < data.length; i++) {
        // Значение по умолчанию

        let count = parseInt(data[i].item_quantity);
        let price = parseInt(data[i].product_price);

        let subtotal = 0;

        subtotal = count * price;
        data[i].subtotal = subtotal;

        $(".cart__subtotal" + i).html(subtotal);
        $(".cart__total").html("Итого: " + countTotal() + " р");

        $("#hinput" + i).val(count);
        $("#counting" + i).html(count);

        $("#btn-less" + i).on("click", function (event) {
          event.preventDefault();
          let subtotal = 0;
          if ($("#counting" + i).html() == 0) {
            count = 0;
          } else {
            count -= 1;
          }
          $("#hinput" + i).val(count);
          $("#hinput_post" + i).val(count);
          $("#counting" + i).html(count);

          subtotal = count * price;
          data[i].subtotal = subtotal;

          $(".cart__subtotal" + i).html(subtotal);
          $(".cart__total").html("Итого: " + countTotal() + " р");
        });
        $("#btn-more" + i).on("click", function (event) {
          event.preventDefault();
          let subtotal = 0;
          count += 1;

          $("#hinput" + i).val(count);
          $("#hinput_post" + i).val(count);
          $("#counting" + i).html(count);

          subtotal = count * price;
          data[i].subtotal = subtotal;

          $(".cart__subtotal" + i).html(subtotal);
          $(".cart__total").html("Итого: " + countTotal() + " р");
        });
      }
    },
  });

  // ------------product.choice.php------------------

  // Значение по умолчанию
  let fcount = 1;

  $("#hinput").val(fcount);
  $("#counting").html(fcount);
  $("#btn-less").on("click", function (event) {
    event.preventDefault();
    if ($("#counting").html() == 0) {
      fcount = 0;
    } else {
      fcount -= 1;
    }
    $("#hinput").val(fcount);
    $("#hinput_post").val(fcount);
    $("#counting").html(fcount);
  });
  $("#btn-more").on("click", function (event) {
    event.preventDefault();
    fcount += 1;

    $("#hinput").val(fcount);
    $("#hinput_post").val(fcount);
    $("#counting").html(fcount);
  });

  const params = new URLSearchParams(window.location.search);
  const action = params.get("action");
  const id = params.get("id");

  if (action == "delete") {
    // window.location = "cart.php";
    $("body").append(
      `<div class="delete-alert">Товар удален из корзины!</div>`
    );

    $(".delete-alert").fadeIn(600).fadeOut(1200);
  }

  // -----------burger--------------------
  $(".header__burger").on("click", function () {
    $(
      ".header__burger, .header__burger-content, .header__list-block"
    ).toggleClass("burger-active");
    $("body").toggleClass("lock");
  });

  // -------------adaptive categories----------------------
  $(".products__navigate-topnav").on("click", function () {
    $(".products__navigate-topnav, .products__categories-topnav").toggleClass(
      "active"
    );
  });
});
