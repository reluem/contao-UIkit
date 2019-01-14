"use strict";

/*
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2019 Leo Feyer
 *
 * @author    reluem
 * @license   GNU/LGPL
 * @copyright reluem 2019
 */

var viewportWidth = document.querySelectorAll(".uk-width-viewport");
var setMargin = function setMargin() {
    requestAnimationFrame(function () {
        [].forEach.call(viewportWidth, function (e) {
            e.style.marginLeft = "";
            e.style.marginLeft = -e.offsetLeft + "px";
            e.style.width = document.body.clientWidth + "px";
        });
    });
};
setMargin();

window.onresize = setMargin;