// https://gist.github.com/kreativan/83febc214d923eea34cc6f557e89f26c
var productFormData = {
    product_category: null,
    product_name: null,
    product_option_step1: null,
    product_option_step2: null,
    product_price: null,
    product_stock: null,
    product_barcode: null,
    product_sale: null,
    product_active: null,
    product_memo: null,
    product_image: [],
    product_detail_image: [],
}

// 페이지 step 공통 함수.
var pageFunction = ( function() {
    return {
        checkValidation: function() {

            if(commonFunction.isEmpty(productFormData.product_category)) {
                commonFunction.globalAlert('상품 카테고리를 선택해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(productFormData.product_name)) {
                commonFunction.globalAlert('상품 명을 입력해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(productFormData.product_option_step1)) {
                commonFunction.globalAlert('첫번째 옵션을 선택해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(productFormData.product_image)) {
                commonFunction.globalAlert('상품 이미지를 입력해 주세요.');
                return false;
            }

            if(commonFunction.isEmpty(productFormData.product_detail_image)) {
                commonFunction.globalAlert('상품 상세 이미지를 입력해 주세요.');
                return false;
            }

            return true;
        }
    };
})();

// 등록 페이지 함수
var createPageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug('createPageFunction pageStart');
        },
        productCreate: function() {
            commonFunction.ajaxUtil({
                url: "/api/v1/admin/product/create",
                payload: productFormData,
                type: 'post',
                successCallback: createPageFunction.responseSuccess
            });
        },
        responseSuccess: function(e) {
            commonFunction.globalAlert(e);
            location.href="/front/admin/v1/products/list";
        }
    };
})();

// 수정 페이지 함수
var detailPageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug(':: detailPage Start ::');

            this.setDetailData();
        },
        setDetailData: function() {
            $('#product_category').val(pageData.category.code_id);
            $('#product_name').val(pageData.name);
            $('#product_option_step1').val(pageData.options.step1.code_id);
            $('#product_option_step2').val(pageData.options.step2.code_id);
            $('#product_price').val(commonFunction.number_format(pageData.price));
            $('#product_stock').val(commonFunction.number_format(pageData.stock));
            $('#product_barcode').val(pageData.barcode);

            $('#product_sale').val(pageData.sale);
            $('#product_active').val(pageData.active);

            $('#product_memo').val(pageData.memo);
        }
    };
})();

// 수정페이지 함수
var updatePageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug(':: updatePage Start ::');

            this.setDetailData();
        },
        setDetailData: function() {
            $('#product_category').val(pageData.category.code_id);
            $('#product_name').val(pageData.name);
            $('#product_option_step1').val(pageData.options.step1.code_id);
            $('#product_option_step2').val(pageData.options.step2.code_id);
            $('#product_price').val(pageData.price);
            $('#product_stock').val(pageData.stock);
            $('#product_barcode').val(pageData.barcode);

            $('#product_sale').val(pageData.sale);
            $('#product_active').val(pageData.active);

            $('#product_memo').val(pageData.memo);

            pageData.images.repImage.list.map((e) => {
                productFormData.product_image.push(e.media_id);
            });

            pageData.images.detailImage.list.map((e) => {
                productFormData.product_detail_image.push(e.media_id);
            });
        },
        productUpdate: function() {
            commonFunction.ajaxUtil({
                url: `/api/v1/admin/product/${pageData.uuid}/update`,
                payload: productFormData,
                type: 'put',
                successCallback: updatePageFunction.responseSuccess
            });
        },
        responseSuccess: function(e) {
            commonFunction.globalAlert(e);
            location.href=`/front/admin/v1/products/${pageData.uuid}/detail`;
        }
    };
})();

$(function () {
    // 등록 버튼
    $(document).on('click', '[name=submit-button]', function(e){
        e.preventDefault();

        productFormData.product_category = $('#product_category').val();
        productFormData.product_name = $('#product_name').val();
        productFormData.product_option_step1 = $('#product_option_step1').val();
        productFormData.product_option_step2 = $('#product_option_step2').val();
        productFormData.product_price = $('#product_price').val();
        productFormData.product_stock = $('#product_stock').val();
        productFormData.product_barcode = $('#product_barcode').val();
        productFormData.product_sale = $('#product_sale').val();
        productFormData.product_active = $('#product_active').val();
        productFormData.product_memo = $('#product_memo').val();

        if(pageFunction.checkValidation()) {
            createPageFunction.productCreate();
        }
    });

    // 목록 버튼
    $(document).on('click', '[name=golist-button]', function(e){
        e.preventDefault();

        location.href="/front/admin/v1/products/list"
    });

    // 수정 이동 버튼
    $(document).on('click', '[name=modify-button]', function(e){
        e.preventDefault();

        var uuid = pageData.uuid;
        location.href=`/front/admin/v1/products/${uuid}/update`;
    });

    // 수정 저장 버튼
    $(document).on('click', '[name=update-button]', function(e){
        e.preventDefault();

        productFormData.product_category = $('#product_category').val();
        productFormData.product_name = $('#product_name').val();
        productFormData.product_option_step1 = $('#product_option_step1').val();
        productFormData.product_option_step2 = $('#product_option_step2').val();
        productFormData.product_price = $('#product_price').val();
        productFormData.product_stock = $('#product_stock').val();
        productFormData.product_barcode = $('#product_barcode').val();
        productFormData.product_sale = $('#product_sale').val();
        productFormData.product_active = $('#product_active').val();
        productFormData.product_memo = $('#product_memo').val();

        if(pageFunction.checkValidation()) {
            updatePageFunction.productUpdate();
        }
    });
});
