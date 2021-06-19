/**
 *
 * Lunatalk Common Javascript
 */

(function($) {
    "use strict";

    $("[name=goPageURL]").on("click", function(){
        location.href=$(this).attr("pageUrl");
    });

    $("[name=click-product-view]").on("click", function(){
        var product_uuid = $(this).attr("product_uuid");
        location.href=`/front/admin/v1/products/${product_uuid}/detail`;
    });

})(jQuery);
