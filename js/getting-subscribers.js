function displayChannels(){
    $.post(
        apiUrl + "/channel/all",
        { Authorization: token, type_messanger: 'telegram' },
        function (data) {
            data = JSON.parse(data.data);
            var channelList = "";
            for (var i = 0; i < data.length; i++) {
                channelList += "<tr data-id='" + data[i].pk + "'>";
                channelList += "<td><a class='name-token'>" + data[i].fields.name + "</a></td>";
                channelList += "<td>Подключено</td>";
                channelList += "<td class='table-actions'><a href='#' class='channel_remove' data-id='" + data[i].pk + "'><i class='far fa-trash-alt'></i></td>";
                channelList += "</tr>";
            }
            $(".channelList").html(channelList);
        }
    );
}
displayChannels();
$(document).on("click", ".channel_remove", function (e) {
    e.preventDefault();
    var channel_remove = $(this).data("id");
    $.post(
        apiUrl + "/channel/delete",
        {
            Authorization: token,
            id_channel: channel_remove
        },
        function (data) {
            if (data.success) {
                $("tr[data-id=" + channel_remove + "]").remove();
            }
        }
    );
});
$(document).on("submit", ".create-channel", function (e) {
    e.preventDefault();
    var token_channel = $('#token-channel').val();
    $(".create-channel .error").html("");

    $.post(
        apiUrl + "/channel/add",
        {
            Authorization: token,
            token: token_channel,
            type_messanger: 'telegram',
        },
        function (data) {
            if (data.success) {

                $('#token-channel').val("");

                displayChannels();
            }else{
                $(".create-channel .error").html(data.data);
            }
        }
    )
});