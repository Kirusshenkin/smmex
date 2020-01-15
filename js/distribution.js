// var chain = false;
var current_letter_id = false;
var current_message_id = false;

$( ".message-list" ).sortable({
    update: function() {
        updateOrderMessages();
    },
    handle: '> td > .msg-timeline-draghandle',
});

$.post(
    apiUrl + "/channel/all",
    { Authorization: token },
    function (data) {
        // console.log(data);
        data = JSON.parse(data.data);
        var channelList = "";
        channelList += "<option value=''>Все</option>";
        for (var i = 0; i < data.length; i++) {
            // console.log(data[i]);
            var selected = (id_channel == data[i].pk)?'selected':'';
            channelList += "<option value='" + data[i].pk + "' " + selected + ">" + data[i].fields.name + "</option>";
        }
        $("#channel").html(channelList);
    }
);

$("[data-toggle-active] [data-active]").on('click', function(e){
    e.preventDefault();

    var holder = $(this).closest('[data-toggle-active]');
    var active = holder.hasClass('is-active') ? 0 : 1;
    var id = holder.data('id');

    $.post(
        apiUrl + "/chain/active",
        { Authorization: token, id_chain: id, active: active },
        function (data) {
            if(data.success){
                holder.toggleClass('is-active');
            }
        }
    )

})

function toggleMessage(event, el){

    var row = $(el).closest('tr');
    var id = $(row).data('id');

    var channel_id = $(el).data('channel-id');
    var active = $(el).is(":checked") ? 1 : 0;

    $.post(
        apiUrl + "/message/active",
        { Authorization: token, id_message: id, active: active },
        function (data) {
            if(data.success){

            }
        }
    )
}

function displayMessages() {
    $.post(
        apiUrl + "/chain/message/all",
        { Authorization: token, id_chain: chain },
        function (data) {
            data = JSON.parse(data.data);
            let messageList = "";
            for (var i = 0; i < data.length; i++) {
                var checked = (data[i].fields.active)?'checked':'';
                messageList += "<tr data-id='" + data[i].pk + "'>";
                messageList += "<td>";
                messageList += "<a href='#' class='change-sleep'>" + data[i].fields.sleep + " минут</a>";
                messageList += '<div class="delay-picker">\
                                    <div class="form-group">\
                                        <label for="delay-message-' + data[i].pk + '">Будет отправлено через</label>\
                                        <input type="text" id="delay-message-' + data[i].pk + '" class="form-control" value="' + data[i].fields.sleep + '">\
                                        <small class="form-text text-muted">минут <b>после</b> предыдущего</small>\
                                    </div>\
                                    <button type="button" class="btn btn-action btn-block" onclick="$(this).parent().hide();return false;">Готово</button>\
                                </div>';
                messageList += "</td>";
                messageList += "<td><i class='fas fa-exchange msg-timeline-draghandle'></i></td>"
                messageList += "<td><div class='custom-control custom-switch'><input type='checkbox' class='custom-control-input'id='control-activ" + data[i].pk + "' onclick='toggleMessage(event, this)' " + checked + "><label class='custom-control-label' for='control-activ" + data[i].pk + "'></label></div></td>";
                messageList += "<td class='message-name' style='white-space: nowrap2;'>" + data[i].fields.name + "</td>";
                messageList += "<td class='table-actions'><a href='#' data-fancybox data-type='ajax' data-src='/modal/messageMap.php?id_message=" + data[i].pk + "' ><i class='fas fa-sitemap'></i></a><a href='#' data-fancybox-custom='message' data-type='ajax' data-options='{\"message_id\": \"" + data[i].pk + "\"}' data-src='/modal/editMessage.php?id_chain=" + chain + "&name=" + encodeURI(data[i].fields.name) + "&id_message=" + data[i].pk + "' ><i class='fas fa-edit'></i></a><a href='#'><i class='far fa-trash-alt delete-msg' data-id=" + data[i].pk + "></i></a></td>";
                messageList += "</tr>";
            }
            $(".message-list").html(messageList);

        }
    );
}
displayMessages();

