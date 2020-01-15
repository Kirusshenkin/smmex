var Widgets = function(){
	var self = {};

	self.display = function(){
		$.post(
	        apiUrl + "/widgetli/all",
	        { Authorization: token },
	        function (data) {
	        	data = JSON.parse(data.data);
	            var html = "";
	            data.forEach(function(item, key){
	            	html += '<tr data-id=' + item.pk + '>';
	            	html += '<td>' + item.fields.name + '</td>';
	            	html += '<td class="table-actions">';
	            	html += '<a href="/widgetLinks.php?id=' + item.pk + '"><i class="fal fa-pencil"></i></a>';
	            	html += '<a href="#" data-widget-id=' + item.pk + ' onclick="widgets.delete(event, this)"><i class="fal fa-trash-alt"></i></a>';
	            	html += '</td>';
	            	html += '</tr>';
	            })
	            $(".widgetsList").html(html);
	        }
	    );
	}

	self.create = function(event, el){
		event.preventDefault();

		var form = $(el);
		var name = form.find('[name=name]').val();
		$.post(
	        apiUrl + "/widgetli/add",
	        { Authorization: token, name: name },
	        function (data) {
	        	if(data.success){
	        		var id = data.data;

	        		window.location.href = '/widgetLinks.php?id=' + id;
	        	}
	        }
	    )
	    return false;
	}

	self.save = function(event, el){
		event.preventDefault();

		var form = $(el);
		var id = form.find('[name=id_widget]').val();
		var name = form.find('[name=name]').val();
		$.post(
	        apiUrl + "/widgetli/edit",
	        { Authorization: token, id_widget: id, name: name },
	        function (data) {
	        	if(data.success){
	        		var id = data.data;
	        	}
	        }
	    )

	    window.location.href = '/widgetsLinks.php';
	    return false;
	}

	self.delete = function(event, el){
		event.preventDefault();

		var id = $(el).data('widget-id');

		$.post(
	        apiUrl + "/widgetli/delete",
	        { Authorization: token, id_widget: id },
	        function (data) {
	        	if(data.success){
	        		$(".widgetsList tr[data-id=" + id + "]").remove();
	        	}
	        }
	    )
	}

	self.channelPlug = function(event, el, widget_id){
		event.preventDefault();

		var channel_id = $(el).data('channel-id');
		var is_plug = (!$(el).is(":checked"));

		var action = (is_plug)?'unplug':'plug';

		$.post(
	        apiUrl + "/channel_widget/" + action,
	        { Authorization: token, id_widget: widget_id, id_channel: channel_id },
	        function (data) {
	        	if(data.success){

	        	}
	        }
	    )
	}

	self.display();

	return self;
}
var widgets = new Widgets();