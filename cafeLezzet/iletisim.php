<?php
include "header.php";

$fm    = new Format(); 
$brand =  new Brand();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gonder']) ) { 
      
     $gonderilenForm  = $phpmail->formGonder($_POST).$phpmail->MaileGonder($_POST);
    
    }
?>

<section style="background-color: #000;">
<?php
  $getAbout = $page->getFotoName("tbl_menu","menuId","menuName","İletişim",$id=6);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) { 
?>
<div class="parallaxIletisim img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>')">
<?php
}
}
?>
</div>

<div class="clearfix"></div>
<div class="iletisimPage">
  <div class="container-fluid text-center">
    <div class="row" id="dialo">
   <div class="col-md-6  offset-md-3 form_nitelik1" id="formGirisi">

    <div class="section-title text-center">
      <h3>Bize Ulaşın</h3>
    </div>
    <form name="sentMessage" id="contactForm" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'];?>#formGirisi" method ="post">
        <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="ad" id="ad" class="form-control" placeholder="Ad" required="required">
              <p class="help-block text-danger"></p>
             </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="soyad" id="soyad" class="form-control" placeholder="Soyad" required="required">
              <p class="help-block text-danger"></p>
             </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" name="telefon" id="telefon" class="form-control" placeholder="Telefon" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
       </div>
        <div class="form-group">
          <textarea name="mesaj" id="mesaj" class="form-control" rows="4" placeholder="Mesaj" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" name="gonder" class="btn btn-custom btn-lg form_butonu">Mesaj Gönder</button>

      </form>
      <?php

                $phpmail  = new Maillerform();

                  if(isset($gonderilenForm)) {
                       echo $gonderilenForm;
                    }
                  ?>
   
    </div>
  </div>
</div>
</div>



<div class="clearfix"></div>
           <?php
  
 

            $takenIletisim = $brand->getIletisimInfo();

            
            if ($takenIletisim){
           
             while($value =$takenIletisim->fetch_assoc()){

?>
    <div class="container-fluid iletisim_sinir">
        <div class="row iletisim_map">
      <div class="map_icerik col-md-5 col-sm-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46223.59051011185!2d36.17959970798343!3d36.203608814120805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb29a3b5554024386!2sAvukat%20Murat%20%C3%87elik!5e0!3m2!1str!2str!4v1568888377852!5m2!1str!2str" style="border:0" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="iletisim_blok col-md-7 col-sm-12">
          <div class="iletisim_blok1">
            <div class="row">
          <div class="iletisim_blok_icerik col-md-6 col-sm-8 col-xs-8">
             <?php 
                      
                    $getSite = $brand->getSiteInfo();
                    if ($getSite) {
                     while ($row = $getSite->fetch_assoc()) { 
                     ?> 
            <h5><?php echo $fm->validation($row['siteName']); ?>- Merkez</h5>
            <?php
          }
        }
           ?> 
           <p><?php echo $fm->validation($value['merkezAdres']); ?> <?php echo $fm->validation($value['milce']); ?> <?php echo $fm->validation($value['mil']); ?> /TÜRKİYE</p>
            <p><?php echo $fm->validation($value['merkezTel']); ?></p>
            <p class=""><?php echo $fm->validation($value['mailAdres']); ?></p>
            <h5>ÇALIŞMA SAATLERİ</h5>
            <p class="calisma_saati"><?php echo $fm->validation($value['mesaiSaat']); ?></p>
          </div>
          <div class="iletisim_block_img col-md-6 col-sm-4 col-xs-4"><img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['mimage'])); ?>" width="100%" height="100%" alt="" class="img-responsive"></div>
        </div>
        </div>
        </div>
      </div>
    </div>

<div class="clearfix"></div>

  <div class="row iletisim_map1">
    <div class="container-fluid iletisim_sinir">
     
        <div class="iletisim_blok_0 col-md-7 col-sm-12">
          <div class="iletisim_blok_sube">
            <div class="row">
            <div class="iletisim_block_img1 col-md-6 col-sm-4 col-xs-4">
              <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['simage'])); ?>" width="100%" height="100%" alt="" class="img-responsive"></div>
          <div class="iletisim_blok_icerik1 col-md-6 col-sm-8 col-xs-8">
                  <?php 
                      
                    $getSite = $brand->getSiteInfo();
                    if ($getSite) {
                     while ($row = $getSite->fetch_assoc()) { 
                     ?> 

            <h5><?php echo $fm->validation($row['siteName']); ?> - Şube</h5>
               <?php
              }
            }
           ?> 

            <p><?php echo $fm->validation($value['subeAdres']); ?> <?php echo $fm->validation($value['subeilce']); ?> <?php echo $fm->validation($value['subeil']); ?> / TÜRKİYE</p>
            <p><?php echo $fm->validation($value['subeTel']); ?></p>
            <p class=""><?php echo $fm->validation($value['mailAdres']); ?></p>
            <h5>ÇALIŞMA SAATLERİ</h5>
            <p class="calisma_saati"><?php echo $fm->validation($value['mesaiSaat']); ?></p>
          </div>
          </div>
        </div>
      </div>
 <div class="map_icerik1 col-md-5 col-sm-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d46223.59051011185!2d36.17959970798343!3d36.203608814120805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb29a3b5554024386!2sAvukat%20Murat%20%C3%87elik!5e0!3m2!1str!2str!4v1568888377852!5m2!1str!2str" style="border:0" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        
        </div>
      </div>
      <?php
       }
    }
    ?>
  <div class="clearfix"></div>
  </section>
  <div class="clearfix"></div>

  <?php

  include "footer.php";
  
  ?>
  