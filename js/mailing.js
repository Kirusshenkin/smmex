var Mailings = function(){
	var self = {};

	self.display = function(){
		if(edit){
			displayChannels();
	    	displayCategories();
		}else{
			$.post(
		        apiUrl + "/mailing/all",
		        { Authorization: token },
		        function (data) {
		        	data = JSON.parse(data.data);
		            var html = "";
		            data.forEach(function(item, key){
		            	html += '<tr data-id=' + item.pk + '>';
		            	html += '<td>' + item.fields.name + '</td>';
		            	html += '<td class="table-actions">';
		            	html += '<a href="/editMailing.php?id=' + item.pk + '"><i class="fal fa-pencil"></i></a>';
		            	html += '<a href="#" data-mailing-id=' + item.pk + ' onclick="mailings.delete(event, this)"><i class="fal fa-trash-alt"></i></a>';
		            	html += '</td>';
		            	html += '</tr>';
		            })
		            console.log(html);
		            $(".mailingsList").html(html);
		        }
		    );
		}
	}

	self.create = function(e, form){
		e.preventDefault();

		var data = {};
	    $.each($(form).serializeArray(), function(_, kv) {
	      data[kv.name] = kv.value;
	    });

	    data.Authorization = token;

	    $.post(apiUrl + "/mailing/add", data, function (data) {
            if (data.success) {
				var id = data.data;
				// Не забыть вернуть
                // window.location.href = '/editMailing.php?id=' + id;
				window.location.href = '/editLanding.php?id=' + id;
            }
        })
	}

	self.save = function(e, form){
		e.preventDefault();

		var data = {};
	    $.each($(form).serializeArray(), function(_, kv) {
	      data[kv.name] = kv.value;
	    });

	    data.Authorization = token;

	    data.state_user = cb2bool($(form).find('[name=state_user]'));
	    data.use_interval = cb2bool($(form).find('[name=use_interval]'));
	    data.send_add_tag = cb2bool($(form).find('[name=send_add_tag]'));
	    data.send_del_tag = cb2bool($(form).find('[name=send_del_tag]'));

	    data.sleep = data.sleep;
	    console.log($(form).find('[name=state_user]'));
	    data.show_new = cb2bool($(form).find('[name=show_new]'));
	    data.show_price = cb2bool($(form).find('[name=show_price]'));
	    data.show_delivery = cb2bool($(form).find('[name=show_delivery]'));
	    data.show_image = cb2bool($(form).find('[name=show_image]'));

	    var intervals = [];

	    for(var i=0; i<7; i++){
	        var key = 'intervals[' + i + ']';
	        if(typeof data[key + '[enable]'] != undefined){
	            if(data[key + '[enable]'] == 'on')
	                intervals.push({day: i, start_time: data[key + '[start_time]'], stop_time: data[key + '[stop_time]']})
	        }
	    }

	    data.intervals = JSON.stringify(intervals);

	    $.post(apiUrl + "/mailing/edit", data, function (data) {
            if (data.success) {
            	window.location.href = '/mailings.php';
            }
        })
	}

	self.delete = function(event, el){
		event.preventDefault();

		var id = $(el).data('mailing-id');

		$.post(
	        apiUrl + "/mailing/delete",
	        { Authorization: token, id_mailing: id },
	        function (data) {
	        	if(data.success){
	        		$(".mailingsList tr[data-id=" + id + "]").remove();
	        	}
	        }
	    )
	}

	self.display();

	return self;
}
var mailings = new Mailings();

$("[data-toggle-active] [data-active]").on('click', function(e){
    e.preventDefault();

    var holder = $(this).closest('[data-toggle-active]');
    var active = holder.hasClass('is-active') ? 0 : 1;
    var id = holder.data('id');

    $.post(
        apiUrl + "/mailing/active",
        { Authorization: token, id_mailing: id, active: active },
        function (data) {
            if(data.success){
                holder.toggleClass('is-active');
            }
        }
    )

})

function displayChannels(){
	$.post(
	    apiUrl + "/channel/all",
	    { Authorization: token },
	    function (data) {
	        // console.log(data);
	        data = JSON.parse(data.data);
	        var channelList = "";
	        channelList += "<option value=''>Все</option>";
	        for (var i = 0; i < data.length; i++) {
	            var selected = (edit_id_channel == data[i].pk)?'selected':'';
	            channelList += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option>";
	        }
	        $("#channel").html(channelList);
	    }
	);
}

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
$(document).on("click", '.add-category', function () {
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

$(document).on('change', "#send-adding-tags", function(e){
    e.preventDefault();

    $(".adding-tags-block").slideToggle(300);
})
$(document).on('change', "#send-removal-tags", function(e){
    e.preventDefault();

    $(".removal-tags-block").slideToggle(300);
})

$(document).on('change', "#rollback", function(e){
    e.preventDefault();

    $(".restrict-send-time").slideToggle(140);
})