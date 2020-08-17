<?php
include_once('lib/Session.php'); 
Session::init();
include_once('lib/Database.php');
include_once('helpers/Format.php');
include_once('classes/Maillerform.php');


date_default_timezone_set('Europe/Istanbul');
/*
spl_autoload_register('myAutoloader');
function myAutoloader($className)
{

 include_once '/classes/'.$className.'.php';

}
*/
spl_autoload_register(function($class){
   include_once "classes/".$class.".php";
  });
 
  $db       = new Database();   // Create Database Class Object 
  $fm       = new Format();  // Create Format Class Object 
  $product  = new Product(); // Create Product Class Object 
  $brand    = new Brand(); // Create Cart Class Object 
  $cat      = new Category();
  $base     = new Baseproduct();
  $page     = new Pages();
  $pagi     = new Pagina(5);
  $phpmail  = new Maillerform();


define('CSSPATHMAIN', 'bootstrap-4.0/'); //define css path
  $cssItemMain = 'mystyle.css'; //css item to display
 
                      
$getSite = $brand->getSiteInfo();
if ($getSite) {
 while ($value = $getSite->fetch_assoc()) { 
 ?> 
<!DOCTYPE html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=yes">
    <meta name="keywords" content="<?php echo $fm->validation($value['siteKeys']);?>"/>
    <meta name="description" content="<?php echo $fm->validation($value['siteDescr']);?>">
    <meta name="author" content="<?php echo $fm->validation($value['siteauthor'])." & ".$fm->validation($value['copyright']);?>">
    <title><?php echo $fm->validation($value['siteName']);?></title>
    
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0/css/bootstrap.css">
    <script type="text/javascript" href="bootstrap-4.0/js/bootstrap.min.js"></script>
   
    <link rel="stylesheet" type="text/css" href="<?php echo (CSSPATHMAIN . "$cssItemMain"); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css?family=Kristi" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Judson" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> <![endif]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body class="full-screen-preview" >


   <!--<div class="yenidiv col-lg-12 col-md-12">
        <div class="firinci_var_header">-->
          
          <?php

          $activePage = basename($_SERVER['PHP_SELF'], ".php");
          
          echo '<nav class="navbar navbar-expand-lg navbar-dark firinci_menu_kont" id="nav">
          <div class="container-fluid">
          <div class="hizalama">
            <h1 class="lezzetLogoH1">
              <a class="lezzetLogo_a" href="index.php">
        <img class="lezzetLogo rounded" src="'.$fm->validation($fm->fotoAdDegistir("../","",$value['LogoMd'])).'" rel="logo" Width="70" Height="60" alt="Lezzzet Cafe"/></a></h1>';
      }
    }


      echo  '<form action="search.php" method="POST">
        <div class="searchDiv bg">
          <input type="text" name="search" class="search" placeholder="Ürün Ara..."/>
          <button type="submit"><i class="fa fa-search"></i></button>
        </div>
        </form>
        </div>
          
           <button class="navbar-toggler yeni_button" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse yeni_collaps" id="navbarNav">
                      <ul class="navbar-nav firinci_menu">';
            
                     $takenMenu = $brand->getAllMenu(); // Create method in Product Class 
                     if ($takenMenu) {
                      $i = 0;
                    while ($result = $takenMenu->fetch_assoc() ) {
                      $i++;
                     if($result['menuDurum']==1){
                      if($i==1)
                      {
                        $text = $result['menuUrl'];
                        $menuNew = explode(".", $text);
                        echo'<li class="nav-item"><a href="'.$result['menuUrl'].'" class="nav-link ';
                         if ($activePage=="") {
                          echo "active"; 
                        } elseif($activePage==$menuNew[0]) {
                          echo "active"; } else  {echo "noactive";}
                          echo '" style="color:#dce4e8;">'.$fm->validation($result['menuName']).'</a></li>';
                      }
                      elseif($i==3)
                      {
                        $text = $result['menuUrl'];
                        $menuNew = explode(".", $text);
                        echo'<li class="nav-item"><a href="'.$result['menuUrl'].'" class="nav-link ';
                       if($activePage==$menuNew[0] || $activePage=="urun") {
                          echo "active"; } else  {echo "noactive";}
                          echo '" style="color:#dce4e8;">'.$fm->validation($result['menuName']).'</a></li>';
                      }
                      elseif($i==7)
                        continue;
                      else
                      {

                        $text = $result['menuUrl'];
                        $menuNew = explode(".", $text);
                        echo'<li class="nav-item"><a href="'.$result['menuUrl'].'" class="nav-link ';
                       if($activePage==$menuNew[0]) {
                          echo "active"; } else  {echo "noactive";}
                          echo '" style="color:#dce4e8;">'.$result['menuName'].'</a></li>';
                      }
                    } 
                    else 
                      echo "";
                  }
                }


            echo '</ul>
                </div>
              </div>
            </div>
          </nav>';
          ?>
       
   


  </div> 
</div> 
  <div class="clearfix"></div>

