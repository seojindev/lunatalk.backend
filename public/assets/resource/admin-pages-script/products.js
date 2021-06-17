// https://gist.github.com/kreativan/83febc214d923eea34cc6f557e89f26c
var pageFormData = {
    product_category: null,
    product_name: null,
    product_option_step1: null,
    product_option_step2: null,
    product_price: null,
    product_stock: null,
    product_barcode: null,
    product_sale: null,
    product_active: null,
    product_image: null,
    product_thumbnail_image: null,
    product_detail_image: null
}

Dropzone.autoDiscover = false;

var pageFunction = ( function() {
    return {
        checkValidation: function() {

            pageFormData.product_category = $('#product_category').val();
            pageFormData.product_name = $('#product_name').val();
            pageFormData.product_option_step1 = $('#product_option_step1').val();
            pageFormData.product_option_step2 = $('#product_option_step2').val();
            pageFormData.product_price = $('#product_price').val();
            pageFormData.product_stock = $('#product_stock').val();
            pageFormData.product_barcode = $('#product_barcode').val();
            pageFormData.product_sale = $('#product_sale').val();
            pageFormData.product_active = $('#product_active').val();

            if(commonFunction.isEmpty(pageFormData.product_category)) {
                commonFunction.globalAlert('상품 카테고리를 선택해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(pageFormData.product_name)) {
                commonFunction.globalAlert('상품 명을 입력해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(pageFormData.product_option_step1)) {
                commonFunction.globalAlert('첫번째 옵션을 선택해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(pageFormData.product_image)) {
                commonFunction.globalAlert('상품 이미지를 입력해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(pageFormData.product_thumbnail_image)) {
                commonFunction.globalAlert('상품 썸네일 이미지를 입력해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(pageFormData.product_detail_image)) {
                commonFunction.globalAlert('상품 상세 이미지를 입력해 주세요.');
                return false;
            }

            return true;
        },
        tryProductAdd: function() {
            commonFunction.ajaxUtil({
                url: "/api/v1/admin/product/create",
                payload: pageFormData,
                type: 'post',
                successCallback: pageFunction.addSuccess
            });
        },
        addSuccess: function(e) {
            console.debug(e);
        }
    };
})();

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
                pageFormData.product_image = responseText.result.media_id;
            });
        },
    });

    // 상품 상세 이미지
    $("div#dropzone_detail").dropzone({
        url: appServiceUrl  + '/api/v1/other/media/products/dropzone_detail/create',
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
                pageFormData.product_detail_image = responseText.result.media_id;
            });
        },
    });

    // 상품 썸네일 이미지
    $("div#dropzone_thumbnail").dropzone({
        url: appServiceUrl  + '/api/v1/other/media/products/thumbnail/create',
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
                pageFormData.product_thumbnail_image = responseText.result.media_id;
            });
        },
    });


    // 등록 버튼
    $(document).on('click', '[name=submit-button]', function(e){
        e.preventDefault();

        if(pageFunction.checkValidation()) {
            pageFunction.tryProductAdd();
        } else {
            console.debug('bad');
        }
    });

});
