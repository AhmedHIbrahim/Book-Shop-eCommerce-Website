console.log(document.location.pathname);
if (document.location.pathname == "/ecommerce_website/yourBasket.php") {
  // Process Basket Books

  function updateTotalBasketPrice() {
    var totalPrice = 0;
    if (basket_books !== "undefined") {
      if (basket_books.length > 0) {
        for (var i = 0; i < basket_books.length; i++) {
          var book = basket_books[i];
          totalPrice =
            totalPrice +
            parseInt(basket_books[i]["price"]) *
              parseInt(basket_books[i]["count"]);
        }
        document.getElementById("basketTotalPrice").value =
          "Total:  " + totalPrice + "$";
        return totalPrice;
      }
    }
  }

  console.log(updateTotalBasketPrice());
}

//JQuery code is here!
$(document).ready(function () {
  // Temp Storage

  $(".offeredBook").click(function (e) {
    // Getting the book name from its image cover
    var bookName = $(this).attr("title");

    $.ajax({
      url: "load-book-details.php",
      method: "POST",
      data: { pressedBookName: bookName },
      datatype: "JSON",
      success: function (data) {
        $(".detailsHolder").css("display", "block");
        $(".main").css("width", "70%");
        var data = JSON.parse(data);
        $("#bookImg").attr("src", data.imgurl);
        $("#bookName").text(data.name);
        $("#bookCategory").text(data.category);
        $("#bookPrice").text(data.price);
        $("#bookInfo").text(data.info);
      },
    });
  });
  //Homepage buttons
  $("#button-hide").click(function () {
    $(".detailsHolder").css("display", "none");
    $(".main").css("width", "auto");
  });

  $("#addCartBtn").click(function () {
    var bookname = $("#bookName").text();
    console.log(bookname);
    if (bookname != "") {
      $.ajax({
        url: "addToBasketDB.php",
        method: "POST",
        data: { bookname: bookname },
        datatype: "JSON",
        success: function (data) {
          var data = JSON.parse(data);
          alert(data.message);
        },
      });
    } else {
      alert("Book is not found");
    }
  });

  //Personal Page buttons
  $("#searchBookBtn").click(function () {
    var formname = $("#searchBookDb").val();
    var bId = $("#books_list").val();
    console.log(formname);
    if (bId != "") {
      $.ajax({
        url: "updateBookDB.php",
        method: "POST",
        data: { id: bId, formname: formname },
        datatype: "JSON",
        success: function (data) {
          $("#editingBookForm").css("display", "block");
          var data = JSON.parse(data);
          console.log(data);
          $("#bookId").attr("value", data.id);
          $("#bookName").attr("value", data.name);
          $("#preBookCategory").attr("value", data.category);
          $("#bookPrice").attr("value", data.price);
          $("#bookInfo").attr("value", data.info);
          $("#bookImgUrl").attr("value", data.imgurl);
        },
      });
    } else {
      alert("Please, Select a Boook");
    }
  });

  $("#updateBookBtn").click(function () {
    //event.preventDefault();
    //var $editingBookForm = $("#editingBookForm");
    //$editingBookForm[0].checkValidity();
    //$editingBookForm[0].reportValidity();

    var formName = $("#editingBookFormName").val();
    var bookId = $("#bookId").val();
    var bookName = $("#bookName").val();
    var preBookCategory = $("#preBookCategory").val();
    var postBookCategory = $("#postBookCategory option:selected").text();
    var bookPrice = $("#bookPrice").val();
    var bookInfo = $("#bookInfo").val();
    var bookImgUrl = $("#bookImgUrl").val();
    console.log(
      formName +
        " , " +
        bookName +
        " , " +
        preBookCategory +
        " , " +
        postBookCategory +
        " , " +
        bookPrice +
        " , " +
        bookInfo +
        " , " +
        bookImgUrl
    );
    if (
      preBookCategory == postBookCategory ||
      postBookCategory == "<--Current"
    ) {
      $.ajax({
        url: "updateBookDB.php",
        method: "POST",
        data: {
          formname: formName,
          id: bookId,
          name: bookName,
          category: preBookCategory,
          price: bookPrice,
          info: bookInfo,
          imgurl: bookImgUrl,
        },
        datatype: "JSON",
        success: function () {
          console.log("Book Updated Successfully");
        },
      });
    } else {
      $.ajax({
        url: "updateBookDB.php",
        method: "POST",
        data: {
          formname: formName,
          id: bookId,
          name: bookName,
          category: postBookCategory,
          price: bookPrice,
          info: bookInfo,
          imgurl: bookImgUrl,
        },
        datatype: "JSON",
        success: function () {
          console.log("Book Updated Successfully");
        },
      });
    }
  });

  $("#deleteBookBtn").click(function () {
    var bookId = $("#bookId").val();
    $.ajax({
      url: "updateBookDB.php",
      method: "POST",
      data: {
        id: bookId,
        formname: "deleteBookForm",
      },
      datatype: "JSON",
      success: function () {
        console.log("Book Updated Successfully");
      },
    });
  });

  $("#cancelBtn").click(function () {
    $("#editingBookForm").css("display", "none");
  });

  //Manage your cart inner buttons
  $(".operationBtn").click(function (e) {
    var fieldname = $(this).attr("data-field");
    var btnType = $(this).attr("data-type");

    //getting book id
    var r = /\d+/g;
    var s = fieldname;
    var m;
    var bookId;
    if ((m = r.exec(s)) != null) {
      bookId = m[0];
    }

    //Getting the counter value
    var input = $("input[name='" + fieldname + "']");
    var currentVal = parseInt(input.val());

    console.log(fieldname);
    var state = true;
    if (!isNaN(currentVal)) {
      if (btnType == "minus") {
        if (currentVal > input.attr("min")) {
          input.val(currentVal - 1).change();

          // Managing basket total price
          for (var i = 0; i < basket_books.length; i++) {
            if (parseInt(basket_books[i]["id"]) == bookId) {
              basket_books[i]["count"] = parseInt(basket_books[i]["count"]) - 1;
            }
            updateTotalBasketPrice();
          }
          //////////////
        }
        if (parseInt(input.val()) == input.attr("min")) {
          $(this).attr("disabled", true);
        }
      } else if (btnType == "plus") {
        input.val(currentVal + 1).change();

        // Managing basket total price
        for (var i = 0; i < basket_books.length; i++) {
          if (parseInt(basket_books[i]["id"]) == bookId) {
            basket_books[i]["count"] = parseInt(basket_books[i]["count"]) + 1;
          }
          updateTotalBasketPrice();
        }
        //////////////
      } else if (btnType == "delete") {
        alert("the book will be deleted");

        // Managing basket total price
        for (var i = 0; i < basket_books.length; i++) {
          if (parseInt(basket_books[i]["id"]) == bookId) {
            basket_books[i]["count"] = 0;
          }
        }
        updateTotalBasketPrice();

        $(".bookrow[id=" + bookId + "]").hide();
      }
    } else {
      input.val(0);
    }
    console.log(basket_books);
  });
  $(".counterValue").change(function () {
    var minValue = parseInt($(this).attr("min"));

    var valueCurrent = parseInt($(this).val());

    name = $(this).attr("name");
    if (valueCurrent >= minValue) {
      $(
        ".operationBtn[data-type='minus'][data-field='" + name + "']"
      ).removeAttr("disabled");
    } else {
      alert("Sorry, the minimum value was reached");
      $(this).val($(this).data("oldValue"));
    }
  });
  $("#saveBasketBtn").click(function () {
    if (basket_books.length >= 1) {
      $.ajax({
        url: "updateBasketDB.php",
        method: "POST",
        data: {
          method: "updatebookscount",
          bookscount: basket_books,
        },
        datatype: "JSON",
        success: function (data) {
          console.log(JSON.parse(data));
          location.reload(true);
        },
      });
    }
  });

  $("#registerUserBtn").click(function () {
    var username = $("#r_username").val();
    var userpass = $("#r_userpassword").val();

    var userrole = "";
    if ($("#r_adminrole").is(":checked")) {
      userrole = "admin";
    } else {
      userrole = "customer";
    }

    if (username != "" && userpass != "") {
      $.ajax({
        url: "registrationofuserbyadmin.php",
        method: "POST",
        data: {
          username: username,
          userpass: userpass,
          userrole: userrole,
          formname: "adminregistersuser",
        },
        datatype: "JSON",
        success: function (data) {
          var data = JSON.parse(data);
          $("#registerstate").text(data["message"]);
          alert(data["message"]);
          window.location.href = "changeInfoAdmin.php";
        },
      });
    } else {
      alert("Please, Enter user info");
    }
  });

  $("#checkOutBtn").click(function () {
    $("#paymentForm").css("display", "block");
  });
});
