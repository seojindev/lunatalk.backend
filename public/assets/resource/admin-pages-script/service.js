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
    edit_image: '',
    edit_product_select: null,
    edit_status: null,
}

var editHomePageFunction = ( function() {

    return {
        createPageStart: function() {
            console.debug('pageStart');
            let thisFuntion = this;

            // 등록 버튼
            $(document).on('click', '[name=submit-button]', function(e){
                e.preventDefault();

                editHomeMainFormData.edit_product_select = $('#product-select').val();
                editHomeMainFormData.edit_status = $('#edit-status').val();

                if(thisFuntion.checkValidation()) {

                    if(pageMode === 'create') {
                        thisFuntion.editCreate();
                    } else {
                        thisFuntion.editUpdate();
                    }

                }
            });

            if(pageMode === 'update') {
                thisFuntion.setPageData();
            }
        },
        listPageStart: function() {
            console.debug('listPageStart');

            $('#dataTable').DataTable({
                order: []
            });

            let thisFuntion = this;
            // 등록 버튼
            $(document).on('click', '[name=click-home-main-view]', function(e){
                e.preventDefault();
                var homemain_id = $(this).attr("homemain-id");
                location.href=`/front/admin/v1/service/edit-home-main/${homemain_id}/update`;
            });

            $(document).on('click', '[name=button-home-main-status-change]', function(e){
                e.preventDefault();
                var homemain_id = $(this).attr("homemain-id");
                var homemain_status = $(this).attr("homemain-status");

                if(homemain_status === 'Y') {
                    var confirmMsg = "안보이게 처리 하시겠습니까?";
                } else {
                    var confirmMsg = "보이게 처리 하시겠습니까?";
                }
                var confirmResult = confirm(confirmMsg);
                if(confirmResult) {
                    if(homemain_status === 'Y') {
                        thisFuntion.changeStatus(homemain_id, 'N');
                    } else {
                        thisFuntion.changeStatus(homemain_id, 'Y');
                    }
                }
            });
        },
        setPageData: function() {
            $('#product-select').val(pageData.product_uuid);
            $('#edit-status').val(pageData.status);

            editHomeMainFormData.edit_product_select = pageData.product_uuid;
            editHomeMainFormData.edit_status = pageData.status;
            editHomeMainFormData.edit_image = pageData.media_file.media_id;
        },
        checkValidation: function() {
            if(commonFunction.isEmpty(editHomeMainFormData.edit_product_select)) {
                commonFunction.globalAlert('상품을 선택해주세요.');
                return false;
            }

            return true;
        },
        editCreate: function() {
            commonFunction.ajaxUtil({
                url: `/api/v1/admin/service/edit-home-main`,
                payload: editHomeMainFormData,
                type: 'post',
                successCallback: editHomePageFunction.responseSuccess
            });
        },
        editUpdate: function() {
            commonFunction.ajaxUtil({
                url: `/api/v1/admin/service/${pageData.id}/edit-home-main`,
                payload: editHomeMainFormData,
                type: 'put',
                successCallback: editHomePageFunction.responseSuccess
            });
        },
        changeStatus: function(id, status) {
            var payload = {
                edit_status : status === 'Y' ? 'Y' : 'N'
            }
            commonFunction.ajaxUtil({
                url: `/api/v1/admin/service/${id}/edit-home-main/status`,
                payload: payload,
                type: 'post',
                successCallback: editHomePageFunction.responseSuccess
            });
        },
        responseSuccess: function(e) {
            commonFunction.globalAlert(e);
            location.href=`/front/admin/v1/service/edit-home-main/list`;
        }
    };
})();

$(function () {

});

