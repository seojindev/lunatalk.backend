'use strict';

// 서비스 공지 사항 페이지
var serviceNoticePageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug('serviceNoticePageFunction pageStart');

            // 등록 버튼
            $(document).on('click', '[name=submit-button]', function(e){
                e.preventDefault();

                let service_notice_message = $('#service_notice_message').val();

                commonFunction.ajaxUtil({
                    url: `/api/v1/admin/service/service-notice`,
                    payload: {
                        notice_message : service_notice_message
                    },
                    type: 'post',
                    successCallback: serviceNoticePageFunction.responseSuccess
                });
            });

            // 삭제 버튼
            $(document).on('click', '[name=delete-button]', function(e){
                e.preventDefault();


                commonFunction.ajaxUtil({
                    url: `/api/v1/admin/service/service-notice`,
                    payload: {},
                    type: 'delete',
                    successCallback: serviceNoticePageFunction.responseSuccess
                });
            });
        },
        responseSuccess: function(e) {
            commonFunction.globalAlert(e);
            location.reload();
        },
    };
})();

// 홈 편집
var editHomeMainFormData = {
    edit_image: [],
    edit_product_select: null,
    edit_status: null,
}

var serviceEditHomeMainCreatePageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug('pageStart');
            let thisFuntion = this;

            // 등록 버튼
            $(document).on('click', '[name=submit-button]', function(e){
                e.preventDefault();

                editHomeMainFormData.edit_product_select = $('#product-select').val();
                editHomeMainFormData.edit_status = $('#edit-status').val();

                if(thisFuntion.checkValidation()) {
                    thisFuntion.editCreate();
                }

            });
        },
        checkValidation: function() {
            if(commonFunction.isEmpty(editHomeMainFormData.edit_product_select)) {
                commonFunction.globalAlert('상품을 선택해주세요.');
                return false;
            }

            return true;
        },
        editCreate: function() {
            console.debug('editCreate');
        },
    };
})();

$(function () {

});
