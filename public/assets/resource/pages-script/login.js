/**
 * login page script
 */
 var loginPageFunction = ( function() {
    return {
        pageStart: async function () {
            let login_id = commonFunction.getCookie('admin_id_save');
            if(login_id) {
                $( "input[name=idSaveCheck]:checkbox" ).attr( "checked", "checked" );
            }
            $('#admin_id').val(login_id);

            $('#buttonTryLogin').on('click', function() {
                let admin_id = $('#admin_id').val();
                let admin_password = $('#admin_password').val();

                loginPageFunction.tryLogin({
                    id: admin_id,
                    password: admin_password,
                    idSave: $("input:checkbox[name=idSaveCheck]").is(":checked")
                });
            });

            $('#admin_id').on('keydown', function(key) {
                if (key.keyCode == 13) {
                    $('#admin_password').focus();
                }
            });

            $('#admin_password').on('keydown', function(key) {
                if (key.keyCode == 13) {
                    let admin_id = $('#admin_id').val();
                    let admin_password = $('#admin_password').val();

                    loginPageFunction.tryLogin({
                        id: admin_id,
                        password: admin_password,
                        idSave: $("input:checkbox[name=idSaveCheck]").is(":checked")
                    });
                }
            });
        },

        tryLogin: function(loginInfo) {
            if(loginInfo.id === '') {
                alert('아이디를 입력해 주세요.');
                return false
            }

            if(loginInfo.password === '') {
                alert('비밃번호를 입력해 주세요.');
                return false
            }

            if(loginInfo.idSave === true) {
                commonFunction.setCookie('admin_id_save', loginInfo.id, 31);
            }

            commonFunction.ajaxUtil({
                url: "/api/v1/admin/auth/login",
                payload: {
                    admin_id: loginInfo.id,
                    admin_password: loginInfo.password
                },
                type: 'post',
                successCallback: loginPageFunction.loginSuccess
            });
        },
        loginSuccess: function(e) {
            alert('로그인이 완료 되었습니다.');

            commonFunction.setCookie('access_token', e.access_token);
            commonFunction.setCookie('refresh_token', e.refresh_token);

            location.href='/front/admin/v1/dashboard';

        }
    };
})();

$(function () {
    loginPageFunction.pageStart();
});

$(document).ready(function() {

});