<?php

//güvenlik için
//header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);

include "header.php";

?>

 <?php
if (!isset($_POST['search'])  || $_POST['search'] == NULL ) {
     echo "<script>window.location = 'index.php';  </script>";
     exit();
  }else {
  
if($fm->textKontrolEt($fm->sqlonlemeforSerch($fm->validation($_POST['search'])))){
   $search =$fm->sqlonlemeforSerch($fm->validation($_POST['search']));
 }
 else
 {
  echo "<script>window.location = '404.php';  </script>";
}
  }

$page     = new Pages();
$getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Search",$id=10);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) {

?>
<section>
<div class="parallaxUrun img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>');">
<?php
}
}
?>
</div>
<style type="text/css">
.button button{
border:none; 
list-style-type:none;
background-color:white;
outline:none;
color:#f79a59;
opacity: .9;
font-weight: 600;
font-size: 18px;
}
.button button:hover
{
opacity: .6;
} 
.searchClass h2
{
  color:#333;
  opacity: .7;
  font-size: 28px;
}
</style>
   <div class="clearfix"></div>
   <div class="urunAilesi">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="ustParag searchClass">
            <h2>ARAMA SONUÇLARI</h2>
 <?php

 
  
 $pagi = new Pagina(30);

 $islem = $pagi->productInnerSatirSayiBul($search);
   
     if ($islem<=0) {   
     
?>

         <div class="col-md-12">
            <p style="color: black"><b><?php echo $search; ?></b> bulunmadı!</p>
          </div>

<?php
          } 
          else
          {
                    $a="tbl_product";
                    $b="productId";
                    
                    $pagi = new Pagina(30);
   

                  $takenSearch = $pagi->SearchMainPagination($a,$b,$search); 
                     if ($takenSearch) {
                     
                    while ($result = $takenSearch->fetch_assoc() ) {
                     
                   ?>


            <div class="row urunSinir">
                    <div class="col-lg-4 boyutImg1">
                      <div class="urunImg queryImg">
                       <p>
                        <a href="urun.php?proid=<?php echo $result['productId']; ?>" >
                         <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image'])); ?>" class="img-responsive" width="220" height="280"></a>
                       </p>
                       
                      </div>
                    </div>
                    <div  class="col-lg-8 boyutParag1">
                      <div class="urunParag">
                       <h3 class="urunFirst"><span><?php echo $fm->validation($result['catName']); ?></span></h3>
                        <h2 class="urunSecond"><?php echo $fm->validation($result['productName']); ?></h2>
                        <div class="separator_flower">✻</div>

                          <p><?php echo $fm->textShortenDat($result['body'], 120); ?></p>
                          <p><?php echo $result['price']; ?> ₺</p>
                         <form method="POST" action="urun.php"><div class="button">
                          <input type="hidden" name="searchUrun" value="<?php echo $fm->validation($result['productId']); ?>" /> 
                          <button type="submit" name="searchPost">Ayrıntılar...</button>
                         </div>
                        </form>
                      </div>
                      </div>
                      
                    </div><?php
                      }
                      }
                      ?>
                      <div class="clearfix"></div>
                      <div class="col-lg-6 offset-lg-3 classRemove">
                        <div class="urunCategory">
                         <ul>
                      <?php                            
                          

                             $takenKat = $cat->catBySearch($search);  
                              if ($takenKat){
                                while ($value = $takenKat->fetch_assoc()) { 
                                  echo '<li><form action="kategori.php" method="POST">
                                <input type="hidden" name="islemSearch" value="'; echo $fm->validation($value['catId']);
                                echo '">
                               <button type="submit" style = "font-size:20px !important" name="gonder1" class="urunlerCategory">'.$fm->validation($value['catName']).' Kategorisi İçin / Lütfen Tıklayın...
                                </button>
                                </form></li>';
                            }
                           }
                            ?>
                          </ul>
                          <br>
                        </div>
                        
                      </div>
                      <?php
                    }
                      ?>
                    </div>
              </div>
              </div>
         </div>   
      </div>
    </div>


</section>
<div class="clearfix"></div>   
<?php
include "footer.php";
?>