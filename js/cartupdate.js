window.onload = function () {
  $("#mediSearch").on("click", "a", function () {
    var anchorVal = $(this).text();
    if (anchorVal.includes("/")) {
      var splitText = anchorVal.split("/");
      $("#productSubmit").val(splitText[0]);
      $("#productSubmit").trigger("input");
    } else {
      $("#productSubmit").val(anchorVal);
      $("#productSubmit").trigger("input");
    }
  });

  $("#mediSearch1").on("click", "a", function () {
    var anchorVal = $(this).text();
    if (anchorVal.includes("&")) {
      var splitText = anchorVal.split(" ");
      $("#productSubmit").val(splitText[0]);
      $("#productSubmit").trigger("input");
    } else {
      $("#productSubmit").val(anchorVal);
      $("#productSubmit").trigger("input");
    }
  });
  //modal control
  $("#modal-close").click(function () {
    myModal.hide();
    location.reload();
  });
  $("#modal-x").click(function () {
    myModal.hide();
    location.reload();
  });

  var elemNum = qtyArr.length;

  //quantity control on user's end
  $("#cart-container").on("click", ".qty-up", function (e) {
    let myId = $(this).attr("id");
    let confirmId = 0;

    Array.from(qtyArr).forEach((number) => {
      if (myId === "qtyUp" + number) {
        confirmId = number;
      }
    });

    // for (let i = 0; i < qtyArr.length; i++) {
    //   if (myId === "qtyUp" + i) {
    //     confirmId = i;
    //   }
    // }

    let $qtyInput = $(".qty #qtyInput" + confirmId);
    if (qtyArr[confirmId] > $qtyInput.val()) {
      $qtyInput.val(function (i, oldval) {
        return ++oldval;
      });
    }
  });

  $("#cart-container").on("click", ".qty-down", function (e) {
    let myId = $(this).attr("id");
    let confirmId = 0;

    Array.from(qtyArr).forEach((number) => {
      if (myId === "qtyUp" + number) {
        confirmId = number;
      }
    });

    // for (let i = 0; i < qtyArr.length; i++) {
    //   if (myId === "qtyDown" + i) {
    //     confirmId = i;
    //   }
    // }

    let $qtyInput = $(".qty #qtyInput" + confirmId);
    if ($qtyInput.val() > 1 && $qtyInput.val() <= qtyArr[confirmId]) {
      $qtyInput.val(function (i, oldval) {
        return --oldval;
      });
    }
  });

  $(document).ready(function () {
    let btnId = 0;
    //buttons for updating/deleting item from cart
    $("#cart-container").on("click", ".delete-btn", function (e) {
      var deleteBtnId = $(this).attr("id");

      Array.from(prodIdArr).forEach((number) => {
        if (deleteBtnId === "delete" + number) {
          btnId = number;
        }
      });

      // for (let i = 0; i < elemNum; i++) {
      //   if (deleteBtnId === "delete" + i) {
      //     btnId = i;
      //   }
      // }
      var deletedItem = prodIdArr[btnId];
      var maxItem = qtyArr[btnId];

      var $qtyUpdate = $(".qty #qtyInput" + btnId).attr;
      //modal update and open
      var modaltitle = $("#exampleModalLabel");
      var modalbody = $("#modalbody");
      var modalok = $("#modalok");
      modaltitle.html("Remove Cart Item");
      modalbody.html("Item Removed");
      modalok.html("Ok");
      myModal.show();
      $("#cart-container").load("components/cartupdate.php", {
        command: "delete",
        action: deletedItem,
        toupdate: "none",
        newprodqty: maxItem,
      });
    });

    $("#cart-container").on("click", ".update-btn", function (e) {
      var updateBtnId = $(this).attr("id");

      Array.from(prodIdArr).forEach((number) => {
        if (updateBtnId === "update" + number) {
          btnId = number;
        }
      });

      // for (let i = 0; i < elemNum; i++) {
      //   if (updateBtnId === "update" + i) {
      //     btnId = i;
      //   }
      // }

      var updateItem = prodIdArr[btnId];

      var $qtyUpdate = $(".qty #qtyInput" + btnId).val();

      var maxItem = qtyArr[btnId];
      var newprodqty = maxItem - $qtyUpdate;
      //modal update and open
      var modaltitle = $("#exampleModalLabel");
      var modalbody = $("#modalbody");
      var modalok = $("#modalok");
      modaltitle.html("Update Cart Item");
      modalbody.html("Item Updated");
      modalok.html("Ok");
      myModal.show();
      $("#cart-container").load("components/cartupdate.php", {
        command: "update",
        action: updateItem,
        toupdate: $qtyUpdate,
        newprodqty: newprodqty,
      });
    });
  });
};

//ajax for featured component
function noStock() {
  var modaltitle = $("#exampleModalLabel");
  var modalbody = $("#modalbody");
  var modalok = $("#modalok");
  modaltitle.html("Add to Cart");
  modalbody.html("Sold Out");
  modalok.html("Ok");
  myModal.show();
}

function haveStock(itemId) {
  if (userID == "" || userName == "") {
    location.href = "/login.php";
  } else {
    $.ajax({
      url: "database/addtocart.php",
      type: "POST",
      data: { usrname: userName, usrid: userID, itemid: itemId },
      success: function (data) {
        var modaltitle = $("#exampleModalLabel");
        var modalbody = $("#modalbody");
        var modalok = $("#modalok");
        modaltitle.html("Add to Cart");
        modalbody.html("Item Added to Cart");
        modalok.html("Ok");
        myModal.show();
      },
    });
  }
}

function checkOut() {
  if (userID == "" || userName == "") {
    location.href = "/";
  } else {
    // $("#cart-container").load("sendtext.php", {
    //   smsbody: smsBody,
    //   smsnet: smsNet,
    // });
    var idGen = new Generator();
    $.ajax({
      url: "/sendtext.php",
      type: "POST",
      data: { smsbody: smsBody, smsnet: smsNet, transactid: idGen },
      success: function (data) {
        console.log(data);
        window.location.href = "paymentsuccess.php";
      },
    });
  }
}

function Generator() {}

Generator.prototype.rand = Math.floor(Math.random() * 26) + Date.now();

Generator.prototype.getId = function () {
  return this.rand++;
};
