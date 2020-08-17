<?php 
include 'header.php';
include '../../classes/Pages.php';  
include_once '../../helpers/Format.php';

$fm    = new Format(); 
$page  = new Pages();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
    {
     
     switch(true){

      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle1']): 
      $updatedMainMiddle  = $page->UpdateFoto($_FILES,"hakImage1","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
      $updatedMainMiddle  = $page->UpdateFoto($_FILES,"hakImage2","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle3']): 
      $updatedMainMiddle  = $page->UpdateFoto($_FILES,"kaliteImage","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle4']): 
      $updatedMainMiddle  = $page->UpdateFoto($_FILES,"hizliImage","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle5']): 
      $updatedMainMiddle  = $page->UpdateFoto($_FILES,"imageDogal","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle6']): 
      $updatedMainMiddle  = $page->mainMiddleUpdate($_POST);
      break;
      default :
      echo "";
    }

    } 
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yonetim Paneli</h3>
        <?php  
        if(isset($updatedMainMiddle))
        {
          echo $updatedMainMiddle;
        }
       
        ?>
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Anasayfa Düzenleme <small>/ orta bölüm
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <?php 
                      
                    $getMainMiddle = $page->getAllTable("tbl_anasayfa");
                    if ($getMainMiddle) {
                     while ($value = $getMainMiddle->fetch_assoc()) { 
                     ?> 
                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                   <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <img width="200" src="<?php echo $value['hakImage1']; ?>">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" title="Güncellemek İstiyorsanız lütfen yeniden Fotoğrafları seçiniz!"  name="hakImage1" class="form-control col-md-7 col-xs-12" multiple>
                    </div>
                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle1" class="btn btn-primary">Güncelle</button>
                </div>

              </form>

                  <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                 <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12"><img width="200"  src="<?php echo $value['hakImage2']; ?>"></div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" title="Güncellemek İstiyorsanız lütfen Fotoğrafları seçiniz!" name="hakImage2" class="form-control col-md-7 col-xs-12" multiple>
                    </div>
                  </div>
                  <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
              <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kalite Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12"><img width="200"  src="<?php echo $value['kaliteImage']; ?>">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" title="Güncellemek İstiyorsanız lütfen Fotoğrafları seçiniz!" id="first-name" name="kaliteImage" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle3" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
                  <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hızlı Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <img width="200"  src="<?php echo $value['hizliImage']; ?>">
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" title="Güncellemek İstiyorsanız lütfen Fotoğrafları seçiniz!" name="hizliImage" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle4" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
                  <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Doğal Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <img width="200"  src="<?php echo $value['imageDogal']; ?>"> </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" title="Güncellemek İstiyorsanız lütfen Fotoğrafları seçiniz!" name="imageDogal" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>

                 <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle5" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
                 <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="hakBaslik" value="<?php echo $fm->validation($value['hakBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İçerik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="hakIcerik" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['hakIcerik']); ?></textarea>
                    </div>
                 </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Href1<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="hakhref" value="<?php echo $fm->validation($value['hakhref']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kalite Başlik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="kaliteBaslik" value="<?php echo $fm->validation($fm->textShorten($value['kaliteBaslik'],30)); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Kalite İçerik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="kaliteIcerik" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['kaliteIcerik']); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hızlı Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="hizliBaslik" value="<?php echo $fm->validation($value['hizliBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hızlı İçerik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="icerikHizli" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['icerikHizli']); ?></textarea>  
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Doğal Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="dogalBaslik" value="<?php echo $fm->validation($value['dogalBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Doğal İçerik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="icerikDogal" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['icerikDogal']); ?></textarea>   
                    </div>
                  </div>
                
               

                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle6" class="btn btn-primary">Güncelle</button>
                </div>

              </form>

                <?php } }?>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