$(document).on('click', '.change-sleep', function(e){
    e.preventDefault();
    $(this).parent().find('.delay-picker').toggle();
})
$(document).on('keyup change', '.delay-picker input', function(e){
    var id = $(this).closest('tr').data('id');
    var text = $(this).closest('td').find('a');
    var sleep = $(this).val();

    $.post(
        apiUrl + "/message/sleep",
        { Authorization: token, sleep: sleep, id_message: id },
        function (data) {
            if(data.success){
                text.html(sleep + ' минут');
            }
        }
    )
})

function updateOrderMessages(){
    var data = [];
    $(".message-list tr").each(function(key, item){
        var id = $(this).data('id');
        
        data.push({id_message: id, order: key});
    })

    // data = [id_message: 235, order: 0}, {id_message: 236, order: 1}, {id_message: 237, order: 2}]

    $.post(
        apiUrl + "/message/order",
        { Authorization: token, order_array: JSON.stringify(data) },
        function (data) {
            if(data.success){

            }
        }
    )
}

function getIntervals(){
    var form = $(".edit-chain");
    var data = {};
    $.each(form.serializeArray(), function(_, kv) {
      data[kv.name] = kv.value;
    });

    var intervals = [];

    for(var i=0; i<7; i++){
        var key = 'intervals[' + i + ']';
        if(typeof data[key + '[enable]'] != undefined){
            if(data[key + '[enable]'] == 'on')
                intervals.push({day: i, start_time: data[key + '[start_time]'], stop_time: data[key + '[stop_time]']})
        }
    }

    return intervals;
}

$(document).on("submit", ".edit-chain", function (e) {

    e.preventDefault();
    e.stopPropagation();
    var name = $('#name').val();
    var channel = $('#channel').val();
    var recipients = $('#recipients').val();

    var send_start = cb2bool($('#send-start'));
    var send_add_tag = cb2bool($('#send-adding-tags'));
    var send_del_tag = cb2bool($('#send-removal-tags'));

    var repeat_tags_start = cb2bool($('#repeat-tags-start'));

    var name_add_tag = $('#adding-tags').val();
    var name_del_tag = $('#removal-tags').val();

    var use_interval = cb2bool($('#rollback'));
    var from = $('#from').val();
    var to = $('#to').val();

    var intervals = getIntervals();

    $.post(
        apiUrl + "/chain/edit",
        {
            Authorization: token,
            id_chain: chain,
            name: name,
            id_channel: channel,
            channel_id: channel,
            active: 'True',
            intervals: JSON.stringify(intervals),
            start_dialog: send_start,
            send_add_tag: send_add_tag,
            send_del_tag: send_del_tag,
            name_add_tag: name_add_tag,
            name_del_tag: name_del_tag,
            repeat_tags_start: repeat_tags_start,
            use_interval: use_interval,
            use_disturb: 'False',
            recipients: 'all',
            disturb_1: "2019-10-29T10:46:44.186Z",
            disturb_2: "2019-10-29T10:46:44.186Z",
            sleep: 0
        },
        function (data) {
            if (data.success) {
                chain = data.data;
                window.location.href = '/chains.php';
            }
        }
    );
});
$(document).on("click", '.add-msg', function () {
    let createMsg = $(this).data("id");
    let sleep = 20;
    $.post(
        apiUrl + "/message/add",
        {
            Authorization: token,
            name: 'сообщение',
            id_chain: chain,
            active: 'True',
            sleep: sleep,
            order: 999,
        },
        function (data) {
            if (data.success) {
                console.log(data.data);
                displayMessages();
                updateOrderMessages();
            }
        }
    )
});
$(document).on("click", '.delete-msg', function (e) {
    e.preventDefault();
    var deleteMsg = $(this).data("id");
    $.post(
        apiUrl + "/message/delete",
        {
            Authorization: token,
            id_message: deleteMsg
        },
        function (data) {
            if (data.success) {
                $("tr[data-id=" + deleteMsg + "]").remove();
                updateOrderMessages();
            }
        }
    )
});

