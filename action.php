<!--注册-->
<?php
if(isset($_POST['submit'])){	
	$serverName = "127.0.0.1,1433"; //数据库服务器地址
	$uid = "sa"; //数据库用户名
	$pwd = "123456"; //数据库密码
	$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"mhcmember","CharacterSet"=>"utf-8");
	$conn = sqlsrv_connect($serverName, $connectionInfo);		
	extract($_POST);
	
	$id_loginid = $_POST['Username'];
	$id_passwd = $_POST['pswd'];
	
	if($id_loginid!=""){
		$sql = "SELECT id_loginid FROM chr_log_info Where id_loginid='$id_loginid'";
		$stmt = sqlsrv_query( $conn, $sql );
		$fetch=sqlsrv_fetch_array($stmt);
		if($fetch == true) {
			echo '<script language="javascript">';
			echo 'alert("用戶名已存在")';
			echo '</script>';
			header('Refresh: 0; URL=index.php');
			//echo '<script>$("#myModal").modal("show");</script>';			
		}
		else{
			$sql1 = "INSERT INTO chr_log_info(propid,id_loginid,id_passwd,UserLevel) 
			VALUES ((SELECT ISNULL(MAX(propid) + 1,0) FROM chr_log_info),'$id_loginid','$id_passwd','2')";
			$result=sqlsrv_query($conn,$sql1);
			//if query success the below message will be show
			if($result == true){
				echo '<script language="javascript">';
				echo 'alert("註冊成功")';
				echo '</script>';	
				header('Refresh: 0; URL=index.php');				
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("註冊失敗")';
				echo '</script>';
				header('Refresh: 0; URL=index.php');
				//echo '<script>$("#myModal").modal("show");</script>';
			} 			
		}
	}
	sqlsrv_close( $conn );
}
?>
<!--End of 注册-->

<!--登入-->
<?php
if(isset($_POST['login'])){
	$serverName = "127.0.0.1,1433"; //数据库服务器地址
	$uid = "sa"; //数据库用户名
	$pwd = "123456"; //数据库密码
	$connectionInfo = array("UID"=>$uid, "PWD"=>$pwd, "Database"=>"mhcmember","CharacterSet"=>"utf-8");
	$conn = sqlsrv_connect($serverName, $connectionInfo);		
	extract($_POST);
	
	$id_loginid = $_POST['Username'];
	$id_passwd = $_POST['Password'];
	
	if($id_loginid!=""){
		$sql = "SELECT id_loginid FROM chr_log_info Where id_loginid='$id_loginid'";
		$stmt = sqlsrv_query( $conn, $sql );
		$fetch=sqlsrv_fetch_array($stmt);
		if($fetch == false) {
			echo '<script language="javascript">';
			echo 'alert("用戶名不存在")';
			echo '</script>';		
			?>
			<script>
			setTimeout(function() {
			history.go(-1);
			}, 1);
			</script>
			<?php	
		}
		else{
			$sql = "SELECT id_loginid,id_passwd FROM chr_log_info Where id_loginid='$id_loginid' AND id_passwd='$id_passwd'";
			$stmt = sqlsrv_query( $conn, $sql );
			$fetch=sqlsrv_fetch_array($stmt);
			if($fetch == false) {
				echo '<script language="javascript">';
				echo 'alert("密碼錯誤")';
				echo '</script>';
				?>
				<script>
				setTimeout(function() {
				history.go(-1);
				}, 1);
				</script>
				<?php					
			}
			else{
				echo '<script language="javascript">';
				echo 'alert("登入成功")';
				echo '</script>';
				session_start();
				$_SESSION['UsernameID']=$id_loginid;
				header('Refresh: 0; URL=index.php');				
			}	
		}			
	}
	sqlsrv_close( $conn );
}
?>
<!--End of 登入-->

<!--登出-->
<?php

if(isset($_POST['logout'])){
	session_start();
	session_destroy();
	header('Refresh: 0; URL=index.php');
}
?>
<!--End of 登出-->