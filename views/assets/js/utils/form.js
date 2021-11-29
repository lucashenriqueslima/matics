$(window).on("load", function(){
    $("form").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var action = form.attr("action");
        var data = form.serialize();

        $.ajax({
            url: action,
            data: data,
            type: "post",
            dataType: "json",
            beforeSend: function (load) {
                ajax_load("open");
            },
            success: function (su) {
                ajax_load("close");

                setTimeout(function() {

                if (su.message) {

                    alert(su.message.type, su.message.message)           
                    return;
                }

                if(su.modal_close){
                    tableGrid()
                    $(`#${su.modal_close.modal}`).modal('hide')    
                    setTimeout(function() {  
                    alert(su.modal_close.type, su.modal_close.message)
                    }, 180)
                    return;
                }

                if (su.redirect) {
                    window.location.href = su.redirect.url;
                }

            
            }, 800)
            }
        });

        function ajax_load(action) {
            ajax_load_div = $(".ajax_load");

            if (action === "open") {
                ajax_load_div.fadeIn(400).css("display", "flex");
            }

            if (action === "close") {
                ajax_load_div.fadeOut(600);
            }
        }
    });
});