// home
$(function() {
    $("#sortable").sortable();
    // sorttable()が呼び出された時に発火する。
    $("#sortable").sortable({
        update: function (event, ui) {
            var sortNos = $(this).sortable("toArray");
            // POST送信の場合はTokenが必須！！ajaxSetup()でデフォルト値を指定。
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            $.ajax({
                // TODO:route名で指定できるようにする。
                url: 'http://localhost:8888/laravel8/StudyNote/public/home/sort_text',
                type: 'post',
                // サーバーから返却されるデータの型を指定する。
                // TODO:ControllerからJSONで返却してパースエラーを消す。
                dataType: 'json',
                // サーバーに送信する値。
                data: {
                    'sortNos': sortNos,
                },
            }).done(function (results) {
                console.log('done');
            }).fail(function (jqXHR,textStatus,errorThrown) {
                console.log("ajax通信に失敗しました")
                console.log(jqXHR.status);
                console.log(textStatus);
                console.log(errorThrown.message);
            })
        }
    });
});

// sideNav
$(function () {
    $('.side_category').on('click', function () {
        $(this).next().slideToggle();
    });
});
