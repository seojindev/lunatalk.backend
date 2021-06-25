// 서비스 공지 사항 페이지
var serviceNoticePageFunction = ( function() {
    return {
        pageStart: function() {
            console.debug('serviceNoticePageFunction pageStart');
        },
        responseSuccess: function(e) {
            commonFunction.globalAlert(e);
            location.reload();
        },
    };
})();

$(function () {
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
});
