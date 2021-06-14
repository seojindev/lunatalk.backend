/**
 * login page script
 */
 var loginPageFunction = ( function() {
    return {
        pageStart: async function () {
            let login_id = commonFunction.getCookie('login_name_save');
            if(login_id) {
                $( "input[name=idSaveCheck]:checkbox" ).attr( "checked", "checked" );
            }
            $('#login_name').val(login_id);

            $('#buttonTryLogin').on('click', function() {
                let login_name = $('#login_name').val();
                let login_password = $('#login_password').val();

                loginPageFunction.tryLogin({
                    login_name: login_name,
                    login_password: login_password,
                    idSave: $("input:checkbox[name=idSaveCheck]").is(":checked")
                });
            });

            $('#login_name').on('keydown', function(key) {
                if (key.keyCode == 13) {
                    $('#login_password').focus();
                }
            });

            $('#login_password').on('keydown', function(key) {
                if (key.keyCode == 13) {
                    let login_name = $('#login_name').val();
                    let login_password = $('#login_password').val();

                    loginPageFunction.tryLogin({
                        login_name: login_name,
                        login_password: login_password,
                        idSave: $("input:checkbox[name=idSaveCheck]").is(":checked")
                    });
                }
            });
        },

        tryLogin: function(loginInfo) {
            if(loginInfo.login_name === '') {
                alert('아이디를 입력해 주세요.');
                return false
            }

            if(loginInfo.login_password === '') {
                alert('비밃번호를 입력해 주세요.');
                return false
            }

            if(loginInfo.idSave === true) {
                commonFunction.setCookie('login_name_save', loginInfo.login_name, 31);
            }

            commonFunction.ajaxUtil({
                url: "/api/v1/admin/auth/login",
                payload: {
                    login_name: loginInfo.login_name,
                    login_password: loginInfo.login_password
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