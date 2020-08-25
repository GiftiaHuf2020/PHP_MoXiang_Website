<!DOCTYPE html>
<html>
<?php session_start(); //use session function  
?>
<head>
    <!--網站的標題/名字-->
    <title>Giftia墨香官方網站</title>
    <meta name="keywords" content="Giftia墨香|墨香私服|墨香|墨香OL|墨香Online|墨湘" />
    <meta name="description" content="Giftia墨香" />
    <link rel="Shortcut Icon" href="Images/logo-sm.png" />
    <link rel="Bookmark" href="Images/logo-sm.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--引入Bootsrap4美化網頁-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!--Font Style-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC&display=swap" rel="stylesheet">
	
	<!--captcha-->
	<link rel="stylesheet" href="css/captcha1.css">
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/captcha1.js"></script> 
</head>

<!--自定義CSS-->
<style>
/*網站背景顏色*/
html{
    background: black;
    
    /*鼠標設定*/
    cursor: url(Images/Cursor/default.cur),auto!important;
}

body{
    background: url(Images/bg_top.jpg) center top no-repeat;
    width:100%;
    height:auto;
}

/*鏈接取消Underline*/
a{
    text-decoration: none;
    color: blanchedalmond;
    font-size: 18px;
}

/*鼠標設定*/
a:hover{
    cursor: url(Images/Cursor/attack.cur),auto!important;
    color:tomato;
    text-decoration: none;
}

/*字體顏色*/
p{
    color:blanchedalmond;
    padding: 2px;
    margin: 0px 30px 0px 10px;
}

.Nav_bar{
    background: url(Images/nav.png);background-size: cover;
    min-height: 54px;
    color:blanchedalmond;
}

/*中間Logo圖*/
.logoDiv{
    min-width: 100%;
    min-height: 450px;
}

/*遊戲介紹..(LeftNav)*/
.DescriptionDiv{
    min-width: 100%;
    min-height: 280px;
}

/*遊戲簡介*/
.LeftNav{
    background:url(Images/leftnav_bg.png);
    background-repeat: no-repeat;
    min-height: 100%;
    min-width: 100%;
    margin-left: 35px;
    text-align: left;
    font-size: 13px;
}

/*維修公告(RightNav)*/
.RightNav{
    background:url(Images/right_nav_bg.png);
    background-repeat: no-repeat;
    min-height: 100%;
    min-width: 100%;
    margin-left: -17px;
    text-align: left;
    font-size: 13px;
}

/*調整手機View界面*/
@media only screen and (max-width: 600px) {
    .RightNav{
        background:url(Images/right_nav_bg.png);
        background-repeat: no-repeat;
        min-height: 100%;
        min-width: 100%;
        margin-left: 35px;
        text-align: left;
        font-size: 13px;
    }
}

/*賬號和密碼寬設計*/
#InputBox{
    margin-bottom: 5px;
}

/* Make the image fully responsive */
.carousel-inner img {
    width: 100%;
    height: 272px;
}

/*宣傳圖-第三列*/
.PromoteSection{
    background:url(Images/middle_left_bg.png);
    background-repeat: no-repeat;
    min-height: 450px;
    min-width: 100%;
    font-size: 13px;
}

/*最新消息*/
h1{
    color:blanchedalmond;
    font-size: 25px;
    border-left:5px solid blanchedalmond;
    font-weight: bold;
}
.news a:hover{
    background: #F1161B;
}
button{
  padding: 0;
  border: 0 none;
}
</style>
<!--数据库状况-->
<?php
	$serverName = "127.0.0.1,1433"; //数据库服务器地址
	$uid = "sa"; //数据库用户名
	$pwd = "123456"; //数据库密码
	$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"mhcmember","CharacterSet"=>"utf-8");
	$conn = sqlsrv_connect($serverName, $connectionInfo);
	$connectstatus = "";
	if( $conn == false)
	{
		$connectstatus = '<p style="color:red"><span style="padding: 0px 5px;">&#8226;</span>数据库连接失败</p>';
		var_dump(sqlsrv_errors());
		exit;
	}
	else
	{
		$connectstatus = '<p style="color:green"><span style="padding: 0px 5px;">&#8226;</span>数据库连接成功</p>';
	}
