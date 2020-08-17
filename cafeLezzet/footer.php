<footer>
    <div class="footer_icerik">
      <div class="row">
        <div class="container">
        <div class="col col-12">
          <div class="firinci_logo_cont_footer">
              <?php
                $takenSiteLogo = $brand->getSiteInfo();
                    if ($takenSiteLogo) {
                     while ($value = $takenSiteLogo->fetch_assoc()) { 
              ?> 
            <a href="index.php" class="firinci_image_logo_footer"> <img class="rounded" src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['LogoMd'])); ?>" rel="logo" Width="140px;" Height="120px;" alt="Lezzzet Cafe" class="responsive"/>                      
            </a>
          <?php 
              }
          }
           ?>
            <div class="firinci_foter_text"><span> <a href="index.php"><i><?php echo $fm->validation($value['siteName']);?></i></a></span></div>  
          </div>
          <div class="clearfix"></div>
          <div class="footer_bolumler">
          
         
         <?php 
         echo '<ul class="firinci_foter_menu">';
         $takenMenu = $brand->getAllMenu(); // Create method in Product Class 
           if ($takenMenu) {
            $i = 0;
          while ($result = $takenMenu->fetch_assoc() ) {
            $i++;
          if($result['menuDurum']==1){
          if($i==3){
            echo '<li><a class="footer_sola_dayan footer_bolum" href="'.$fm->validation($result['menuUrl']).'">'.$fm->validation($result['menuName']).'</a></li>';
          }
     

          
          elseif($i==7)
          continue;
          else{

            echo '<li><a class="footer_sola_dayan"  href="'.$fm->validation($result['menuUrl']).'">'.$fm->validation($result['menuName']).'</a></li>'; 
          }
       }
       else
       {
        echo '';
       }
     }
      }     
      echo '</ul></div><div class="clearfix"></div>';
        
        echo '<div class="sosyal"><ul class="firinci_social">';
            $getSocial = $brand->getApiSocial();
                  if($getSocial){
                    while ($value = $getSocial->fetch_assoc()) { 
                      $data = explode(".",$value['twitter']);
         echo '<li><a href="'.$fm->validation($value['twitter']).'/"><i class="fa fa-'.$fm->validation($fm->seo($data[1])).' sosyaliconlar" aria-hidden="true"></i></a></li>';

         $data1 = explode(".",$value['facebook']);
         echo '<li><a href="'.$fm->validation($value['facebook']).'/"><i class="fa fa-'.$fm->validation($fm->seo($data1[1])).' sosyaliconlar" aria-hidden="true"></i></a></li>';
         
         $data2 = explode(".",$value['instagram']);
         echo '<li><a href="'.$fm->validation($value['instagram']).'/"><i class="fa fa-'.$fm->validation($fm->seo($data2[1])).' sosyaliconlar" aria-hidden="true"></i></a></li>';
          } 
        }
           echo '</ul></div><div class="clearfix"></div>';
          ?>
         <?php
                $takenSiteLogo = $brand->getSiteInfo();
                    if ($takenSiteLogo) {
                     while ($value = $takenSiteLogo->fetch_assoc()) { 
                     $sene = explode ("-",$fm->validation($value['tarih']));
                     ?>
          <div class="firinci_copy_text">Copyright © <?php echo $sene[0];?> <a class="markaFooter" href="<?php echo $fm->validation($value['siteUrl']);?>"><?php echo $fm->validation($value['siteName']);?></a>. Tüm Hakları Saklıdır & by <?php echo $fm->validation($value['siteauthor']);?><a href="www.ankayazilim.net" style="color:#FEFCD6 !important;font-size: 18px;"><i> & <?php echo $fm->validation($value['copyright']);?></i></a></a></div>
          <?php
        }
        }
        ?>
          </div>
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="bootstrap-4.0/js/bootstrap.js"></script>
<script type="text/javascript" src="bootstrap-4.0/js/scriptler.js"></script> 


  </body>
 
</html>