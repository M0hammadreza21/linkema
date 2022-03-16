<?php
ob_start();
session_start();
if (isset($_SESSION["id"]))
{
    header('Location: https://linkema.com/dashboard.php?user_id='.$_SESSION["user_id"]);
}

$error_message = '';

const DB_HOST = 'localhost';
	const DB_USER = 'linkemac_mohammadreza';
	const DB_PASS = 'pyax}nO-[nYW';
	const DB_NAME = 'linkemac_database';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (isset($_GET["action"]))
{
    switch ($_GET["action"]) {

    case "step1":
        $email = trim($_POST["email"]);

		$sql = "SELECT * from user WHERE email LIKE '{$email}' LIMIT 1";
    	$result = $mysqli->query($sql);
    	
    	$row = mysqli_fetch_assoc($result);
    	if (!$result->num_rows == 1) {
    		$error_message = "چنین ایمیلی وجود ندارد. از صحت آدرس ایمیل وارد شده مطمئن شده و مجددا سعی کنید";

    	} else {

    	    function getRandomString($length = 5) {
            $validCharacters = "abcdefghijklmnopqrstuxyvwzABCDEFGHIJKLMNOPQRSTUXYVWZ1234567890";
            $validCharNumber = strlen($validCharacters);
 
            $result = "";
 
            for ($i = 0; $i < $length; $i++) {
                $index = mt_rand(0, $validCharNumber - 1);
                $result .= $validCharacters[$index];
            }
 
            return $result;
        }
 

    	    
    	    $change_password_code = getRandomString();

    	    $first_line = "سلام. درخواستی مبنی بر تغییر رمزعبورتان در سایت لینک ما داده شده است";
    	    $second_line = $change_password_code." : کد اعتبارسنجی";
    	    $third_line = "تیم پشتیبانی لینک ما";
            $msg = $first_line."\n".$second_line."\n".$third_line."\n";

            $msg = wordwrap($msg,70);

            mail($email,"لینک ما | تغییر رمزعبور",$msg);
    		$error_message = "یک کد به نشانی ایمیل تان ارسال شده است. آنرا وارد کنید";
            
    		$_SESSION["change_password_code"] = $change_password_code;
    		$_SESSION["step_one"] = true;
            $_SESSION["email"] = $email;
            header('Location: https://linkema.com/reset_password.php?action=enter_code');
    	}
  
    break;
  case "step2":
    if (!isset($_SESSION["step_one"]))
        {
            header('Location: https://linkema.com/reset_password.php');
        }



		$code = $_POST["code"];
    	$change_password_code = $_SESSION["change_password_code"] ;
        if ($code === $change_password_code){
            $_SESSION["step_two"] = true;
            header('Location: https://linkema.com/reset_password.php?action=change_password');
        }
        else {
            header('Location: https://linkema.com/reset_password.php?action=enter_code');
            $error_message = "کد وارد شده صحیح نمی باشد";
        }
    break;
  case "step3":
    if (!isset($_SESSION["step_two"]))
        {
        header('Location: https://linkema.com/reset_password.php?action=enter_code');
        }

    require_once "config.php";
    $email = $_SESSION["email"];
    $new_password = "";
    $confirm_new_password = "";

    if(isset($_POST["new_password"]) && !empty($_POST["new_password"])){

            $new_password = md5($_POST["new_password"]);

	           $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
                $options = [
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ];
            try {
              $pdo = new PDO($dsn, $db_user, $db_password, $options);
            } catch (Exception $e) {
              error_log($e->getMessage());
              exit('Something weird happened');
            }
            $stmt = $pdo->prepare("UPDATE user SET password=? WHERE email=?");

            if(!$stmt->execute([ $new_password,$email ])) {
                echo "مشکلی پیش آمده . بعدا سعی کنید";
                } else{
                $stmt = null;
                header('Location: https://linkema.com/login.php?change_password=yes');
                }
            
    }
    break;
}
}
?>


<!DOCTYPE html>
<html lang="fa">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>فراموشی رمزعبور | لینک ما</title>
  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/css/style.css">
  
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/shabnam-font@v3.1.0/dist/font-face.css">

  <link rel="shortcut icon" href="" />
</head>

<body>
    
            <script>
        (function() {
    
    "use strict";
    
    //===== Prealoder

    window.onload = function() {
        window.setTimeout(fadeout, 500);
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }

})();
    </script>
    	<!--====== PRELOADER PART START ======-->
