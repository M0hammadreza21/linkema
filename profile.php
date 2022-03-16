<?php
ob_start();
session_start();

$_GET["url"] = trim($_GET["url"]);
if(isset($_GET["url"]) && !empty($_GET["url"])){

    require_once "config.php";

    $sql = "SELECT * FROM profile WHERE url = ?";

    if($stmt = mysqli_prepare($link, $sql)){

        $param_id = trim($_GET["url"]);

		if (is_int($param_id)) $__vartype = "i";
		elseif (is_string($param_id)) $__vartype = "s";
		elseif (is_numeric($param_id)) $__vartype = "d";
		else $__vartype = "b"; // blob
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
            echo "مشکلی بوجود آمده. بعدا مراجعه کنید";
        }
    }



} else{

    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fa">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $row["title"]; ?> | لینک ما</title>

  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/vendors/css/vendor.bundle.base.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>
  <link rel="stylesheet" href="https://linkema.com/97/mavaranet/css/style.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/rastikerdar/shabnam-font@v3.1.0/dist/font-face.css">


<style>#map { top: 0; bottom: 0; width: 100%; height: 300px;}</style>
  <link rel="shortcut icon" href="" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-md-4 grid-margin mx-auto stretch-card">
                        <div class="card">
                            <div class="card-body text-right">

                                <img src="https://linkema.com/uploads/<?php echo $row["profile_img"]; ?>" class="rounded mx-auto d-block">

                        <div class="form-group text-center">
                            <h2><?php echo $row["title"]; ?><?php if($row["is_verified"]===1){ echo "<i class='mdi mdi-verified'></i>"; } ?></h2>
                            <p class="form-control-static"><?php echo $row["subtitle"]; ?></p>
                        </div>

                  

                    <?php
                    
                    $profile_id = $row["profile_id"];
                    $sql = "SELECT * FROM links WHERE pid = $profile_id ORDER BY position_order";


                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){


                            echo "<div class='template-demo'>";
                            echo "<h4 class='card-title text-right'>لینک ها<i class='mdi mdi-link-variant'></i></h4>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<div style='margin-bottom: 10px;'>";
                                    echo "<a href='" . $row['url'] . "' rel='noopener noreferrer nofollow' 
   target='_blank'><button type='button' style='margin-bottom: 10px;' class='btn btn-outline-info btn-fw'>". $row['title'] ." <i class='mdi'></i></button></a>";
                                    echo "<div>";
                                }
                                echo "</div>";

                            mysqli_free_result($result);
                        } else{
                            echo "<div style='margin-bottom: 10px;'>";
                            //echo "<label class='badge badge-gradient-warning'>پس از ثبت لینک هایتان، اطلاعات شما جایگزین خواهد شد </label>";
                            echo "<div>";
                        }
                    } else{
                        echo $sql . mysqli_error($link);
                    }

                    ?>
                </div>



                    <?php
                    $sql = "SELECT * FROM messengers WHERE pid = $profile_id ORDER BY position_order";


                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){

                            echo "<div class='template-demo'>";
                            echo "<h4 class='card-title text-right'>شبکه های اجتماعی<i class='mdi mdi-account-circle'\></i></h4>";

                                while($row = mysqli_fetch_array($result)){
                                    switch ($row['type']) {
                                    case "whatsapp":
                                        $mdi = "whatsapp";
                                        $pre_url = "https://api.whatsapp.com/send?phone=";
                                        break;
                                    case "instagram":
                                        $mdi = "instagram";
                                        $pre_url = "https://instagram.com/";
                                        break;
                                    case "telegram":
                                        $mdi = "telegram";
                                        $pre_url = "http://telegram.org/";
                                        break;
                                }
                                    echo "<div style='margin-bottom: 10px'>";
                                    echo "<a target='_blank' style='padding: 10px 0 10px 0;' href='" . $pre_url . $row['url'] . "'><button type='button' class='btn btn-social-icon-text btn-" . $mdi . "'>". $row['title'] ." <i class='mdi mdi-" . $mdi . "'></i></button></a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<div style='margin-bottom: 10px'>";
                            //echo "<label class='badge badge-gradient-warning'>پس از ثبت لینک شبکه های اجتماعی تان ، اطلاعات شما جایگزین خواهد شد </label>";
                            echo "</div>";
                        }
                    } else{
                        echo $sql . mysqli_error($link);
                    }


                    ?>

                  
                    <?php
                    $sql = "SELECT * FROM contacts WHERE pid = $profile_id ORDER BY position_order";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                        echo "<div class='template-demo'>";
                        echo "<h4 class='card-title text-right'>اطلاعات تماس <i class='mdi mdi-contact-mail'></i></h4>";
                        while($row = mysqli_fetch_array($result)){
                            
                            switch ($row['type']) {
                                    case "tel":
                                        $mdi_c = "mdi mdi-phone";
                                        $pre_url = "tel:";
                                        break;
                                    case "mobile":
                                        $mdi_c = "mdi mdi-cellphone-android";
                                        $pre_url = "tel:";
                                        break;
                                    case "email":
                                        $mdi_c = "mdi mdi-email-open";
                                        $pre_url = "mailto:";
                                        break;
                                    case "website":
                                        $mdi_c = "mdi mdi-web";
                                        $pre_url = "http://";
                                        break;
                                }
                                

                                    echo "<div style='margin-bottom: 10px'>";
                                    echo "<a target='_blank' style='padding: 10px 0 10px 0;' href='" . $pre_url . $row['value'] . "'><button type='button' class='btn btn-social-icon-text btn-" . $mdi_c . "'>". $row['title'] ." <i class='mdi mdi-" . $mdi_c . "'></i></button></a>";
                                    echo "</div>";
                                }
                                echo "</div>";
                            
                            mysqli_free_result($result);
                        } else{
                            echo "<div style='margin-bottom: 10px'>";
                            //echo "<label class='badge badge-gradient-warning'>پس از ثبت مسیرهایتان، اطلاعات شما جایگزین خواهد شد </label>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else{
                        echo $sql . mysqli_error($link);
                    }


                    ?>

                  
                    <?php
