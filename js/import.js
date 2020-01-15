var Importing = function(){
    var self = {};

    self.yml = function(e, form){
        e.preventDefault();

        var error_holder = $(form).find('.error');
            error_holder.html("");

        var data = {};
        $.each($(form).serializeArray(), function(_, kv) {
          data[kv.name] = kv.value;
        });

        data.Authorization = token;

        error_holder.html('<i class="fas fa-spinner fa-spin"></i>');
        $(form).find('[type="submit"]').attr('disabled', 'disabled');

        $.post(apiUrl + "/mailing/yaml", data, function (data) {
            $(form).find('[type="submit"]').attr('disabled', false);
            if (data.success) {
                window.location.href = '/offers.php';
            }else{
                error_holder.html(data.errors);
            }
        })
    }

    return self;
}
var importing = new Importing();

var selected = false;

function displayCategories() {
    $.post(
        apiUrl + "/category/all",
        { Authorization: token },
        function (data) {
            var categoryall = "";
            data = JSON.parse(data.data);
            for (var i = 0; i < data.length; i++) {
                // var selected = (edit_id_category == data[i].pk)?'selected':'';
                categoryall += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option > ";
            }
            $(".product-category").html(categoryall);
        }
    )
};
function displayGateway() {
    $.post(
        apiUrl + "/shop/all",
        { Authorization: token },
        function (data) {
            var categoryall = "";
            data = JSON.parse(data.data);
            // console.log(data);
            for (var i = 0; i < data.length; i++) {
                // var selected = (edit_id_gateway == data[i].pk)?'selected':'';
                categoryall += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option > ";
                // console.log(data[i]);
            }
            $(".gateway-name").html(categoryall);

        }
    )
}
displayCategories();
displayGateway();