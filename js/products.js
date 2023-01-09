$(document).ready(function () {
  $("#productSubmit").on("input", function () {
    var vall = $(this).val();
    $(".products-filter").load("../components/productsmain.php", {
      filtered: vall,
    });
  });
});
