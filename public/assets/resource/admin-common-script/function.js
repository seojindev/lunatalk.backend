/**
 *
 * Lunatalk Javascript Function
 */
 var commonFunction = ( function() {
    return {
        ajaxUtil: function(option) {
            let access_token = commonFunction.getCookie('access_token');

            $.ajax({
                url: option.url,
                // data: option.payload,
                data: JSON.stringify(option.payload),
                type: option.type,
                dataType: "json",
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Accept","application/json");
                    xhr.setRequestHeader("Content-type","application/json");
                    xhr.setRequestHeader("Request-Client-Type","S010040");
                    xhr.setRequestHeader("Authorization","Bearer  " + access_token);
                },
            }).fail(function(xhr, status, errorThrown) {
                // console.debug(xhr);
                // let errorText = "오류가 발생했습니다.";
                // errorText += "오류명: " + errorThrown;
                // errorText += "상태: " + status;
                alert(xhr.responseJSON.error_message);
            }).done(function(json) {
                if(json.status === false) {
                    alert(json.message);
                } else {
                    if(json.result) {
                        option.successCallback(json.result);
                    } else {
                        option.successCallback(json.message);
                    }
                }
            }).always(function(xhr, status) {
                // $("#text").html("요청이 완료되었습니다!");
            });
        },
        number_format: function(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },
        setCookie: function(cookie_name, value, exp) {
            var date = new Date();
            date.setTime(date.getTime() + exp*24*60*60*1000);
            document.cookie = cookie_name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
        },
        getCookie: function(name) {
            var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
            return value? value[2] : null;
        },
    };
})();