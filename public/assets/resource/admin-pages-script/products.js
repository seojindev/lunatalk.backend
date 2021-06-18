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
    product_memo: null,
    product_image: [],
    product_detail_image: [],
}

var pageFunction = ( function() {
    return {
        checkValidation: function() {

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
            commonFunction.globalAlert(e);
            location.href="/front/admin/v1/products/list";
        }
    };
})();

