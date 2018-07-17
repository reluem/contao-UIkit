// contao-UIkit/assets/js/js.UIkit_modal.js

document.addEventListener('DOMContentLoaded', function () {


    var classname = document.querySelectorAll('[data-modal]');


    for (var i = 0; i < classname.length; i++) {
        classname[i].addEventListener('click', function UIkitModal(event) {
            console.log("started function");

            var el = this,
                url = el.getAttribute("href"),
                id = el.getAttribute("data-modal");
            event.preventDefault();

            //console.log(url);


            if (!url) {
                return false;
            }

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
                credentials: 'same-origin'
            }).then(function (data) {
                // Convert to JSON
                return data.json();
            }).then(function (response) {

                if (typeof response === 'undefined') {
                    return;
                }
                if (response.result.html && response.result.data.id) {
                    //console.log(response.result.html);
                    if (document.querySelector('#uk-modal') !== null) {
                        var elem = document.getElementById("uk-modal");
                        elem.parentNode.removeChild(elem);
                    }

                    // code to run if it isn't there
                    var wrapper = document.createElement('div');
                    wrapper.innerHTML = response.result.html;
                    document.body.appendChild(wrapper.firstChild);

                    UIkit.modal(id).show();
                    // if (typeof response.result.data.url !== 'undefined') {
                    //     history.pushState(null, null, response.result.data.url);
                    //     console.log("result data url:" + response.result.data.url);
                    //
                    // }
                }
            });

        })
        //console.log("listener added");

    }

});