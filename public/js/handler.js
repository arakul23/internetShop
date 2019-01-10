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
            $("#product-price").html(array[0].toFixed(2));

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


function showEditProductForm(self){
    var token = $("input[name=_token]").val();
    var idProduct = $(self).parent().find("[name='idProduct']").val();
    var result = null;
   $("#idProductEdit").val(idProduct);
   $("#editProduct").show('slow');
 $.ajax({
        type: "POST",
        url: "getProductInfo",
        data: {"_token": token, "idProduct": idProduct},
        success: function (result) {
            result = JSON.parse(result);
            $("#prodNameEdit").val(result[0].name);
            $("#prodPriceEdit").val(result[0].price);
            $("#prodCategoryEdit").val(result[0].category);
            $("#descriptionProdEdit").val(result[0].description);
            $("#imageEdit").attr('src',result[0].image);
            $("html, body").animate({ scrollTop: 0 }, "fast");
        }
    });

}



function showEditBrandForm(self){
    var token = $("input[name=_token]").val();
    var idBrand = $(self).parent().find("[name='idBrand']").val();
    var result = null;
   $("#idBrandEdit").val(idBrand);
   $("#editBrand").show('slow');
 $.ajax({
        type: "POST",
        url: "getBrandInfo",
        data: {"_token": token, "idBrand": idBrand},
        success: function (result) {
            result = JSON.parse(result);
            $("#brandNameEdit").val(result[0].name);
            $("html, body").animate({ scrollTop: 0 }, "fast");
        }
    });

}

function addPropertySelect(){

    $("#propertiesNames").clone().prependTo("addProperty");
}


