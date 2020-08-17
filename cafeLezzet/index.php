<?php

include "header.php";
include "slider.php";
$page = new Pages();
$getMainTop = $page->getAllTable("tbl_anasayfa");
  if ($getMainTop) {
   while ($value = $getMainTop->fetch_assoc()) { 
   ?> 

<section>
<div class="container-fluid">
 <header class="indexAri">
          <div class="indexFirst" >
            <img class="indexFirstImg" width="1500" height="500" src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['markaImage']));?>" class="responsive"/>
          </div>
          <div class="indexFirstWrapper">
          <hgroup class="indexHeaderGroup">
              <h3 class="indexHeadFirst"><i><?php echo $fm->validation($value['markaBaslik1']); ?></i></h3>
              <h2 class="indexHeadSecond"><span><?php echo $fm->validation($value['markaBaslik2']); ?></span></h2>
          </hgroup>
        </div>
        </header> 
</div>
<div class="clearfix"></div>
 <div class="firinci_container container-fluid">
    <div class="row justify-content-center yeniMargin">
      <div class="col-8 align-items-center">
        <div class="row justify-content-center" id="table">
      <div class="col-md-6 col-sm-12 col-xs-12 honey">
          <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['hakImage1'])); ?>" width="500" heigh="570" class="responsive">
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12 honeyText">
          <p>
            <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['hakImage2'])); ?>" width="800" heigh="400" class="responsive">
          </p>
          <div> 
            <div class="realText">
            <p>
              <strong><?php echo $fm->validation($fm->textshorten($value['hakBaslik'],30)); ?></strong>
         </p>
              <P>
                <?php echo $fm->validation($fm->textshorten($value['hakIcerik'],180)); ?>
             </P>
               <p>
              <a href="<?php echo $fm->validation($fm->seo($fm->textshorten($value['hakhref'],20))); ?>.php" style="color:#ffc107; font-size: 18px;"><?php echo $fm->validation($fm->textshorten($value['hakhref'],20)); ?> </a>
             
              </p>
            </div> 
          </div>
      </div>
      
         
        
              </div>
          </div>
      </div>
  </div>
  <div class="firinci_container container">
              <div class="row div_sinir">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 icon_text">
                  <div class="item_durum">
                    <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['kaliteImage'])); ?>" alt="" width="250" height="220" class="kalite">
                    <div class="netlik">
                      <div class="netlik1">
                      <h4><?php echo $fm->validation($fm->textshorten($value['kaliteBaslik'],26)); ?></h4>
                      </div>
                      <p><?php echo $fm->validation($fm->textshorten($value['kaliteIcerik'],180)); ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 icon_text">
                  <div class="item_durum">
                    <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['hizliImage'])); ?>" alt="" width="250" height="220" id="kalite">
                    <div class="netlik">
                      <div class="netlik1">
                      <h4><?php echo $fm->validation($fm->textshorten($value['hizliBaslik'],26)); ?></h4>
                      </div>
                      <p><?php echo $fm->validation($fm->textshorten($value['icerikHizli'],180)); ?></p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 icon_text">
                  <div class="item_durum">
                    <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['imageDogal'])); ?>" alt="" width="250" height="220" class="kalite">
                    <div class="netlik">
                      <div class="netlik1">
                      <h4><?php echo $fm->validation($fm->textshorten($value['dogalBaslik'],26)); ?></h4></div>
                      <p><?php echo $fm->validation($fm->textshorten($value['icerikDogal'],180)); ?></p>
                    </div>
                  </div>
              </div>
            </div>
</div>

<div class="clearfix"></div>
<div class="container-fluid">
  <div class="row kimdirRengi">
     
      <div class="col-md-12">
        <div class="lezzetParag1">
          <div class="row">
          <div class="col-lg-7 col-md-12">
                <div class="anaSayfaFoto1">
                 <div class="grid__item six-twelfths palm-one-whole" >
    

   

    <div id='album' class='row album albumid-15 album-columns-2 album-size-medium'>
      <?php
      for ($i=1; $i<5; $i++)
      {
        if($i==2){
        echo '<figure class="album-item col-6 col-xs-12">
      <div class="album-icon landscape">
        <a  href=""><img width="300" height="200" src="'.$fm->validation($fm->fotoAdDegistir("../","",$value["image$i"])).'" class=""/></a>
      </div></figure><div class="w-100"></div>';
    }
      else
      {
        echo '<figure class="album-item col-6 col-xs-12">
      <div class="album-icon landscape">
        <a  href=""><img width="300" height="200" src="'.$fm->validation($fm->fotoAdDegistir("../","",$value["image$i"])).'" class=""/></a>
      </div></figure>';
      }
      }
      ?>
      
    </div>

  </div>  
                </div>
              </div>
                 <div class="col-lg-5 col-md-12 col-xs-12 ">
                <div class="uyeBayi">
                  <div class="uyeBayi1">
                   <h3><?php echo $fm->validation($fm->textshorten($value['servisBaslik'],20)); ?></h3>
                    <p class="firstStatus">
                   <?php echo $fm->validation($fm->textshorten($value['servisIcerik1'],180)); ?>
                 </p>
               <p><a href="<?php echo $fm->validation($fm->seo($fm->textshorten($value['servisHref1'],20))); ?>.php"><b> <?php echo $fm->validation($value['servisHref1']); ?> </b></a> 
                  </p>
                  <br>
                  <p>
                  <?php echo $fm->validation($fm->textshorten($value['servisIcerik2'],180)); ?>
               </p>
               <p><a href="<?php echo $fm->validation($fm->seo($fm->textshorten($value['servisHref2'],20))); ?>.php"><b> <?php echo $fm->validation($fm->textshorten($value['servisHref2'],20)); ?> </b></a> 
                  </p>
                  <?php
              }
            }
            ?>
              </div>
            </div>
        </div>
      </div>
      </div>
    </div>
</div>
</div>
<div class="clearfix"></div>
  
</section>    
<?php
include "footer.php";
?>