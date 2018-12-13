function validateCategoryName() {
    var categoryName = document.getElementById("categoryName").value;
    if (categoryName.length < 5) {
        document.getElementById("warningMessage").style.display = "table";
        document.getElementById("sendCategory").setAttribute("disabled", "");

    }
    else {
        document.getElementById("warningMessage").style.display = "none";
        document.getElementById('sendCategory').removeAttribute("disabled");

    }
}


function getIdArray(token) {
    $.ajax({
        dataType: "json",
        type: "POST",
        url: "getIdArray",
        data: {"_token": token},
        success: function (result) {
            console.log(result);
            return result;
        }
    });
}


function addProductInCart(self) {

    var token = $("input[name=_token]").val();

    var id = $(self).parent().find('[name="idVal"]').val();
    var price = $(self).parent().find('[name="priceVal"]').val();

    $.ajax({
        type: "POST",
        url: "addToCart",
        data: {"_token": token, "idProd": id, "price": price},
        success: function (result) {
            var array = JSON.parse(result);
            $("#product-count").html(array[1]);
            $("#product-price").html(array[0]);

        }
    });

    return false;

}


function deleteFromCart(self) {


    var token = $("input[name=_token]").val();

    var id = $(self).parent().find('[name="idProductCart"]').val();
    var price = $(self).parent().find('[name="productPrice"]').val();
    $.ajax({
        type: "POST",
        url: "deleteFromCart",
        data: {"_token": token, "id": id, "price": price},
        success: function () {
            window.location.replace("cartProduct");
        }
    });

    return false;

}



