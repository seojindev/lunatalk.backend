/**
 *
 * Lunatalk Common Javascript
 */

(function($) {
    "use strict";

    $("[name=goPageURL]").on("click", function(){
        location.href=$(this).attr("pageUrl");
    });

})(jQuery);