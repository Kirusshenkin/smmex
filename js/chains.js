function createChain(e, type){
    e.preventDefault();

    var name = 'Черновик';

    $.post(
        apiUrl + "/chain/add",
        {
            Authorization: token,
            name: name,
            id_channel: '',
            active: 'True',
            start_dialog: 'True',
            send_add_tag: 'False',
            send_del_tag: 'False',
            name_add_tag: '',
            name_del_tag: '',
            use_interval: 'False',
            recipients: 'all',
            intervals: JSON.stringify([]),
            disturb_1: "2019-10-29T10:46:44.186Z",
            disturb_2: "2019-10-29T10:46:44.186Z",
            sleep: 0
        },
        function (data) {
            if (data.success) {
                var id = data.data;
                window.location.href = '/editChain.php?id_chain=' + id;
            }
        }
    );
}

$.post(
    apiUrl + "/chain/all",
    { Authorization: token },
    function (data) {
        // console.log(data);
        data = JSON.parse(data.data);
        var create_html = "";
        // var html = $(".mailing-list__item");
        for (var i = 0; i < data.length; i++) {
            // console.log(data[i]);
            // create_html += "<div class='mailing-list__item'  data-id='" + data[i].pk + "'>";
            // create_html += "<div class='mailing-list__text'>" + data[i].fields.name + "</div>";
            // create_html += "<div class='mailing-list__data'>" + data[i].fields.time_start + "</div>";
            // create_html += "<div class='mailing-list__actions'>";
            // create_html += "<i class='fas fa-pencil-alt' style='margin:0 8px;'></i>";
            // create_html += "<i class='far fa-trash-alt remove-chain'  data-id='" + data[i].pk + "'></i>";
            // create_html += "</div>";
            // create_html += "</div>";

            create_html += "<tr data-id='" + data[i].pk + "'>";
            create_html += "<td class='test'>" + data[i].fields.name + "</td>";
            create_html += "<td>" + data[i].fields.time_start + "</td>";
            create_html += "<td class='table-actions'>";

            create_html += "<span class='" + ((data[i].fields.active) ? 'is-active' : '') + "' data-id='" + data[i].pk + "' data-toggle-active>";
            create_html += "<button type=\"button\" class=\"btn btn-action\" data-active=\"true\"><i class=\"fal fa-play fa-fw\"></i></button>";
            create_html += "<button type=\"button\" class=\"btn btn-action\" data-active=\"false\" ><i class=\"fal fa-pause fa-fw\"></i></button >";
            create_html += "</span>";

            create_html += "<a href='/editChain.php?id_chain=" + data[i].pk + "'><i class='fal fa-pencil-alt'></i>";
            create_html += "<a href='#' class='remove-chain' data-id='" + data[i].pk + "'><i class='fal fa-trash-alt'></i></a>";
            create_html += "</td>";
            create_html += "</tr>";
        }
        $(".mailing-list").html(create_html);
    }
);
$(document).on("click", ".remove-chain", function (e) {
    e.preventDefault();

    var removeId = $(this).data("id");
    $.post(
        apiUrl + "/chain/delete",
        { Authorization: token, id_chain: removeId },
        function (data) {
            if (data.success) {
                $(".mailing-list tr[data-id=" + removeId + "]").remove();
            }
        }
    );
});

$(document).on('click', "[data-toggle-active] [data-active]", function (e) {
    e.preventDefault();

    var holder = $(this).closest('[data-toggle-active]');
    var active = holder.hasClass('is-active') ? 0 : 1;
    var id = holder.data('id');

    $.post(
        apiUrl + "/chain/active",
        { Authorization: token, id_chain: id, active: active },
        function (data) {
            if (data.success) {
                holder.toggleClass('is-active');
            }
        }
    )

})