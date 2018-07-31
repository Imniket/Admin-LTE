$('body').on('click', '.ajax-link', function (e) {
    e.preventDefault();

    var action = $(this).attr('href');
    $.ajax({
        url: action,
        dataType: 'json',
        type: 'POST',
        success: function (response) {
            var result = response;
            if (result.errorcode == "1") {
                var action = result.action;
                if (action == "MODAL_OPEN")
                {
                    var html = result.html;
                    var modalId = result.modalId;
                    $(modalId).find('.modal-content-wrapper').html(html);
                    $('div.modal-backdrop').fadeOut();
                    $(modalId).modal('show');
                    $(modalId).modal({backdrop: 'static', keyboard: false, show: true});
                    $(modalId).show();
                }
                if (action == "MODAL_CLOSE")
                {
                    var html = result.html;
                    var modalId = result.modalId;
                    $(modalId).modal('hide');
                    $('div.modal-backdrop').fadeOut();
                }
            } else
            {
                $('#ErrorMsg').html(result.message_error);
                $('#ErrorMsg').show();
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
