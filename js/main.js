$().fancybox({
    live: false,
    arrows : false,
    selector: '[data-fancybox-custom="message"]',
    'showNavArrows' : false,
    afterLoad: function (instance, slide) {
        console.log(instance.current.opts.options);
        var message_id = instance.current.opts.options.message_id;
        displayLetters(message_id);
        var emojiPicker = new EmojiPicker('.test-emoji');
    },
    beforeClose: function(instance, slide){
        current_letter_id = false;
        var message_id = instance.current.opts.options.message_id;
        saveLetters(message_id);
    }
});

// (function ($) {
//     $(function () {
//         $("ul.tabs__caption").on("click", "li:not(.active)", function () {
//             $(this)
//                 .addClass("active")
//                 .siblings()
//                 .removeClass("active")
//                 .closest("div.tabs")
//                 .find("div.tabs__content")
//                 .removeClass("active")
//                 .eq($(this).index())
//                 .addClass("active");
//         });
//     });
// })(jQuery);
//test2

//test3
// $(document).querySelector('.add-btn') = function (e) {
//     let elem = document.querySelector('div'),
//         jsNum = document.querySelector('.new-add');
//     elem.id = '#' + jsNum.childNodes.length;
//     elem.innerHTML = '#' + jsNum.childNodes.length;
//     jsNum.append(elem);
// };
//---------------------------------------tabs#2---------------------------------------
$(document).on("click", ".js-tab-trigger", function () {
    var tabName = $(this).data('tab'),
        tab = $('.js-tab-content[data-tab="' + tabName + '"]');

    $(".js-tab-trigger.active").removeClass("active");
    $(this).addClass("active");

    $(".js-tab-content.active").removeClass("active");
    tab.addClass("active");
});
// $("select")
//     .change(function () {
//         var str = "";
//         $("select option:selected").each(function () {
//             str += $(this).text() + " ";
//         });
//         $("div").text(str);
//     })
//     .trigger("change");
//---------------------------------------end tabs#2---------------------------------------

// var letterMsg = $('.new-add').val();
// $.post(
//     "http://api.smmex.ru/chain/message/letter/all",
//     { Authorization: token, id_message: letterMsg },
//     function (data) {
//         var name = $('.letter-name');
//         var letter = "";
//         for (var i = 0; i < data.length; i++) {
//             letter += "<div class='edit-main row'>";
//             letter += "<div class='edit-main__messange col-md'>";
//             letter += "<button class='btn home-btn ' id='add-btn' style='margin-bottom:5px;'>" + ' + добавить сообщение ' + "<button>";
//             "<div class='new-add js-tab-trigger' style='border:0px; pointer:couser;' data-tab=" + data[i].pk + "></div>";
//             letter += "</div>";
//             letter += "<div class='edit-main__text col-md'>";
//             "<div class='js-tab-content active'"
//             letter += "</div>";
//             letter += "</div>";
//         }
//     }
// );

//---------------------------------------delete edit button---------------------------------------

$(".new-add").on("click", function (e) {
    e.preventDefault();
    $('.tabs__content').removeClass('active');
    $(this).addClass('active');
});
//---------------------------------------tabs end------------------------------------------------
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
//---------------------------------------copy end---------------------------------------
// $.post(
//     "http://api.smmex.ru/authorization",
//     { username: "api", password: 123456 },
//     // dataType: 'application/json; charset=utf-8', 
//     function (authorization_data) {
//         authorization = JSON.parse(authorization_data);
//     }
// );

function cb2bool(cb){
    var value = ($(cb).is(':checked'))?'True':'False';
    return value;
}

// Preview images
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#blah').css({"display": "block"});
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".custom-file-input").change(function () {
    readURL(this);
});