$(document).on("click", "#add-letter", function (e) {
    e.preventDefault();

    var holder = $(this).parent();

    var num = $(".letters-list > .letters-list__item").length + 1;
    var id_message = $(this).data('message-id');
    var name = 'Сообщение ' + num;

    $.post(
        apiUrl + "/letter/add",
        {
            Authorization: token,
            name: name,
            id_message: id_message,
            body: '',
        },
        function (data) {
            if (data.success) {
                // var name = "Сообщение #" + num;
                // var elem = document.createElement('div');
                // $(elem).attr('data-id', num);
                // $(elem).attr('data-name', name);
                // elem.id = 'letter-' + num;
                // elem.className = 'letters-list__item';
                // elem.innerHTML = "<span>" + name + "</span><div class='spacer'></div><i class='fas fa-times ng-scope delete-letter' data-id=" + num + "> </i>";
                // holder.find(".letters-list").append(elem);

                displayLetters(current_message_id);
            }
        }
    );

    return false;
});

function displayLetters(messageId) {
    current_message_id = messageId;
    $.post(
        apiUrl + "/chain/message/letter/all",
        { Authorization: token, id_message: messageId },
        function (data) {
            if (data.success) {

                var list = document.createElement("div");

                data = JSON.parse(data.data);
                data.forEach(function (item, key) {
                    console.log(item);
                    var elem = document.createElement('div');
                    $(elem).attr('data-id', item.pk);
                    $(elem).attr('data-name', item.fields.name);
                    $(elem).attr('data-body', item.fields.body);
                    elem.id = 'letter-' + item.pk;
                    elem.className = 'letters-list__item';
                    elem.innerHTML = "<span>" + item.fields.name + "</span><div class='spacer'></div><a href='#' class='delete-letter' data-id=" + item.pk + "><i class='fas fa-times'></i></a>";
                    
                    $(list).append(elem);

                    $(".letter-form").show();
                })
                $(".letters-list").html($(list).html());
                if($(".letters-list__item--selected").length == 0){
                    $(".letters-list .letters-list__item:first-child").click();
                }
            }
        }
    );
}

$(document).on("click", ".delete-letter", function (e) {
    e.preventDefault();

    var deleteBtn = $(this).data("id");
    $.post(
        apiUrl + "/letter/delete",
        { Authorization: token, id_letter: deleteBtn },
        function (data) {
            if (data.success) {
                $("div[data-id=" + deleteBtn + "]").remove();
                displayButtons(current_letter_id);
                if($(".letters-list__item--selected").length == 0){
                    $(".letters-list .letters-list__item:first-child").click();
                }
            }
        }
    );
});

$(document).on('keyup change paste', ".letter-name", function(e){
    var name = $(this).val();
    console.log(name);
    $(".letters-list__item#letter-" + current_letter_id).attr('data-name', name);
    $(".letters-list__item#letter-" + current_letter_id + " > span").html(name);
})

$(document).on('keyup change paste', ".letter-body", function(e){
    var body = $(this).val();
    var name = $(".letter-name").val();
    $(".letters-list__item#letter-" + current_letter_id).attr('data-body', body);

    if (name && body) {
        $(".letters-list__item#letter-" + current_letter_id).removeClass('letters-list__item--error');
    } else {
        $(".letters-list__item#letter-" + current_letter_id).addClass('letters-list__item--error');
    }
})

$(document).on('change', ".letter-name", function(e){
    var name = $(".letter-name").val();
    var body = $(".letter-body").val();

    $.post(apiUrl + '/letter/edit', {
        Authorization: token,
        id_message: current_message_id,
        id_letter: current_letter_id,
        name: name,
        body: body,
    })
})

$(document).on('change', ".letter-body", function(e){
    var name = $(".letter-name").val();
    var body = $(".letter-body").val();

    $.post(apiUrl + '/letter/edit', {
        Authorization: token,
        id_message: current_message_id,
        id_letter: current_letter_id,
        name: name,
        body: body,
    })
})