<style>
    /*===== All Preloader Style =====*/
.preloader {
  /* Body Overlay */
  position: fixed;
  top: 0;
  left: 0;
  display: table;
  height: 100%;
  width: 100%;
  /* Change Background Color */
  background: #fff;
  z-index: 99999;
}

.preloader .loader {
  display: table-cell;
  vertical-align: middle;
  text-align: center;
}

.preloader .loader .ytp-spinner {
  position: absolute;
  left: 50%;
  top: 50%;
  width: 64px;
  margin-left: -32px;
  z-index: 18;
  pointer-events: none;
}

.preloader .loader .ytp-spinner .ytp-spinner-container {
  pointer-events: none;
  position: absolute;
  width: 100%;
  padding-bottom: 100%;
  top: 50%;
  left: 50%;
  margin-top: -50%;
  margin-left: -50%;
  -webkit-animation: ytp-spinner-linspin 1568.2353ms linear infinite;
  animation: ytp-spinner-linspin 1568.2353ms linear infinite;
}

.preloader .loader .ytp-spinner .ytp-spinner-container .ytp-spinner-rotator {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-animation: ytp-spinner-easespin 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
  animation: ytp-spinner-easespin 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
}

.preloader .loader .ytp-spinner .ytp-spinner-container .ytp-spinner-rotator .ytp-spinner-left {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  overflow: hidden;
  right: 50%;
}

.preloader .loader .ytp-spinner .ytp-spinner-container .ytp-spinner-rotator .ytp-spinner-right {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  overflow: hidden;
  left: 50%;
}

.preloader .loader .ytp-spinner-circle {
  -webkit-box-sizing: border-box;
          box-sizing: border-box;
  position: absolute;
  width: 200%;
  height: 100%;
  border-style: solid;
  /* Spinner Color */
  border-color: #DE5088 #DE5088 #F9F9F9;
  border-radius: 50%;
  border-width: 6px;
}

.preloader .loader .ytp-spinner-left .ytp-spinner-circle {
  left: 0;
  right: -100%;
  border-right-color: #F9F9F9;
  -webkit-animation: ytp-spinner-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
  animation: ytp-spinner-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
}

.preloader .loader .ytp-spinner-right .ytp-spinner-circle {
  left: -100%;
  right: 0;
  border-left-color: #F9F9F9;
  -webkit-animation: ytp-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
  animation: ytp-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
}

