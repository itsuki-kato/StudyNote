// home
$(function () {
    $("#sortable").sortable();
    // sorttable()が呼び出された時に発火する。
    $("#sortable").sortable({
        update: function (event, ui) {
            var sortNos = $(this).sortable("toArray");
            // Ajax通信を行う。
            exeAjax(sortNos, "", "post", "http://localhost:8888/laravel8/StudyNote/public/home/sort_text");
        }
    });
});

/**
 * Ajax通信用メソッド(TODO：引数が多いので要検討。)
 *
 * @param string method
 * @param string route_name
 * @param string data_type
 * @param mix data
 */
function exeAjax(method = "", route_name = "", data_type = "", data = "") {
    // post送信の場合はcsrf-tokenが必須。ajaxSetup()でデフォルト値を指定。
    if (method == "post") {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    }

    $.ajax({
        // 渡したいRoute名、もしくはurl。
        url: route_name,
        // HttpMethod(get,post...)
        type: method,
        // サーバーから返却されるデータの型。(jsonなど。何も返さなければ空文字で良い。)
        dataType: data_type,
        // サーバーに送信する値。(php側では連想配列のキー名で取得できる。)
        data: {
            'target_data': data,
        },
    }).done(function (results) {
        console.log('done');
    }).fail(function (jqXHR, textStatus, errorThrown) {
        // エラーがどこで出たのか詳しく出力してくれる。(js or php...)
        console.log("ajax通信に失敗しました")
        console.log(jqXHR.status);
        console.log(textStatus);
        console.log(errorThrown.message);
    })
}

// sideNav
$(function () {
    $('.side_category').on('click', function () {
        $(this).next().slideToggle();
    });
});
