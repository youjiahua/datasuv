<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://onface.live/admin/admin.css" />
    <link rel="stylesheet" href="{{asset('common/index.css')}}" />
    <title>登录</title>
    <style>
    html .m-login2-form-verifyimage {
        margin-top: -70px;
    }
    html .m-login2-form-input {
        height: 52px;
        line-height: 52px;
    }
    </style>
</head>
<body>
    <div class="m-login2">
         <div class="m-login2-form">
             <img class="m-login2-form-logo" src="http://7xpzm0.com2.z0.glb.qiniucdn.com/20170518164104_7451495096864.png" />
             <form class="m-login2-form-inner" id="mainForm" data-form-ajax="true"  action="/Auth/login" method="post">
                 <div class="m-login2-form-title">欢迎使用 DataSuv 管理后台</div>
                 <input name="mobile" required placeholder="手机号" type="text" class="m-login2-form-input" />
                 <input name="code" placeholder="验证码" type="text" class="m-login2-form-input" /><img class="m-login2-form-verifyimage" alt="点击刷新" data-login-verify-src="/Auth/verify" alt="" />
                 <div class="mo-grid">
                     <div class="mo-grid-16">
                         <input name="sms_code" placeholder="短信验证码" type="smscode" class="m-login2-form-input" />
                     </div>
                     <div class="mo-grid-8">
                         <button class="mo-btn" required type="button" id="sendSMS"
                         style="padding:0 20px;float:right;height:50px;line-height:50px;"
                          >发送验证码</button>
                     </div>
                 </div>
                 <input name="password" required placeholder="密码" type="password" class="m-login2-form-input" />
                 <input type="hidden" name="type" value="1" />
                 <button type="submit" class="m-login2-form-submit" >登录</button>
             </form>
         </div>
         <div class="m-login2-banner" style="background-image:url(http://7xpzm0.com2.z0.glb.qiniucdn.com/20170519102215_6571495160535.jpg);" >
             <div class="m-login2-banner-inner">
                 <div class="m-login2-banner-title">今天，我们对你的营销效果负责</div>
                 <div class="m-login2-banner-desc">DataSuv专注于多渠道数字营销Saas技术服务提供商</div>
                 <a href="/AboutUs" class="m-login2-banner-link">关于我们</a>
             </div>
         </div>
     </div>

    <script src="https://onface.live/admin/admin-deps.js"></script>
    <script src="https://onface.live/admin/admin.js"></script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
mo.$(function ($) {
    var busy = false
    $('#sendSMS').on('click', function () {
        if (busy) {
            return
        } 
        $.ajax({
            type: 'post',
            url: '/Auth/sms',
            data: $('#mainForm').serializeArray(),
            dataType: 'json'
        }).done(function (res){ 
            if (res.status === 'success') {
                alert('发送成功')
            }
            else {
                alert(res.msg)
            }
        }).always(function () {
            busy = false
        })
    })
})
</script>
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
</body>
</html>