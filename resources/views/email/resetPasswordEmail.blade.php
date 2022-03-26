<!DOCTYPE html>
<html>
<head>
    <title>lunatalk</title>
    <style>
        body {
            width:100%;
        }
        h2{
            letter-spacing: -1.5px;
            margin:0;
            margin-bottom:5px;
            color:#333;
            font-size:32px;
            text-align: center;
        }

        strong {
            letter-spacing: -1px;
            margin-right: 5px;
            font-size:22px;
            text-align: center;
            color:#333;
            width:100%;
            display: block;
            font-size:27px;
            font-weight: 400;
        }
        div {
            width:100%;
            margin:0 auto;
            margin-bottom: 20px;
            padding:10px 0;
        }
        img {
            width:150px;
            display: block;
            margin:0 auto;
        }
        p {
            margin:0;
            color:#333;
            font-size:16px;
            letter-spacing: -1px;
            text-align: center;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <div style="border-top: 2px solid #333; border-bottom: 2px solid #333; padding:40px 0">
        <p style="letter-spacing: -1px; font-size:16px; margin-bottom: 5px;">Lunatalk</p>
        <h2 style="margin-bottom: 20px;">회원님의 아이디 비밀번호 <span style="fon-size:12px; font-weight: 300; color:#333">안내입니다.</span></h2>
        <p>안녕하세요.</p>
        <p>요청하신 회원님의 아이디와 초기화된 비밀번호입니다.</p>
        <p>확인후 로그인하세요.</p>
        <div>
            <p>아이디 : <strong>{{$details['loginId']}}</strong></p>
            <p>비밀번호 : <strong>{{$details['password']}}</strong></p>
        </div>
        <div>
            <img src="http://dev.admin.lunatalk.co.kr/static/media/logo.e0e49014.jpg" alt="logo">
        </div>
    </div>
</body>
</html>
