<?php
ob_start();
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true)
{
    header("location: https://linkema.com/login.php");
}


if(isset($_SESSION["id"]) && !empty($_SESSION["id"])){

    require_once "config.php";
    $sql = "SELECT * FROM user WHERE user_id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        $param_id = trim($_SESSION["id"]);

		if (is_int($param_id)) $__vartype = "i";
		elseif (is_string($param_id)) $__vartype = "s";
		elseif (is_numeric($param_id)) $__vartype = "d";
		else $__vartype = "b";
        mysqli_stmt_bind_param($stmt, $__vartype, $param_id);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            } else{

                header("location: error.php");
                exit();
            }

        } else{
            echo "مشکلی پیش آمده بعدا امتحان کنید";
        }
    }

    mysqli_stmt_close($stmt);

}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>داشبورد</title>

  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/css/style.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/shabnam-font@v3.1.0/dist/font-face.css">

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
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="dashboard.php">لینک ما</a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php">لینک ما</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
                <img src="<?php echo $row["user_img"]; $_SESSION["user_img"] = $row["user_img"]; ?>">
                <span class="availability-status online"></span>             
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo $row["first_name"].' '.$row["last_name"]; $_SESSION["first_name"] = $row["first_name"]; $_SESSION["last_name"] = $row["last_name"];?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="user-update.php">
                <i class="mdi mdi-cached mr-2 text-success"></i>
                 ویرایش اطلاعات
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                خروج
              </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>
          <li class="nav-item nav-logout d-none d-lg-block">
            <a class="nav-link" href="logout.php">
              <i class="mdi mdi-power"></i>
            </a>
          </li>
          <li><a href="create_profile.php" class="btn btn-primary">ایجاد صفحه جدید <i class="mdi mdi-account-card-details"></i></a></li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
<?php
function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("ثانیه", "دقیقه", "ساعت", "روز", "ماه", "سال");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . " پیش ";
	   }
	}
?>
                    <?php
                    $sql = "SELECT * FROM profile WHERE user_id =" .$_SESSION["id"];


                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
        
                                while($row = mysqli_fetch_array($result)){
                                    echo "<div class='col-md-4 stretch-card grid-margin'>";
                                    echo "<div class='card bg-gradient-danger card-img-holder text-white'>";
                                    echo "<div class='card-body text-right'>";
                                    echo "<img src='' class='card-img-absolute'>";
                                        echo "<h4 class='font-weight-normal mb-3'>" . $row['title'] . "</h4>";
                                        echo "<h5 class='mb-5'>" . $row['subtitle'] . "</h5>";
                                        echo "<label class='badge badge-gradient-success'>ایجاد شده در ".timeago( $row['created_at'] ). "</label><br>";
                                            echo "<a class='badge badge-gradient-warning text-dark' href='creator.php?profile_id=". $row['profile_id'] ."'>صفحه ساز</a> | ";
                                            echo "<a class='text-dark badge badge-gradient-warning' href='https://linkema.com/@!/". $row['url'] ."' target='_blank'>دیدن صفحه</a> | ";
                                            echo "<a class='text-dark badge badge-gradient-warning' href='stats.php?profile_id=". $row['profile_id'] ."'>آمار بازدید صفحه</a> | ";
                                            echo "<a class='text-dark badge badge-gradient-warning' href='update.php?profile_id=". $row['profile_id'] ."'>ویرایش</a> | ";
                                            echo "<a class='text-dark badge badge-gradient-warning' href='delete_profile.php?profile_id=". $row['profile_id'] ."'>حذف</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }

                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>هنوز صفحه ای نساخته اید</em></p>";
                        }
                    } else{
                        echo $sql. mysqli_error($link);
                    }

                    mysqli_close($link);
                    ?>
                    </div>

</div>

</div>
<footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">کلیه حقوق برای <a href="https://www.linkema.com/" target="_blank">لینک ما</a> محفوظ می باشد</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">ساخته شده با<i class="mdi mdi-heart text-danger"></i>توسط گروه متخصصین ماورانت</span>
          </div>
</footer>
  <script src="https://linkema.com/97/mavaranet/vendors/js/vendor.bundle.base.js"></script>
  <script src="https://linkema.com/97/mavaranet/vendors/js/vendor.bundle.addons.js"></script>

  <script src="https://linkema.com/97/mavaranet/js/off-canvas.js"></script>
  <script src="https://linkema.com/97/mavaranet/js/misc.js"></script>

</body>
</html>