/* Preloader Animations */
@-webkit-keyframes ytp-spinner-linspin {
  to {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@keyframes ytp-spinner-linspin {
  to {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@-webkit-keyframes ytp-spinner-easespin {
  12.5% {
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }
  25% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
  37.5% {
    -webkit-transform: rotate(405deg);
    transform: rotate(405deg);
  }
  50% {
    -webkit-transform: rotate(540deg);
    transform: rotate(540deg);
  }
  62.5% {
    -webkit-transform: rotate(675deg);
    transform: rotate(675deg);
  }
  75% {
    -webkit-transform: rotate(810deg);
    transform: rotate(810deg);
  }
  87.5% {
    -webkit-transform: rotate(945deg);
    transform: rotate(945deg);
  }
  to {
    -webkit-transform: rotate(1080deg);
    transform: rotate(1080deg);
  }
}

@keyframes ytp-spinner-easespin {
  12.5% {
    -webkit-transform: rotate(135deg);
    transform: rotate(135deg);
  }
  25% {
    -webkit-transform: rotate(270deg);
    transform: rotate(270deg);
  }
  37.5% {
    -webkit-transform: rotate(405deg);
    transform: rotate(405deg);
  }
  50% {
    -webkit-transform: rotate(540deg);
    transform: rotate(540deg);
  }
  62.5% {
    -webkit-transform: rotate(675deg);
    transform: rotate(675deg);
  }
  75% {
    -webkit-transform: rotate(810deg);
    transform: rotate(810deg);
  }
  87.5% {
    -webkit-transform: rotate(945deg);
    transform: rotate(945deg);
  }
  to {
    -webkit-transform: rotate(1080deg);
    transform: rotate(1080deg);
  }
}

@-webkit-keyframes ytp-spinner-left-spin {
  0% {
    -webkit-transform: rotate(130deg);
    transform: rotate(130deg);
  }
  50% {
    -webkit-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }
  to {
    -webkit-transform: rotate(130deg);
    transform: rotate(130deg);
  }
}

@keyframes ytp-spinner-left-spin {
  0% {
    -webkit-transform: rotate(130deg);
    transform: rotate(130deg);
  }
  50% {
    -webkit-transform: rotate(-5deg);
    transform: rotate(-5deg);
  }
  to {
    -webkit-transform: rotate(130deg);
    transform: rotate(130deg);
  }
}

@-webkit-keyframes ytp-right-spin {
  0% {
    -webkit-transform: rotate(-130deg);
    transform: rotate(-130deg);
  }
  50% {
    -webkit-transform: rotate(5deg);
    transform: rotate(5deg);
  }
  to {
    -webkit-transform: rotate(-130deg);
    transform: rotate(-130deg);
  }
}

@keyframes ytp-right-spin {
  0% {
    -webkit-transform: rotate(-130deg);
    transform: rotate(-130deg);
  }
  50% {
    -webkit-transform: rotate(5deg);
    transform: rotate(5deg);
  }
  to {
    -webkit-transform: rotate(-130deg);
    transform: rotate(-130deg);
  }
}

.mt-5 {
  margin-top: 5px;
}

.mt-10 {
  margin-top: 10px;
}

.mt-15 {
  margin-top: 15px;
}

.mt-20 {
  margin-top: 20px;
}

.mt-25 {
  margin-top: 25px;
}

.mt-30 {
  margin-top: 30px;
}

.mt-35 {
  margin-top: 35px;
}

.mt-40 {
  margin-top: 40px;
}

.mt-45 {
  margin-top: 45px;
}

.mt-50 {
  margin-top: 50px;
}

.mt-55 {
  margin-top: 55px;
}

.mt-60 {
  margin-top: 60px;
}

.mt-65 {
  margin-top: 65px;
}

.mt-70 {
  margin-top: 70px;
}

.mt-75 {
  margin-top: 75px;
}

.mt-80 {
  margin-top: 80px;
}

.mt-85 {
  margin-top: 85px;
}

.mt-90 {
  margin-top: 90px;
}

.mt-95 {
  margin-top: 95px;
}

.mt-100 {
  margin-top: 100px;
}

.mt-105 {
  margin-top: 105px;
}

.mt-110 {
  margin-top: 110px;
}

.mt-115 {
  margin-top: 115px;
}

.mt-120 {
  margin-top: 120px;
}

.mt-125 {
  margin-top: 125px;
}

.mt-130 {
  margin-top: 130px;
}

.mt-135 {
  margin-top: 135px;
}

.mt-140 {
  margin-top: 140px;
}

.mt-145 {
  margin-top: 145px;
}

.mt-150 {
  margin-top: 150px;
}

.mt-155 {
  margin-top: 155px;
}

.mt-160 {
  margin-top: 160px;
}

.mt-165 {
  margin-top: 165px;
}

.mt-170 {
  margin-top: 170px;
}

.mt-175 {
  margin-top: 175px;
}

.mt-180 {
  margin-top: 180px;
}

.mt-185 {
  margin-top: 185px;
}

.mt-190 {
  margin-top: 190px;
}

.mt-195 {
  margin-top: 195px;
}

.mt-200 {
  margin-top: 200px;
}

.mt-205 {
  margin-top: 205px;
}

.mt-210 {
  margin-top: 210px;
}

.mt-215 {
  margin-top: 215px;
}

.mt-220 {
  margin-top: 220px;
}

.mt-225 {
  margin-top: 225px;
}

.mb-5 {
  margin-bottom: 5px;
}

.mb-10 {
  margin-bottom: 10px;
}

.mb-15 {
  margin-bottom: 15px;
}

.mb-20 {
  margin-bottom: 20px;
}

.mb-25 {
  margin-bottom: 25px;
}

.mb-30 {
  margin-bottom: 30px;
}

.mb-35 {
  margin-bottom: 35px;
}

.mb-40 {
  margin-bottom: 40px;
}

.mb-45 {
  margin-bottom: 45px;
}

.mb-50 {
  margin-bottom: 50px;
}

.mb-55 {
  margin-bottom: 55px;
}

.mb-60 {
  margin-bottom: 60px;
}

.mb-65 {
  margin-bottom: 65px;
}

.mb-70 {
  margin-bottom: 70px;
}

.mb-75 {
  margin-bottom: 75px;
}

.mb-80 {
  margin-bottom: 80px;
}

.mb-85 {
  margin-bottom: 85px;
}

.mb-90 {
  margin-bottom: 90px;
}

.mb-95 {
  margin-bottom: 95px;
}

.mb-100 {
  margin-bottom: 100px;
}

.mb-105 {
  margin-bottom: 105px;
}

.mb-110 {
  margin-bottom: 110px;
}

.mb-115 {
  margin-bottom: 115px;
}

.mb-120 {
  margin-bottom: 120px;
}

.mb-125 {
  margin-bottom: 125px;
}

.mb-130 {
  margin-bottom: 130px;
}

.mb-135 {
  margin-bottom: 135px;
}

.mb-140 {
  margin-bottom: 140px;
}

.mb-145 {
  margin-bottom: 145px;
}

.mb-150 {
  margin-bottom: 150px;
}

.mb-155 {
  margin-bottom: 155px;
}

.mb-160 {
  margin-bottom: 160px;
}

.mb-165 {
  margin-bottom: 165px;
}

.mb-170 {
  margin-bottom: 170px;
}

.mb-175 {
  margin-bottom: 175px;
}

.mb-180 {
  margin-bottom: 180px;
}

.mb-185 {
  margin-bottom: 185px;
}

.mb-190 {
  margin-bottom: 190px;
}

.mb-195 {
  margin-bottom: 195px;
}

.mb-200 {
  margin-bottom: 200px;
}

.mb-205 {
  margin-bottom: 205px;
}

.mb-210 {
  margin-bottom: 210px;
}

.mb-215 {
  margin-bottom: 215px;
}

.mb-220 {
  margin-bottom: 220px;
}

.mb-225 {
  margin-bottom: 225px;
}

.pt-5 {
  padding-top: 5px;
}

.pt-10 {
  padding-top: 10px;
}

.pt-15 {
  padding-top: 15px;
}

.pt-20 {
  padding-top: 20px;
}

.pt-25 {
  padding-top: 25px;
}

.pt-30 {
  padding-top: 30px;
}

.pt-35 {
  padding-top: 35px;
}

.pt-40 {
  padding-top: 40px;
}

.pt-45 {
  padding-top: 45px;
}

.pt-50 {
  padding-top: 50px;
}

.pt-55 {
  padding-top: 55px;
}

.pt-60 {
  padding-top: 60px;
}

.pt-65 {
  padding-top: 65px;
}

.pt-70 {
  padding-top: 70px;
}

.pt-75 {
  padding-top: 75px;
}

.pt-80 {
  padding-top: 80px;
}

.pt-85 {
  padding-top: 85px;
}

.pt-90 {
  padding-top: 90px;
}

.pt-95 {
  padding-top: 95px;
}

.pt-100 {
  padding-top: 100px;
}

.pt-105 {
  padding-top: 105px;
}

.pt-110 {
  padding-top: 110px;
}

.pt-115 {
  padding-top: 115px;
}

.pt-120 {
  padding-top: 120px;
}

.pt-125 {
  padding-top: 125px;
}

.pt-130 {
  padding-top: 130px;
}

.pt-135 {
  padding-top: 135px;
}

.pt-140 {
  padding-top: 140px;
}

.pt-145 {
  padding-top: 145px;
}

.pt-150 {
  padding-top: 150px;
}

.pt-155 {
  padding-top: 155px;
}

.pt-160 {
  padding-top: 160px;
}

.pt-165 {
  padding-top: 165px;
}

.pt-170 {
  padding-top: 170px;
}

.pt-175 {
  padding-top: 175px;
}

.pt-180 {
  padding-top: 180px;
}

.pt-185 {
  padding-top: 185px;
}

.pt-190 {
  padding-top: 190px;
}

.pt-195 {
  padding-top: 195px;
}

.pt-200 {
  padding-top: 200px;
}

.pt-205 {
  padding-top: 205px;
}

.pt-210 {
  padding-top: 210px;
}

.pt-215 {
  padding-top: 215px;
}

.pt-220 {
  padding-top: 220px;
}

.pt-225 {
  padding-top: 225px;
}

.pb-5 {
  padding-bottom: 5px;
}

.pb-10 {
  padding-bottom: 10px;
}

.pb-15 {
  padding-bottom: 15px;
}

.pb-20 {
  padding-bottom: 20px;
}

.pb-25 {
  padding-bottom: 25px;
}

.pb-30 {
  padding-bottom: 30px;
}

.pb-35 {
  padding-bottom: 35px;
}

.pb-40 {
  padding-bottom: 40px;
}

.pb-45 {
  padding-bottom: 45px;
}

.pb-50 {
  padding-bottom: 50px;
}

.pb-55 {
  padding-bottom: 55px;
}

.pb-60 {
  padding-bottom: 60px;
}

.pb-65 {
  padding-bottom: 65px;
}

.pb-70 {
  padding-bottom: 70px;
}

.pb-75 {
  padding-bottom: 75px;
}

.pb-80 {
  padding-bottom: 80px;
}

.pb-85 {
  padding-bottom: 85px;
}

.pb-90 {
  padding-bottom: 90px;
}

.pb-95 {
  padding-bottom: 95px;
}

.pb-100 {
  padding-bottom: 100px;
}

.pb-105 {
  padding-bottom: 105px;
}

.pb-110 {
  padding-bottom: 110px;
}

.pb-115 {
  padding-bottom: 115px;
}

.pb-120 {
  padding-bottom: 120px;
}

.pb-125 {
  padding-bottom: 125px;
}

.pb-130 {
  padding-bottom: 130px;
}

.pb-135 {
  padding-bottom: 135px;
}

.pb-140 {
  padding-bottom: 140px;
}

.pb-145 {
  padding-bottom: 145px;
}

.pb-150 {
  padding-bottom: 150px;
}

.pb-155 {
  padding-bottom: 155px;
}

.pb-160 {
  padding-bottom: 160px;
}

.pb-165 {
  padding-bottom: 165px;
}

.pb-170 {
  padding-bottom: 170px;
}

.pb-175 {
  padding-bottom: 175px;
}

.pb-180 {
  padding-bottom: 180px;
}

.pb-185 {
  padding-bottom: 185px;
}

.pb-190 {
  padding-bottom: 190px;
}

.pb-195 {
  padding-bottom: 195px;
}

.pb-200 {
  padding-bottom: 200px;
}

.pb-205 {
  padding-bottom: 205px;
}

.pb-210 {
  padding-bottom: 210px;
}

.pb-215 {
  padding-bottom: 215px;
}

.pb-220 {
  padding-bottom: 220px;
}

.pb-225 {
  padding-bottom: 225px;
}
</style>
	<div class="preloader">
		<div class="loader">
			<div class="ytp-spinner">
				<div class="ytp-spinner-container">
					<div class="ytp-spinner-rotator">
						<div class="ytp-spinner-left">
							<div class="ytp-spinner-circle"></div>
						</div>
						<div class="ytp-spinner-right">
							<div class="ytp-spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--====== PRELOADER PART ENDS ======-->
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-right p-5">
                <?php
                switch ($_GET["action"]) {
                    case "enter_code": ?>
                        <h3 class="text-info text-center">رمزعبورتان را فراموش کرده اید؟</h3>
                        <h3>ورود کد اعتبارسنجی</h3>
                        <form action="reset_password.php?action=step2" method="post">
                        
                        <div class="form-group">
                            <label>کد اعتبارسنجی</label>
                            <input type="text" name="code" id="code" placeholder="کد اعتبارسنجی ای که به ایمیل تان ارسال شده را وارد کنید" class="form-control">
                            <span class="badge badge-gradient-danger" id="code_error_message"></span>
                        </div>

                        <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="بررسی">
                        </form>
                                            <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
                    

  	<script type="text/javascript">
      $(function() {
         $('input[type="submit"]').attr('disabled', true);
         $("#code_error_message").hide();
         var error_code = false;

         $("#code").bind('blur keyup focusout mouseleave', function() {
            check_code();
            check_validation();
         });
         

        function check_code() {
            var code_length = $("#code").val().length;
            if (code_length != 5) {
               $("#code_error_message").html("کد اعتبارسنجی واردشده اشتباه است");
               $("#code_error_message").show();
               $("#code").css("border-bottom","2px solid #F90A0A");
               error_code = true;
            } else {
               $("#code_error_message").hide();
               $("#code").css("border-bottom","2px solid #34F458");
               error_code = false
            }
         }

        function check_validation() {
        if (error_code === false) {
                $('input[type="submit"]').attr('disabled', false);
            } else {
               $('input[type="submit"]').attr('disabled', true);
            }
        }
         
      });
   </script>
                    <?php
                    break;
                    case "change_password": ?>
                    <h2 class="text-info text-center">ورود رمزعبور جدید</h2>
                    <form action="reset_password.php?action=step3" method="post">
                        
                        <div class="form-group">
                            <label>رمزعبور جدید</label>
                            <input type="password" name="new_password" id="new_password" placeholder="رمزعبور جدیدتان را وارد کنید" class="form-control">
                            <span class="badge badge-gradient-danger" id="new_password_error_message"></span>
                        </div>
                        <div class="form-group">
                            <label>تکرار رمزعبور جدید</label>
                            <input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="رمزعبور جدیدتان را یکبار دیگر وارد کنید" class="form-control">
                            <span class="badge badge-gradient-danger" id="confirm_new_password_error_message"></span>
                        </div>

                        <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="تغییر رمزعبور">
                    </form>
                    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
                    

  	<script type="text/javascript">
      $(function() {
         $('input[type="submit"]').attr('disabled', true);
         $("#new_password_error_message").hide();
         $("#confirm_new_password_error_message").hide();
         var error_new_password = false;
         var error_confirm_new_password = false;

         $("#new_password").bind('blur keyup focusout mouseleave', function() {
            check_new_password();
            check_validation();
         });
         
         $("#confirm_new_password").bind('blur keyup focusout mouseleave', function() {
            check_confirm_new_password();
            check_validation();
         });

        function check_new_password() {
            var new_password_length = $("#new_password").val().length;
            if (new_password_length < 6) {
               $("#new_password_error_message").html("رمزعبور باید حداقل هشت کاراکتر باشد");
               $("#new_password_error_message").show();
               $("#new_password").css("border-bottom","2px solid #F90A0A");
               error_new_password = true;
            } else {
               $("#new_password_error_message").hide();
               $("#new_password").css("border-bottom","2px solid #34F458");
               error_new_password = false
            }
         }
         
        function check_confirm_new_password() {
            var new_password = $("#new_password").val();
            var confirm_new_password = $("#confirm_new_password").val();
            if (new_password !== confirm_new_password) {
               $("#confirm_new_password_error_message").html("رمزعبور جدید و تکرار آن باید یکسان انتخاب شوند");
               $("#confirm_new_password_error_message").show();
               $("#confirm_new_password").css("border-bottom","2px solid #F90A0A");
               error_confirm_new_password = true;
            } else {
               $("#confirm_new_password_error_message").hide();
               $("#confirm_new_password").css("border-bottom","2px solid #34F458");
               error_confirm_new_password = false;
            }
         }

        function check_validation() {
        if (error_new_password === false && error_confirm_new_password === false) {
                $('input[type="submit"]').attr('disabled', false);
            } else {
               $('input[type="submit"]').attr('disabled', true);
            }
        }
         
      });
   </script>
                    <?php
                    break;
                    default: ?>
                        <h3 class="text-info text-center">رمزعبورتان را فراموش کرده اید؟</h3>
                        <form action="https://linkema.com/reset_password.php?action=step1" method="post">
                        
                            <div class="form-group">
                                <label>ایمیل</label>
                                 <input type="text" name="email" id="email" placeholder="آدرس ایمیل تان را وارد کنید" class="form-control">
                                 <span class="badge badge-gradient-danger" id="email_error_message"></span>
                                <input type="hidden" name="reset_password" value="true"></div>
                            <input type="submit" id="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="بررسی">
                        </form>
                        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  	<script type="text/javascript">
      $(function() {
         $('input[type="submit"]').attr('disabled', true);
         $("#email_error_message").hide();
         var error_email = false;

         $("#email").bind('blur keyup focusout mouseleave', function() {
            check_email();
            check_validation();
         });

         function check_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#email").val();
            if (pattern.test(email) && email !== '') {
               $("#email_error_message").hide();
               $("#email").css("border-bottom","2px solid #34F458");
               error_email = false;
            } else {
               $("#email_error_message").html("نشانی ایمیل نامعتبر است");
               $("#email_error_message").show();
               $("#email").css("border-bottom","2px solid #F90A0A");
               error_email = true;
            }
         }

        function check_validation() {
        if (error_email === false) {
                $('input[type="submit"]').attr('disabled', false);
            } else {
               $('input[type="submit"]').attr('disabled', true);
            }
        }
         
      });
   </script>
<?php
}

if (isset($error_message) && $error_message != '')
{
    echo $error_message;
}
?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  
</body>
</html>