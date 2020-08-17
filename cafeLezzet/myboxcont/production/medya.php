<?php 
include 'header.php';
include '../../classes/Pages.php';  
include_once '../../helpers/Format.php';

$fm    = new Format(); 
$page  = new Pages();
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle'])) { 
       
       $updatedMedya = $page->medyaUpdate($_POST, $_FILES);
    
    }
  
?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yonetim Paneli</h3>
        <?php  
        if(isset($updatedMedya))
        {
          echo $updatedMedya;
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
              <h2>Medya Sayfa Düzenleme <small>Genel
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <?php 
                      
                    $getMedya = $page->getAllTable("tbl_medya");
                    if ($getMedya) {
                     while ($value = $getMedya->fetch_assoc()) { 
                     ?> 
                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sayfa Üst Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="medyaBaslik" value="<?php echo $fm->validation($value['medyaBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sayfa Üst Yardımcı Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="baslik" value="<?php echo $fm->validation($value['baslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İmage Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="ortaBaslik" value="<?php echo $fm->validation($value['ortaBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Yardımcı Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="ortaAltBaslik" value="<?php echo $fm->validation($value['ortaAltBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                 
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  
                    <?php 
                    if (strlen($value['image'])>0) {?>

                    <img width="200"  src="<?php echo $value['image']; ?>">

                    <?php } else { ?>


                    <img width="200"  src="upload/medya/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" name="resimler" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İnstagram Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="altBaslik" value="<?php echo $fm->validation($value['altBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Takipçi<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="takipci" value="<?php echo $fm->validation($value['takipci']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
               

                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                  <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
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
