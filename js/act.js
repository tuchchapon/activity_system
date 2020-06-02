$(".removeAct").on("click", function (e) {
    e.preventDefault();
    if (confirm("ยืนยันการลบข้อมูล เมื่อลบแล้วไม่สามารถกู้คืนได้อีก")) {

        var obj = $(this);
        var url = $(this).attr("href");

        $.ajax(url).done(function (data) {
            
                obj.parent().parent().remove();
            
        });
    } else {

    }
});