?>
<!--End of 数据库状况-->

<!-- 遊戲帳號註冊 -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">

		<!-- Modal Header -->
		<div class="modal-header">
			<h4 class="modal-title">遊戲帳號註冊(Register)</h4><?php echo $connectstatus;?>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

		<!-- Modal body -->
		<div class="modal-body">
			<form action="action.php" method="post" onsubmit="return CheckPwd()">
				<div class="form-group">
					<label for="text">登陸帳號:</label>
					<input type="text" class="form-control" id="text" placeholder="输入账号" name="Username" required>
				</div>
				<div class="form-group">
					<label for="pwd">密碼:</label>
					<input type="password" class="form-control" id="pwd" placeholder="输入密碼" name="pswd" required>
				</div>
				<div class="form-group">
					<label for="pwd1">確認密碼:</label>
					<input type="password" class="form-control" id="pwd1" placeholder="输入確認密碼" name="pswd1" required>
				</div>
				<div class="form-group">		
					<input id="CaptchaEnter" name="CaptchaI" size="20" maxlength="4" />
					<input type="text" id="randomfield" disabled>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">註冊(Register)</button>
			</form>
		</div>
		<script>
		function CheckPwd(){
			if(document.getElementById("pwd").value == document.getElementById("pwd1").value){
				return check();
			}else{
				alert("密碼和確認密碼不一致");
				return false;
			}
		}

		</script>

		<!-- Modal footer -->
		<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		</div>

		</div>
	</div>
</div>
<!--End 遊戲帳號註冊 -->

