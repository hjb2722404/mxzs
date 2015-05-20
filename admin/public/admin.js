// JavaScript Document
$(document).ready(function(){
			
	$('.input_text').focus(function(){
				if($(this).attr('title')==$(this).val())
					{
						$(this).val('');	
					}
				$(this).css({backgroundPosition:'-8px -168px'})	
			})
			
	$('.input_text').blur(function(){
				if($(this).val()=='')
					{
						$(this).val($(this).attr('title'));	
					}
				$(this).css({backgroundPosition:'-8px -13px'})	
			});
	
	$('#admin_pwdpro').focus(function(){
								   
			$('#admin_pwdpro').hide();	
			$('#admin_pwd').show();
			$('#admin_pwd').focus();
							   
								   
	 })
	
	$('#login_submit').click(function(){
										
			if($('#admin_name').val()=='用户名'){
				
				alert("请输入用户名");
			}else if($('#admin_pwd').val()== ''){

				
				alert("请输入密码");
				
			}else{
			
				$('#login_panel').submit();
			}
			});

						   
});