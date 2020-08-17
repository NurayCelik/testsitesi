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
      $mainTopUpdate  = $page->UpdateFoto($_FILES,"image1","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
      $mainTopUpdate  = $page->UpdateFoto($_FILES,"image2","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle3']): 
      $mainTopUpdate  = $page->UpdateFoto($_FILES,"image3","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle4']): 
      $mainTopUpdate  = $page->UpdateFoto($_FILES,"image4","tbl_anasayfa","anasayfaId","anasayfa");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle5']): 
      $mainTopUpdate  = $page->mainEndUpdate($_POST);
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
        if(isset($mainTopUpdate))
        {
          echo $mainTopUpdate;
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
              <h2>Anasayfa Düzenleme <small>/ son bölüm
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <?php 
                      
                    $getMainEnd = $page->getAllTable("tbl_anasayfa");
                    if ($getMainEnd) {
                     while ($value = $getMainEnd->fetch_assoc()) { 
                     ?> 
                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                 <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <img width="200"  src="<?php echo $value['image1']; ?>">
                  </div>
                 </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="image1" class="form-control col-md-7 col-xs-12" multiple>
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
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <img width="200"  src="<?php echo $value['image2']; ?>">
                  </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="image2" class="form-control col-md-7 col-xs-12" multiple>
                    </div>
                  </div>
                  <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
                </div>
                </form>
                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <img width="200"  src="<?php echo $value['image3']; ?>">
                    </div>
                   </div>
                   <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">

                       <input type="file" id="first-name" required="required" name="image3" class="form-control col-md-7 col-xs-12" multiple>
                      </div>
                  </div>
                  <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                    <button type="submit" name="guncelle3" class="btn btn-primary">Güncelle</button>
                  </div>
                 </form>

                 <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <img width="200"  src="<?php echo $value['image4']; ?>">
                    </div>
                   </div>
                   <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">

                       <input type="file" id="first-name" required="required" name="image4" class="form-control col-md-7 col-xs-12" multiple>
                      </div>
                    </div>
                    <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                    <button type="submit" name="guncelle4" class="btn btn-primary">Güncelle</button>
                  </div>
                </form>

                   <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="servisBaslik" value="<?php echo $fm->validation($fm->textShorten($value['servisBaslik'],30)); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ürünler Kısa Bilgi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="servisIcerik1" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($fm->textShorten($value['servisIcerik1'],200)); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Link Sayfa İsmi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="servisHref1" value="<?php echo $fm->validation($value['servisHref1']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Catering Kısa Bilgi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="servisIcerik2" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($fm->textShorten($value['servisIcerik2'],200)); ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Link Sayfa İsmi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="servisHref2" value="<?php echo $fm->validation($value['servisHref2']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle5" class="btn btn-primary">Güncelle</button>
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
