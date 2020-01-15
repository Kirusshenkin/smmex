var Payment = function(){
	var self = {};

	self.display = function(){
		$.post(
	        apiUrl + "/rates/all",
	        { Authorization: token },
	        function (data) {
	        	data = JSON.parse(data.data);
	            var html = "";
	            data.forEach(function(item, key){
	            	html += '<div class="chain-rates__item col-md-3">\
			            <div class="chain-rates__item-inner">\
			                <span class="chain-rates__item-title">' + item.fields.name + '</span>\
			                <p class="chain-rates__item-description">' + item.fields.description + '</p>\
			                <button class="btn btn-action btn-block" onclick="payment.pay(' + item.pk + ')">' + item.fields.price + ' рублей</button>\
			            </div>\
			        </div>';
	            })
	            $(".chain-rates").html(html);
	        }
	    );
	}

	self.pay = function(id){
		$.post(
	        apiUrl + "/rates/pay",
	        { Authorization: token, id_rates: id },
	        function (data) {
	        	window.location.href = data.data;
	        }
	    );
	}

	self.display();

	return self;
}
var payment = new Payment();