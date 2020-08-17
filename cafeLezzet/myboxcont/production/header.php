<?php 
include '../../lib/Session.php'; // include our Session.php page 
Session::checkSession(); // Added checkSession Method

 header("Cache-Control: no-cache, must-revalidate");
 header("Pragma:no-cache");
 header("Expires:Sat, 26 Jul 1997 05:00:00 GMT");
 header("Cache-Control:max-age=2592000");
 date_default_timezone_set('Europe/Istanbul');

  define('CSSPATH', 'css/'); //define css path
  $cssItem = 'style.css'; //css item to display

?>
 <?php
    
    
    
    function ip_visitor_country()
    {

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $country  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

    if($ip_data && $ip_data['geoplugin_countryName'] != null) {
        $country = $ip_data['geoplugin_countryName'];
    }

    return 'IP: '.$ip.' # Country: '.$country;
    }

    $visit=ip_visitor_country()." \nend\n*************************************************\n\n\n"; // output Coutry name
    
    
     function getRealIpAddr()
    {
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
    }
    
    
    $ip = @$_SERVER['REMOTE_ADDR'];
    $proxyAdress = "\nProxy Adres = ".@$_SERVER['HTTP_X_FORWARDED_FOR']; 
    $url= "\nurl adresi = ".@$_SERVER['HTTP_REFERER']; 
    $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
    $ip_ulke= "\nIP ülke = ".$xml->geoplugin_countryName;
    $ayrinti="";
    foreach ($xml as $key => $value)
    {
       $ayrinti .=  $key . "= " . $value .  " \n" ;
    }
    $yeniAyrinti= "\nAyrıntılı Bilgiler = ".$ayrinti."\n";
    $linki = "linki = ".@$_SERVER['REQUEST_URI'];
    $webpage ="\nWeb Sayfası = ".$_SERVER['SCRIPT_NAME'];
    $complete_path = $_SERVER['SCRIPT_FILENAME'];
    $hostname = @$_SERVER['HTTP_HOST']."\n";
    //$hostname1 = "\nBu host mu? ".@$_SERVER['host']."\n";
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $veri = date ("d-m-Y / H:i:s");
    $invoegen = $veri." - \nip numarası= ".$ip."\nHostname= ".$hostname."\ncomplete_path = ".$complete_path."\n";
    $fopen = fopen("iplogin.php","a");
    fwrite ($fopen,$invoegen);
    fwrite ($fopen,$linki);
    fwrite ($fopen,$webpage);
    //fwrite ($fopen,$hostname1);
    fwrite ($fopen,$proxyAdress);
    fwrite ($fopen,$url);
    fwrite ($fopen,$ip_ulke);
    fwrite ($fopen,$yeniAyrinti);
    fwrite ($fopen,$visit);
    
    
    fclose($fopen); 

?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Anka Yazılım CMS | Yönetim Panel </title>

  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <link href="<?php echo (CSSPATH . "$cssItem"); ?>" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-gears"></i> <span>Anka Yazılım CMS</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo Session::get('image');?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin</span>
              <h2><?php echo Session::get('adminName');?></h2>
             


               
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <?php include 'sidebar.php'; ?>

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
                <?php
              if (isset($_GET['action']) && $_GET['action'] == "logout"){ // Here i get this logout id 
                 Session::set("adminlogin", false);
                 Session::destroy(); 
                 Session::set('adminName')=="";
                 
                 // Here i destroy this Session for login user.
             }
             else
             {
              ?>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo Session::get('image');?>" alt=""><?php echo Session::get('adminName');?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="user.php"> Admin Güncelle</a></li>                  

                  <li><a href="?action=logout"><i class="fa fa-sign-out pull-right"></i> Logout</a></li>
                </ul>
              <?php } ?>
              </li>

              <!--<li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li> -->
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->