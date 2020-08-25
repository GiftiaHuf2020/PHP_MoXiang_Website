function ChangeCaptcha() {
    var chars = "0123456789"; 
    // You can include special characters by adding them to the string above, for eg: chars += "@#?<>";
    
    var string_length = 4; // This is the length of the Captcha
    // ****** CAUTION ****** This just determines the string that'll be produced by the function. To make the Captcha 
    // field compatible with the updated size, you'll have to change the maxlength attribute in the HTML code

    var ChangeCaptcha = '';
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        ChangeCaptcha += chars.substring(rnum,rnum+1);
    }
    
    document.getElementById('randomfield').value = ChangeCaptcha; // Final step which changes the field value to the Captcha produced
}

function check() { // Function which checks if the entered value is matching the Captcha
    if(document.getElementById('CaptchaEnter').value == document.getElementById('randomfield').value ) {
     
        // Change the page to which the re-direction is to be done.
        // '_self' parameter makes the webpage open in the same tab. If this effect isn't desired, simply remove it.

    }
    else {
        alert('Please re-check the captcha,验证码错误'); // The alert message that'll be displayed when the user enters a wrong Captcha
		return false;
    }
			var p1=document.form1.password.value;//获取密码框的值
			var p2=document.form1.comfirm_password.value;//获取重新输入的密码值
			if(p1==""){
			alert("");//检测到密码为空，提醒输入//
			document.form1.pwd1.focus();//焦点放到密码框
			return false;//退出检测函数
			}//如果允许空密码，可取消这个条件
			if(p1!=p2){//判断两次输入的值是否一致，不一致则显示错误信息
			alert('The Password is not same');//在div显示错误信息
/* 			$(document).ready(function(){
				$("form").click(function(event){
				event.preventDefault();
				});
			}); */
			return false;
			}else{
			//密码一致，可以继续下一步操作
			}	
	

}