<!--網頁內容-->
<body onLoad="ChangeCaptcha()">
    <div class="Nav_bar fixed-top">
        <div class="d-flex justify-content-between">
            <div class="p-3"><img src="Images/sound_on.gif"></div>
            <div class="p-3">
                <a href="#">墨 香 主 頁</a>
            </div>
            <div class="p-3">
                <a href="#">特 色 玩 法</a>
            </div>
            <div class="p-3">
                <a href="#">下 載 中 心</a>
            </div>
            <div class="p-3">
                <a href="#">會 員 中 心</a>
            </div>
            <div class="p-3">
                <a href="#">讚 助 儲 值</a>
            </div>
            <div class="p-3">  
                <a href="#">客 服 中 心</a>
            </div>
            <div class="p-3"></div>
            <div class="p-3"></div>
        </div>
    </div>

    <div class="container">
        <div class="row logoDiv">
            <div class="col-sm-4"></div>
            <!--Logo 圖-->
            <div class="col-sm-4" style="margin-top:170px;">
                <!--借 新墨香徽章-->
                <a href="#"><img src="https://mx.moyoi.cn/i/allimg/150728/1_150728192623_1.png" width=100%></a>
            </div>
            <div class="col-sm-4"></div>
        </div>
        
        <div class="row DescriptionDiv">
            <!--遊戲簡介（左）-->
            <div class="col-sm-3">
                <div class="LeftNav">
                    <div style="min-height: 120px;">&nbsp;</div>
                    <p><span style="color:#fffdcf;">Giftia墨香 - 慢服版</span></p>
                    <p><span style="color:#FF0000;">5級泡點</span>，<span style="color:#FF00FF;">不設轉生</span>，<span style="color:#00CED1;">傷害平衡</span></p>
                    <p>經驗5倍; 被動:5倍; 掉寳:2倍</p>
                    <p>原始風格玩法，等级上限暂为Lv.99</p>
                    <p>設定平衡全部靠自己練功殺人越貨</p>
                    <p style="color:#FF0000;"><strong>目前全服人氣火爆期待閣下的加入</strong></p>
                    <p>&nbsp;</p>
                </div>
            </div>

            <!--遊戲宣傳圖-->
            <div class="col-sm-6">
                <div class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                    </ul>
                    
                    <!-- The slideshow -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="Images/PPT1.png">
                        </div>
                        <div class="carousel-item">
                        <img src="Images/PPT2.png">
                        </div>
                    </div>
                </div>
            </div>
            
            <!--維修公告-->
            <div class="col-sm-3">
                <div class="RightNav">

                    <!--維修時間-->
                    <div style="padding:13px 5px 0px 10px">
                        <img src="Images/btn_Maintain.jpg">
                    </div>

                    <!--註冊按鈕-->
                    <div style="padding:13px 5px 0px 10px">
                        <a data-toggle="modal" data-target="#myModal"><img src="Images/register.jpg"></a>
                    </div>
					
                    <!--登入表格-->
                    <form action="action.php" method="post">
                        <div class="row" style="padding:13px 0px 0px 10px;max-width: 270px;margin-top:-15px;">
				
                            <div class="col-6">
								<?php
								//登入
								if(isset($_SESSION['UsernameID'])){
									$UsernameID = $_SESSION['UsernameID'];
									echo '<input type="text" size="15" style="height:20px;margin-top:5px;" value="歡迎'.$UsernameID.'光臨" readonly="readonly">';
								}
								else{
								?>
								<input type="text" id="InputBox" name="Username" size="15" style="height:20px;margin-top:5px;" placeholder="輸入賬號" required><br>
								<input type="password" id="InputBox" name="Password" size="15" style="height:20px" placeholder="輸入密碼" required>
								<?php
								}
								?>
                            </div>
                            <div class="col-6" style="padding:0px;">
								<?php
								//登入
								if(isset($_SESSION['UsernameID'])){
									echo '<button type="submit" name="logout" style="margin-left:15px;color:tomato;margin-top:5px;">登出</button>';
								}
								else{
								?>
                                <button type="submit" name="login" style="margin-left:15px;margin-top:5px;"><img src="Images/login.png"></button>
								<?php
								}
								?>
                            </div>						
                        </div>
                    </form>

                    <!--QQ群-->
                    <div style="padding:5px 5px 0px 10px">
                        <a href="#"><img src="Images/group.png"></a>
                    </div>
                    
                    <p>&nbsp;</p>



                </div>
            </div>
        </div>

        <!--宣傳圖+最新消息-->
        <div class="row">
            <!--宣傳圖-->
            <div class="col-sm-6">
                <div class="PromoteSection">
                    <div style="min-height: 240px;">&nbsp;</div>
                    <div style="text-align:center;">
                        <p>龐大的遊戲世界，一方面展現出中國名勝古蹟的特色場景</p>
                        <p>匯聚各個朝代的風雲人物，另一方面讓你暢遊西方中世紀的森林與城</p>
                        <p>堡，使玩家仿如置身其中地感受神秘的東西方文化</p>
                        <p>親歷其境踏足這個奇幻世界。</p>
                    </div>
                </div>
            </div>

            <!--最新消息-->
            <div class="col-sm-6">
                <h1>&nbsp;最新消息</h1>
                <div style="border-top: 1px solid blanchedalmond;max-width:90%">
                </div>
                <!--公告-->
                <div class="row news" style="margin-left:10px;margin-top:5px;">
                    <span class="badge badge-info">更新</span>
                    <a href="#"><p style="font-size: 13px;min-width:300px;">開放南戴河</p></a>
                    <p style="color:#767171;">2020-5-13</p>
                </div>
                <div class="row news" style="margin-left:10px;margin-top:5px;">
                    <span class="badge badge-danger">系統</span>
                    <a href="#"><p style="font-size: 13px;min-width:300px;">開始宣傳</p></a>
                    <p style="color:#767171;">2020-5-13</p>
                </div>

                <div style="margin-left:10px;margin-top:5px;">
                    <!--Facebook Social Plugin-->
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fgiftiahuf%2F&tabs&width=340&height=70&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="100%" height="100" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>	
                </div>

            </div>
        </div>

        <!--Footer-->
        <div style="border-top:1px solid blanchedalmond;text-align: center;font-size:13px;">
            <p>免責聲明：本站所有程序均來自互聯網收集而來，版權歸原創者所有。如果有侵犯到您的權益，請及時聯絡本站管理員。</p>
            <p>Copyright © 2020 GiftiaHuf <img src="Images/GiftiaLogo.bmp" width="100" height="20"> All Rights Reserved. </p>
        </div>

    </div>

</body>
    <!--12歲溫習提示-->
    <p style="text-align:right">
        <img src="Images/12r.png">
    </p>
</html>