$(document).on("click", ".letters-list .letters-list__item", function (e) {
    e.preventDefault();

    $(".letters-list > .letters-list__item").removeClass('letters-list__item--selected');
    $(this).addClass('letters-list__item--selected');

    var new_letter_id = $(this).attr('data-id');

    if (current_letter_id) {
        var name = $(".letter-name").val();
        var body = $(".letter-body").val();

        $.post(apiUrl + '/letter/edit', {
            Authorization: token,
            id_message: current_message_id,
            id_letter: current_letter_id,
            name: name,
            body: body,
        })

        if (name && body) {
            $(".letters-list__item#letter-" + current_letter_id).removeClass('letters-list__item--error');
        } else {
            $(".letters-list__item#letter-" + current_letter_id).addClass('letters-list__item--error');
        }
    }

    var name = $(this).attr('data-name');
    var body = $(this).attr('data-body');

    console.log(name);

    $(".letter-name").val(name);
    $(".letter-body").val(body);
    // $(this).closest('form').val(body);

    current_letter_id = new_letter_id;

    displayButtons(current_letter_id);

})

$(document).on('click', '.save-message', function (e) {
    e.preventDefault();

    var name = $('input.message-name').val();
    var message_id = $(this).data('message-id');

    $.post(
        apiUrl + "/message/edit",
        {
            Authorization: token,
            "id_chain": chain,
            "id_message": message_id,
            "name": name,
            "active": "True"
        },
        function (data) {
            if (data.success) {

                saveLetters(message_id);

                displayMessages();
                $(".fancybox-close-small").click()
            }
        }
    );
})

function saveLetters(message_id){
    $(".letters-list__item").each(function (key, item) {
        var letter_id = $(item).attr('data-id');
        var letter_name = $(item).attr('data-name');
        var letter_body = $(item).attr('data-body');

        $.post(apiUrl + '/letter/edit', {
            Authorization: token,
            id_chain: chain,
            id_message: message_id,
            id_letter: letter_id,
            name: letter_name,
            body: letter_body,
        })
    });
}

function displayButtons(id_letter){
    $.post(
        apiUrl + "/letter/info",
        { Authorization: token, id_letter: id_letter },
        function (data) {
            var list_files = "";
            var list_buttons = document.createElement("div");

            var image_extensions = ['jpg', 'png', 'jpeg', 'gif', 'ico'];
            if (data.success) {

                buttons = JSON.parse(data.data.buttons);
                buttons.forEach(function (button, key) {
                    var elem = document.createElement('div');
                    $(elem).attr('data-id', button.pk);
                    $(elem).attr('data-name', button.fields.name);
                    $(elem).attr('data-fancybox', 'true');
                    $(elem).attr('data-type', 'ajax');
                    $(elem).attr('data-src', '/modal/addButton.php?id_button=' + button.pk + '&id_message=' + current_message_id + '&id_letter=' + id_letter );
                    elem.id = 'button-' + button.pk;
                    elem.className = 'buttons-list__item';
                    elem.innerHTML = "<span class='spacer'>" + button.fields.name + "</span><a href='#' class='delete-button' data-id=" + button.pk + "><i class='fas fa-times'> </i>";

                    $(list_buttons).append(elem);
                })


                files = data.data.files;
                files.forEach(function (item, key) {
                    if(image_extensions.includes(item.expansion)){
                        var icon = '<img src="' + apiUrl + '/' + item.url + '">';
                    }else{
                        var icon = '<i class="fas fa-file"></i>';
                    }

                    var html = '<div class="files-list__item">';
                    html += '<div class="thumb">';
                    html += icon;
                    html += '</div>';
                    html += '<span>' + item.name + '</span>';
                    html += '</div>';

                    list_files += html;
                })

            }
            $(".files-list").html(list_files);
            $(".buttons-list").html($(list_buttons).html());
        }
    );
}

