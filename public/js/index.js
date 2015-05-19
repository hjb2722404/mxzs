/**
 * Created by hjb2722404 on 2015/5/19.
 */
$(function(){

    $("#regbtn").on("click",function(){

        var regname = $('#regName').val();
        var regpwd = $('#regPwd').val();
        var regphone = $('#regPhone').val();
        var isMobile=/^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
        if(regname=='' || regname.length<4){

            alert("请输入用户名,并确保其长度大于4个字符");
            return false;
        }else if(regpwd == '' || regpwd.length<6){

            alert("请输入密码,并确保其长度大于6个字符");
            return false;

        }else if(regphone== ''){

            alert("请输入联系电话");
            return false;
        }else if(!isMobile.test(regphone)){
            alert("亲，检查一下手机号码的格式吧！");
            return false;

        }


    });



    $("#loginbtn").on("click",function(){

        var loginname = $('#loginName').val();
        var loginpwd = $('#loginPwd').val();
        if(loginname=='' || loginname.length<4){

            alert("请输入用户名,并确保其长度大于4个字符");
            return false;
        }else if(loginpwd == '' || loginpwd.length<6){

            alert("请输入密码,并确保其长度大于6个字符");
            return false;

        }

    });

    $("#regName").blur(function(){
        var regname = $("#regName").val();
        $.ajax({ //调用jquery的ajax方法
            type: "POST", //设置ajax方法提交数据的形式
            url: "../admin/checkuname.php", //把数据提交到ok.php
            data: "uname="+regname, //输入框writer中的值作为提交的数据
            success: function(msg){ //提交成功后的回调，msg变量是ok.php输出的内容。
                var msgh = msg;
              / var res=eval(msgh.res);
                alert(res);
            }
        });

    });

});