// set IP address and API access key 
$ip = $_SERVER['REMOTE_ADDR'];
$access_key = '7f3fc7e8445492a20c5a898186a8c768';

// Initialize CURL:
$ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$api_result = json_decode($json, true);


                    $sql = "SELECT * FROM routing WHERE pid = $profile_id ORDER BY position_order";


                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                        echo "<div class='template-demo'>";
                        echo "<h4 class='card-title text-right'>مسیرها<i class='mdi mdi-routes'></i></h4>";
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
										echo "<th class='text-info'>عنوان</th>";
										
                                        echo "<th class='text-info'>مسیریابی آدرس</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody class='row_position_link'>";

                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>";
                                            echo "<a target='_blank' style='padding: 10px 0 10px 0;' href=https://www.google.com/maps/dir/" .$api_result['latitude'] . "," .$api_result['longitude'] . "/" .$row['Latitude'] . "," .$row['Longitude'] . "><img src='https://linkema.com/97/gmap.webp' width='20' height='20'></a>";
                                            echo "<a style='padding: 10px 0 10px 0;' href='waze://?ll=" .$row['Latitude'] . "," .$row['Longitude'] . "'><img src='https://linkema.com/97/ways.webp' width='20' height='20'></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</tbody>";
                            echo "</table>";
                            mysqli_free_result($result);
                        } else{
                            //echo "<label class='badge badge-gradient-warning'>پس از ثبت مسیرهایتان، اطلاعات شما جایگزین خواهد شد </label>";
                            echo "</tbody>";
                            echo "</table>";
                        }
                    } else{
                        echo  $sql . mysqli_error($link);
                    }

        //This Script is from www.phpfreecpde.com, Coded by: Kerixa Inc


	    $u_agent = $_SERVER['HTTP_USER_AGENT'];
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";
	 
	    //First get the platform?
	    if (preg_match('/linux/i', $u_agent)) {
	        $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
	        $platform = 'windows';
	    }
	 
	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
	    {
	        $bname = 'Internet Explorer';
	        $ub = "MSIE";
	    }
	    elseif(preg_match('/Firefox/i',$u_agent))
	    {
	        $bname = 'Mozilla Firefox';
	        $ub = "Firefox";	        
	    }
	    elseif(preg_match('/Chrome/i',$u_agent))
	    {
	        $bname = 'Google Chrome';
	        $ub = "Chrome";
	    }
	    elseif(preg_match('/Safari/i',$u_agent))
	    {
	        $bname = 'Apple Safari';
	        $ub = "Safari";
	    }
	    elseif(preg_match('/Opera/i',$u_agent))
	    {
	        $bname = 'Opera';
	        $ub = "Opera";
	    }
	    elseif(preg_match('/Netscape/i',$u_agent))
	    {
	        $bname = 'Netscape';
	        $ub = "Netscape";
	    }
	 
	    // finally get the correct version number
	    $pos=strpos($u_agent,$ub);
	    $m=$pos+strlen($ub)+1;
	    if ($ub=='MSIE')
	    	$l=strpos($u_agent,';',$m)-$m;
	    else
		    $l=strpos($u_agent,' ',$m)-$m;
		if ($l<=0) $l=10;
		$version=substr($u_agent,$m,$l);


		$visitor_ip = $_SERVER ['REMOTE_ADDR'];
		$visitor_os = $platform;
		$visitor_browser = $bname.' '.$version;
		$visit_datetime = date_default_timezone_get();
		$referer = $_SERVER["HTTP_REFERER"];
		