$(document).on('click', '.create-button-header__item', function(e){
    e.preventDefault();

    var type = $(this).data('type');
    var form = $(this).closest('form.create-button');

    console.log(type);

    $(form).find('[name=type]').val(type);

})

function saveButton(event, form){
    event.preventDefault();;

    var id_button = $(form).find('[name=id_button]').val();

    var type = $(form).find('[name=type]').val();
    var name = $(form).find('[name=name]').val();
    var color = $(form).find('[name=color]:checked').val();

    var add_tags = $(form).find('[name=add_tags]').val();
    var remove_tags = $(form).find('[name=remove_tags]').val();

    var id_message = $(form).find('[name=id_message]').val();
    var id_chain = $(form).find('[name=id_chain]').val();
    var id_letter = current_letter_id;

    var button_type = $(form).find('[name=button_type]:checked').val();
    var link = $(form).find('[name=link]').val();
    var next_letter_id = $(form).find('[name=next_letter_id] option:checked').val();

    var button_id= $(form).find('[name=button_id] option:checked').val();

    var id_offer = $(form).find('[name=id_offer] option:checked').val();

    var closeBtn = $(form).find('[data-fancybox-close]');

    $.post(
        apiUrl + ((id_button)?"/button/edit":"/button/add"),
        {
            Authorization: token,
            id_button: id_button,
            name: name,
            color: color,
            id_chain: id_chain,
            id_message: id_message,
            id_letter: id_letter,
            remove_tags: remove_tags,
            add_tags: add_tags,
            type: type,
            type_button: button_type,
            button_type: button_type,
            display_letter_id: next_letter_id,
            display_link: link,
            display_offer_id: id_offer,
            button_id: button_id,
        },
        function (data) {
            if (data.success) {
                // var name = "Сообщение #" + num;
                // var elem = document.createElement('div');
                // $(elem).attr('data-id', num);
                // $(elem).attr('data-name', name);
                // elem.id = 'letter-' + num;
                // elem.className = 'letters-list__item';
                // elem.innerHTML = "<span>" + name + "</span><div class='spacer'></div><i class='fas fa-times ng-scope delete-button' data-id=" + num + "> </i>";
                // holder.find(".letters-list").append(elem);
                closeBtn.trigger('click');

                displayButtons(id_letter);
            }
        }
    );

    return false;
}

$(document).on("click", ".delete-button", function (e) {
    e.preventDefault();

    var deleteBtn = $(this).data("id");
    $.post(
        apiUrl + "/button/delete",
        { Authorization: token, id_button: deleteBtn },
        function (data) {
            if (data.success) {
                $(".buttons-list__item[data-id=" + deleteBtn + "]").remove();
            }
        }
    );

    return false;
});

$(document).on("click", ".buttons-list > .buttons-list__item", function (e) {
    e.preventDefault();

})


function display_button_type(){
    var type = $("[name=button_type]:checked").val();
    $(".button_type-link").hide();
    $(".button_type-letter").hide();
    $(".button_type-" + type ).show();
    
}

$(document).on('change', "[name=button_type]", display_button_type)

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

function onUploadComplete(result, info){
    if(result.success){
        var image_extensions = ['jpg', 'png', 'jpeg', 'gif', 'ico'];
        var upload_data = result.data;

        $.post(
            apiUrl + "/chain/plugfile",
            { Authorization: token, id_letter: current_letter_id, files: JSON.stringify([{file_id: upload_data.id}]) },
            function (data) {
                if (data.success) {
                    if(image_extensions.includes(upload_data.expansion)){
                        var icon = '<img src="' + apiUrl + '/' + upload_data.url + '">';
                    }else{
                        var icon = '<i class="fas fa-file"></i>';
                    }

                    var html = '<div class="files-list__item">';
                    html += '<div class="thumb">';
                    html += icon;
                    html += '</div>';
                    html += '<span>' + upload_data.name + '</span>';
                    html += '</div>';

                    $(".files-list").append(html);
                }
            }
        );
    }
}