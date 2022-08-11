// home
$(function() {
    $(".sortable").sortable();
    $(".sortable").sortable({
        update: function(event, ui) {
            $.ajax({
                // TODO:route名で指定できるようにする。
                url: 'http://localhost:8888/laravel8/StudyNote/public/home/sort_text',
                type: 'GET',
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
