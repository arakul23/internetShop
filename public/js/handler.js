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


function showEditProductForm(self) {
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
            console.log(result);
            if (result[0].images.length > 0)
                var imageUrl = result[0].images[0].url;
            var brandId = result[0].brand.id;

            $("#prodNameEdit").val(result[0].name);
            $("#prodPriceEdit").val(result[0].price);
            $("#prodCategoryEdit").val(result[0].category);
            $("#prodBrandEdit").val(brandId);
            $("#descriptionProdEdit").val(result[0].description);
            alert(imageUrl);
            if (imageUrl !== undefined)
                $("#imageEdit").attr('src', imageUrl);
            else
                $("#imageEdit").attr('src', "#");

            $("html, body").animate({scrollTop: 0}, "fast");
        }
    });

}


function showEditBrandForm(self) {
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
            $("html, body").animate({scrollTop: 0}, "fast");
        }
    });

}


function showEditCategoryForm(self) {
    var token = $("input[name=_token]").val();
    var idCategory = $(self).parent().find("[name='categoryId']").val();
    $("#editCategory").show('slow');
    $.ajax({
        type: "POST",
        url: "getCategories",
        data: {"_token": token, "idCategory": idCategory},
        success: function (result) {
            result = JSON.parse(result);
            console.log(result);

            $("#idCategoryEdit").val(result[0].id);
            $("#categoryNameEdit").val(result[0].name);
            if (result[0].parent_id === 0) {
                $("#parentCategory").val("no");
            }
            else {
                $("#parentCategory").val(result[0].parent_id);
            }
            $("html, body").animate({scrollTop: 0}, "fast");
        }
    });

}

function addPropertySelect() {

    $("#propertiesNames").clone().prependTo("addProperty");
}


$("#sortProducts").change(function () {

    var token = $("input[name=_token]").val();
    var sortType = $("#sortProducts").val();
    var category = $("#categoryProduct").val();
    $.ajax({
        type: "GET",
        url: "sortProducts",
        data: {"_token": token, "sortType": sortType, "category": category},
        success: function (result) {

            result = JSON.parse(result);
            $(".product-form").remove();
            for (var i = 0; i < result.length; i++) {
                $(".col-lg-9").append('<form action="{{url("/singleProduct")}}" class="product-form" id = "formProd' + i + '"></form>');
                $("#formProd" + i).append('<div class = "col-lg-4 product" id="cardProd' + i + '"><h3>' + result[i].name + '</h3></div>');
                if (typeof result[i].images[0] !== "undefined") {
                    $("#cardProd" + i).append('<img src="' + result[i].images[0].url + '" width="200" height="200" alt="Изображение товара"><br>');
                }

                $("#cardProd" + i).append('<h3>' + result[i].price + ' грн.</h3>');

            }
        }

    });
});



