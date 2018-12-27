$("document").ready(function () {

    /*Icons action----------------------------------*/
    $("#plusIcon").click(function () {
        $("#divModalCreate").modal('toggle');
    });

    $("#exitIcon").click(function () {
        window.location = "/logout";
    });

    $("#arrowIcon").click(function () {
        window.location = "/";
    });

    $("#loginIcon").click(function () {
        window.location = "/login";
    });

    /*Change Completed-----------------------------------*/
    $(".imgCheck").on("click", function () {
        var img = $(this);
        var src = img.attr('src');
        var id = img.attr('id');
        var condition;
        if (src == "/img/checkIcon.png") {
            condition = 0;
            src = "/img/uncheckIcon.png";
        } else {
            condition = 1;
            src = "/img/checkIcon.png";
        }

        var tamanho = img.height();

        img.height(tamanho + 0.3);
        img.attr("src", "/img/ajax-loader.gif");
        $.ajax({
            url: "/update/" + id + "/" + condition,
            success: function () {
                img.height(tamanho);
                img.attr("src", src);
            }
        });

    });

});

        