if($_SERVER["REQUEST_METHOD"] != "POST"){

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
        $stmt = $pdo->prepare("INSERT INTO stats (profile_id,user_agent,referer,visitor_ip,visitor_os,visitor_browser) VALUES (?,?,?,?,?,?)"); 
        
        if($stmt->execute([ $profile_id,$u_agent,$referer,$visitor_ip,$visitor_os,$visitor_browser  ])) {
                $stmt = null;
                //header("location: https://linkema.com/dashboard.php");
            } else{
                echo "مشکلی پیش آمده";
            }

	}
	mysqli_close($link);
                    ?>
<hr><img class="rounded mx-auto d-block" style="background:#000000;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALIAAAA7CAYAAAGoMuDuAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA2tpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ4IDc5LjE2NDAzNiwgMjAxOS8wOC8xMy0wMTowNjo1NyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDpkNjMzZjZmYi0wNjkyLTc0NDYtYTUyZC02YjVjYTk5YjMxOTUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MjZGNTA5NUE5NEVDMTFFQThBQTVCN0M1QkIyNzNBODQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MjZGNTA5NTk5NEVDMTFFQThBQTVCN0M1QkIyNzNBODQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIDIxLjAgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RjA2QTFGMDA5NDFBMTFFQUIyOTVCNjc4MkM3QjM2NjMiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RjA2QTFGMDE5NDFBMTFFQUIyOTVCNjc4MkM3QjM2NjMiLz4gPC9yZGY6RGVz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" alt="copyright" title="copyright" class="lazyloaded" data-ll-status="loaded">
                        </div>                    
                    </div>
                    
                </div>
                
            </div>
        </div>
        
    </div>
    

  <script src="https://linkema.com/97/mavaranet/vendors/js/vendor.bundle.base.js"></script>
  <script src="https://linkema.com/97/mavaranet/vendors/js/vendor.bundle.addons.js"></script>
  <script src="https://linkema.com/97/mavaranet/js/off-canvas.js"></script>
  <script src="https://linkema.com/97/mavaranet/js/misc.js"></script>

</body>
</html>