var smmEX = function(){
	var self = {};

	self.apiUrl = "https://api.smmex.ru/";

	self.init = function(){
		self.initLinks();
		self.initHandlers();

		var link = document.createElement('link'); 
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = 'https://smmex.ru/api.css';
        jQuery('head').append(link);
	}

	self.initLinks = function(){
		jQuery("[data-smmex=links]").each(function(key, item){
			var token = jQuery(this).data('token');
			var userId = jQuery(this).data('user-id');
			var widgetId = jQuery(this).data('widget-id');

			var el = jQuery(this);
			el.addClass('smmex-widget');

			jQuery.post(self.apiUrl + 'widgetli/info', {Authorization: token, id_user: userId, id_widget: widgetId}, function(response){
				if(response.success){
					var dataWidget = JSON.parse(response.data.widget);
					var channels = JSON.parse(response.data.channels);

					var links_wrapper = document.createElement('div');
					    links_wrapper.className = 'smmex-widget-links-wrapper';
					
					if(jQuery(el).data('view-type') == 2){

						var toggle_wrapper = document.createElement('div');
					    	toggle_wrapper.className = 'smmex-widget-toggle-wrapper';

				    	jQuery(toggle_wrapper).append('<button class="smmex-widget-toggle rotate-reverse"><img src="' + self.apiUrl + 'widget/img/icon_messaging.svg"></button>');
				    	jQuery(el).prepend(toggle_wrapper);

						jQuery(el).addClass('view-absolute');
						channels.forEach(function(item, key){
							var channel = '<a href="' + item.fields.link + '" class="widget-link smmex-widget-tooltip widget-link-' + item.fields.type_messanger + '" target="_blank" rel="noopener nofollow"><img src="' + self.apiUrl + 'widget/img/icon_tg.svg"><span class="tooltiptext button-tooltiptext">' + item.fields.type_messanger + '</span></a>';
							jQuery(links_wrapper).append(channel);
						})

					}else{
						channels.forEach(function(item, key){
							var channel = '<a href="' + item.fields.link + '" class="widget-link smmex-widget-tooltip widget-link-' + item.fields.type_messanger + '" target="_blank" rel="noopener nofollow"><img src="' + self.apiUrl + 'widget/img/icon_tg.svg"></a>';
							jQuery(links_wrapper).append(channel);
						})
					}

					jQuery(el).prepend(links_wrapper);
				}
			})
		})
	}

	self.initHandlers = function(){
		jQuery(document).on('click', '.smmex-widget-toggle', function(e){
			e.preventDefault();
			var widget = jQuery(this).closest('.smmex-widget');
			widget.toggleClass('expanded');

			jQuery(this).toggleClass('rotate');
			jQuery(this).toggleClass('rotate-reverse');

			if(!widget.hasClass('expanded')){
				jQuery(this).find('img').attr('src', self.apiUrl + 'widget/img/icon_messaging.svg');
			}else{
				jQuery(this).find('img').attr('src', self.apiUrl + 'widget/img/icon_close.svg');
			}
		})
	}

	self.init();

	return self;
}
$(function(){
	var smmex = new smmEX();
})