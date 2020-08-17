<?php
include "header.php";
$page  = new Pages();
$fm    = new Format(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) { 
      
     $gonderilenForm  = $phpmail->formGonder($_POST).$phpmail->MaileGonder($_POST);
    
    }
?>

<section>

<?php 
$getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Caterıng",$id=4);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) { 
?>
  <div class="parallaxCat img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>'">
<?php
}
}
?>
</div>
<div class="clearfix"></div>
<div class="firinciCatering">
	<div class="container padding0">
		<div class="row">
			<div class="col-lg-12 padding0">
				 <div class="cateringParag">
          <?php
        
          $takenCatering = $page->getAllTable("tbl_catering");
            if ($takenCatering) {
             while ($result = $takenCatering->fetch_assoc()) { 
          ?>
           <h3 class="cateringFirst"><span><?php echo $fm->validation($result['baslik']);?></h3>
            <h5 class="headCatering"><?php echo $fm->validation($result['altBaslik']);?></h5>
             <div class="separator_flower">✻</div>
              <?php 
              
                $text = $fm->validation(stripslashes($result['icerik']));
                $text = $fm->yerDegistir('/buradan/','<a href="#buradan">buradan</a>',$text);
                $text = $fm->format_punc($text);
                $fm->cumleAdediBelirleParagrafta($text,"",2); 

              ?>
             </div>
            </div>
          </div>
        </div>
         <?php 
               }
           }
          ?>
						<div class="clearfix"></div>
        <div class="container catMargin">
            <div class="cateringCont">
              <div class="row">
                <?php 
                
                $takenCateringFoto = $page->getAllTable("tbl_galericatering");
                if ($takenCateringFoto) {
                  $i=1;
                 while ($result = $takenCateringFoto->fetch_assoc()) { 
                   echo '<div class="col catGaleriImg"><img src="'.$fm->validation($fm->fotoAdDegistir("../","",$result['image'])).'" width="190" height="150"></div>';
                      if($i%5==0)
                      {
                        echo '<div class="w-100"></div>';
                      }

                      $i++;
              }
             
     }
              ?>
     
              </div>
            </div>
           </div>
          </div>
				</div>
			</div>

<div class="clearfix"></div>
<div class="firinci_aile" id="buradan">
    <div class="dokuRengi">
     <div class="container">
      <div class="row" id="FranchiseForm">
       
     
      <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1 franchiseFormu" id="formGirisi0">
      <div class="formGirisi">
          <h3>mesaj bırak </h3>
          </div>

            <form name="sentMessage" id="contactForm" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'];?>#formGirisi0" method ="POST">
              <div class="form-group">
                <input type="text" id="ad" name="ad" class="form-control" placeholder="Ad" required="required">
                <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                  <input type="text" id="soyad" name="soyad" class="form-control" placeholder="Soyad" required="required">
                  <p class="help-block  text-danger"></p>
              </div>
              <div class="form-group">
                  <input type="text" id="telefon" name="telefon" class="form-control" placeholder="Telefon" required="required">
                  <p class="help-block  text-danger"></p>
              </div>
              <div class="form-group">
                  <input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required">
                  <p class="help-block text-danger"></p>
              </div>
              <div class="form-group">
                <textarea name="mesaj" id="mesaj" class="form-control" name="mesaj" rows="4" placeholder="Mesaj" required="required"></textarea>
                <p class="help-block text-danger"></p>
              </div>
              <div id="success"> </div>
              <button type="submit" id="gonderButon" name="submit" class="btn btn-custom btn-lg form_butonu1">Gönder</button>
           </form> <?php

                $phpmail  = new Maillerform();

                  if(isset($gonderilenForm)) {
                       echo $gonderilenForm;
                    }
                  ?>
   
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
  