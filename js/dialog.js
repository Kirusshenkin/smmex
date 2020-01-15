var Dialog = function(){
	var self = {};
	self.socket = false;
	self.chat_id = false;
	self.user_id = false;
	self.channel_id = false;

	self.channel = function(channel_id, name){
		$(".channel-name").html(name);
		$(".content").hide();
		self.dialogs(channel_id);
	}

	self.dialogs = function(channel_id){
		self.channel_id = channel_id;
		$.post(apiUrl + '/dialog/info', {Authorization: token, id_channel: channel_id}, function(data){
			var html = "";
			data.data.forEach(function(item, key){
				var user = JSON.parse(item.user)[0];
				var message = JSON.parse(item.message)[0];

				var activeClass = (user.fields.chat_id == self.chat_id)?'active':'';

				var el = '<li class="contact ' + activeClass + '2" data-id="' + user.fields.chat_id + '" onclick="dialog.view(' + user.fields.chat_id + ', ' + user.pk + ')">\
							<div class="wrap">\
								<span class="contact-status"></span>\
								<img src="http://slto.ru/no_avatar.png" alt="" />\
								<div class="meta">\
									<p class="name">' + user.fields.name_first + ' ' + user.fields.name_second + '</p>\
									<p class="preview">' + message.fields.text + '</p>\
								</div>\
							</div>\
						</li>';
				html += el;
			})
			$("#contacts ul").html(html);
		})
	}

	self.view = function(chat_id, user_id){
		$(".content").show();
		$(".contact").removeClass('active');
		$(".contact[data-id="+chat_id+"]").addClass('active');
		$.post(apiUrl + '/dialog/user', {Authorization: token, id_user: user_id}, function(data){
			self.chat_id = chat_id;
			self.user_id = user_id;
			self.initChat();

			var user = JSON.parse(data.data.user)[0];
			var messages = JSON.parse(data.data.messages);
			self.displayMessages(messages);

			$("#frame .content .contact-profile p").html(user.fields.name_first + ' ' + user.fields.name_second);

			$(".messages").animate({ scrollTop: 999999 }, "fast");
		})
	}

	self.displayMessages = function(messages){
		$(".messages ul").html("");
		var html = "";
		messages.forEach(function(item, key){
			var type = (item.fields.who == 'bot')?'sent':'replies';
			var message = item.fields.text;
			html += '<li class="' + type + '"><img src="http://slto.ru/no_avatar.png" alt="" /><p>' + message + '</p></li>';
		})
		$(".messages ul").html(html);
	}

	self.initChat = function(){
		if(self.socket != false)
			self.socket.close();
		self.socket = new WebSocket('ws://api.smmex.ru:8000/ws/telegram/' + self.chat_id + '/');

		self.socket.onmessage = function (e) {
			var data = JSON.parse(e.data);

			var type = (data['who'] == 'bot')?'sent':'replies';
			var message = data['message'];
			self.newMessage(message, type);
			self.dialogs(self.channel_id);
		};

		self.socket.onclose = function (e) {
			console.error('Chat socket closed unexpectedly');
		};
	}

	self.newMessage = function(message, type){
		$('<li class="' + type + '"><img src="http://slto.ru/no_avatar.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
		$('.message-input input').val(null);
		$('.contact.active .preview').html(((type == 'bot')?'<span>Вы: </span>':'') + message);
		$(".messages").animate({ scrollTop: 999999 }, "fast");
	}

	self.send = function(e, form){
		e.preventDefault();
		var message = $(form).find('input').val();
		if($.trim(message) == '') {
			return false;
		}
		$.post(apiUrl + '/dialog/send', {
			Authorization: token, 
			id_channel: self.channel_id, 
			id_user: self.user_id,
			message: message,
		}, function(data){

		})
	}

	var first_channel = $("#status-options ul li:first-child");
	self.channel(first_channel.data('id'), first_channel.text());
	// self.dialogs();

	return self;
}
var dialog = new Dialog();

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});

// $(window).on('keydown', function(e) {
//   if (e.which == 13) {
//     newMessage();
//     return false;
//   }
// });