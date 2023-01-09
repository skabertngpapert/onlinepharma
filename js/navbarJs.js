$(function () {
  cartCount();
  $(".navbar-toggler-icon").css({
    "background-image": "url(../img/toggler2.png)",
  });
});

$("#togglerEffect").on("click", function () {
  if ($("#togglerEffect").hasClass("collapsed")) {
    $(".navbar-toggler-icon").css({
      "background-image": "url(../img/toggler2.png)",
    });
  } else {
    $(".navbar-toggler-icon").css({
      "background-image": "url(../img/toggler.png)",
    });
  }
});

function cartCount() {
  $("#navbarSupportedContent #autoCartData").load("components/cartcount.php");
  setTimeout(cartCount, 1000);
}
