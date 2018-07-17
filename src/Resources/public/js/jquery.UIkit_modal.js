// contao-UIkit/assets/js/jquery.UIkit_modal.js


(function ($) {

    var UIkitModal = {
        init: function () {
            this.bindToggle();

        },
        bindToggle: function () {
            $('.modal-toggle').on('click', function () {
                var $el = $(this),
                    url = $el.attr('data-href'),
                    id = $el.attr('data-modal');

                if (!url) {
                    return false;
                }
                //console.log(url);

                $.ajax({
                    url: url,
                    dataType: 'json',
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 301) {
                            location.href = jqXHR.responseJSON.result.data.url;
                            closeModal(jqXHR.responseJSON, $form);
                            return;
                        }
                        //console.log("error");

                    },
                    success: function (response, textStatus, jqXHR) {
                        //console.log("success");


                        if (typeof response === 'undefined') {
                            return;
                        }
                        if (response.result.html && response.result.data.id) {
                            var $modal = $(response.result.html);
                            //console.log($modal);
                            if ($('.modal').length === 0) {
                                // code to run if it isn't there
                                $('body').append($modal);
                            }
                            UIkit.modal(id).show();

                            if (typeof response.result.data.url !== 'undefined') {
                                history.pushState(null, null, response.result.data.url);
                            }
                        }
                    }
                });

                return false;

            });
        },
    };

    $(function () {
        UIkitModal.init()
    });

})(jQuery);
