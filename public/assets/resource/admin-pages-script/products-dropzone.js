Dropzone.autoDiscover = false;

$(function () {

    // 상품 이미지
    $("div#dropzone_rep").dropzone({
        url: appServiceUrl  + '/api/v1/other/media/products/rep/create',
        addRemoveLinks: true,
        paramName: "media_file",
        // maxFiles:,
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 10,
        headers: {
            'Access-Control-Allow-Origin' : '*',
            'Accept': 'application/json',
            'Request-Client-Type' : serviceFrontCode,
            'Authorization' : 'Bearer ' + commonFunction.getCookie('access_token')
        },
        init: function () {
            this.on("success", function(file, responseText) {
                pageFormData.product_image.push(responseText.result.media_id);
            });
        },
    });

    // 상품 상세 이미지
    $("div#dropzone_detail").dropzone({
        url: appServiceUrl  + '/api/v1/other/media/product/detail/create',
        addRemoveLinks: true,
        paramName: "media_file",
        // maxFiles:,
        uploadMultiple: false,
        autoProcessQueue: true,
        parallelUploads: 10,
        headers: {
            'Access-Control-Allow-Origin' : '*',
            'Accept': 'application/json',
            'Request-Client-Type' : serviceFrontCode,
            'Authorization' : 'Bearer ' + commonFunction.getCookie('access_token')
        },
        init: function () {
            this.on("success", function(file, responseText) {
                pageFormData.product_detail_image.push(responseText.result.media_id);
            });
        },
    });


    // 등록 버튼
    $(document).on('click', '[name=submit-button]', function(e){
        e.preventDefault();

        pageFormData.product_category = $('#product_category').val();
        pageFormData.product_name = $('#product_name').val();
        pageFormData.product_option_step1 = $('#product_option_step1').val();
        pageFormData.product_option_step2 = $('#product_option_step2').val();
        pageFormData.product_price = $('#product_price').val();
        pageFormData.product_stock = $('#product_stock').val();
        pageFormData.product_barcode = $('#product_barcode').val();
        pageFormData.product_sale = $('#product_sale').val();
        pageFormData.product_active = $('#product_active').val();
        pageFormData.product_memo = $('#product_memo').val();

        if(pageFunction.checkValidation()) {
            pageFunction.tryProductAdd();
        }
    });

});
