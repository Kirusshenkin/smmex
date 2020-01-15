
$(".product-creation").validate({
    rules: {
        name: "required",
        category: "required",
        shop: "required",
        price: "required",
    }
})

function displayOffers() {
    $.post(
        apiUrl + "/offer/all",
        { Authorization: token, id_offer: "", id_category: 1 },
        function (data) {
            let product_all = "";
            // console.log(data); 
            for (var i = 0; i < data.data.length; i++) {
                var offer_info = JSON.parse(data.data[i].offer);
                var category_info = JSON.parse(data.data[i].product);
                offer_info = offer_info[0];
                category_info = category_info[0];
                product_all += "<tr data-id='" + offer_info.pk + "'>";
                product_all += "<td scope='row'><b>" + offer_info.fields.name + "</b></td>";
                product_all += "<td>" + category_info.fields.name + "</td>";
                product_all += "<td style='white-space:nowrap;'>" + offer_info.fields.price + "</td>";
                product_all += "<td class='table-actions'>";
                product_all += "<a href='editOffer.php?id_offer=" + offer_info.pk + "'><i class='fal fa-pencil-alt'></i></a>";
                product_all += "<a class='remove-product' data-id='" + offer_info.pk + "'><i class='fal fa-trash-alt'></i></a>";
                product_all += "</td>";
                product_all += "</tr>";
            }
            $(".product_all").html(product_all);
        }
    );
}

$(document).on("click", ".remove-product", function (e) {
    e.preventDefault();

    var removeId = $(this).data("id");
    $.post(
        apiUrl + "/offer/delete",
        { Authorization: token, id_offer: removeId },
        function (data) {
            if (data.success) {
                $(".product_all tr[data-id=" + removeId + "]").remove();
            }
        }
    );
});

/* CATEGORIES START */
function displayCategories() {
    $.post(
        apiUrl + "/category/all",
        { Authorization: token },
        function (data) {
            var categoryall = "";
            data = JSON.parse(data.data);
            for (var i = 0; i < data.length; i++) {
                var selected = (edit_id_category == data[i].pk)?'selected':'';
                categoryall += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option > ";
            }
            $(".product-category").html(categoryall);
        }
    )
};
$(document).on("click", '.addProduct-category', function () {
    let name = $('#product-category').val();
    $.post(
        apiUrl + "/category/add",
        { Authorization: token, name: name, id_shop: 3 },
        function (data) {
            if (data.success) {
                edit_id_category = data.data;
                $.fancybox.close();
                displayCategories();
            }
        }
    );
});
$(document).on("click", '.delete-category', function (e) {
    e.preventDefault();
    let categoryDel = $('.product-category').val();
    $.post(
        apiUrl + "/category/delete",
        {
            Authorization: token,
            id_category: categoryDel
        },
        function (data) {
            if (data.success) {
                $(".product-category option[value=" + categoryDel + "]").remove();
            }
        }
    )
});
/* CATEGORIES END */

/* GATEWAYS START */
function displayGateway() {
    $.post(
        apiUrl + "/shop/all",
        { Authorization: token },
        function (data) {
            var categoryall = "";
            data = JSON.parse(data.data);
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                var selected = (edit_id_gateway == data[i].pk)?'selected':'';
                categoryall += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option > ";
                // console.log(data[i]);
            }
            $(".gateway-name").html(categoryall);

        }
    )
}
$(document).on("click", '.addGateway', function () {
    let name = $('#gateway-product-name').val();
    let login = $('#gateway-login').val();
    let pass_one = $('#gateway-pass-one').val();
    let pass_two = $('#gateway-pass-two').val();
    $.post(
        apiUrl + "/shop/add",
        {
            Authorization: token,
            name: name,
            login: login,
            pass1: pass_one,
            pass2: pass_two
        },
        function (data) {
            if (data.success) {
                edit_id_gateway = data.data;
                $.fancybox.close();
                displayGateway();
            }
        }
    );
});
$('.delete-gat').on("click", function (e) {
    e.preventDefault();
    var gatewayDel = $('.gateway-name').val();
    $.post(
        apiUrl + "/shop/delete",
        {
            Authorization: token,
            id_shop: gatewayDel
        },
        function (data) {
            if (data.success) {
                $(".gateway-name option[value=" + gatewayDel + "]").remove();
            }
        }
    );
});
/* GATEWAYS END */
$(document).ready(function () {
    displayOffers();
    displayGateway();
    displayCategories();
});
$(document).on("submit", '.product-creation', function (e) {
    e.preventDefault();

    var form = $(this);
    var id = $(this).find('[name=id_offer]').val();
    var url = apiUrl + "/offer/add";
    if(id){
        var url = apiUrl + "/offer/edit";
    }

    let product_id = $('.product-category').val();
    let name = $('.product-name').val();
    let shop = $('.gateway-name').val();
    let price = $('.currency-price').val();
    let add_tags = $('.add-tags').val();
    var remove_tags = $('.remove-tags').val();

    var formData = new FormData();

    var data = {};
    $.each($(form).serializeArray(), function(_, kv) {
      data[kv.name] = kv.value;
      formData.append(kv.name, kv.value);
    });

    data.Authorization = token;
    data.photo = $("#photo").prop('files')[0];
    console.log(data.photo);

    formData.append('Authorization', token);
    formData.append('photo', $("#photo").prop('files')[0]);

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success || data.data.success) {
                displayOffers();
                if(!id){
                    $('.product-name').val('');
                    $('.currency-price').val('');
                    $('.remove-tags').val('');
                    $('.add-tags').val('');
                }else{
                    window.location.href = '/offers.php';
                }
            }
        }
    });
});