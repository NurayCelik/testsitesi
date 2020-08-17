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
        $updatedAboutTop  = $page->aboutTopUpdate($_POST);
        break;
        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
        $updatedAboutTop  = $page->UpdateFoto($_FILES,"image1","tbl_hakkimizda","hakkimizdaId","hakkimizda");
        break;
        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle3']): 
        $updatedAboutTop  = $page->UpdateFoto($_FILES,"image2","tbl_hakkimizda","hakkimizdaId","hakkimizda");
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
        if(isset($updatedAboutTop))
        {
          echo $updatedAboutTop;
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
              <h2>Hakkımızda Sayfa Düzenleme <small>/ üst bölüm
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <?php 
                      
                    $getAboutTop = $page->getAllTable("tbl_hakkimizda");
                    if ($getAboutTop) {
                     while ($value = $getAboutTop->fetch_assoc()) { 
                     ?> 
                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Üst Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="ustBaslik" value="<?php echo $fm->validation($value['ustBaslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="baslik" value="<?php echo $fm->validation($value['baslik']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" title="200 harf sınırı vardır!" for="first-name">İçerik1<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="icerik1" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['icerik1']); ?></textarea>
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"  title="200 harf sınırı vardır!" for="first-name">İçerik2<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="icerik2" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['icerik2']); ?></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12"  title="200 harf sınırı vardır!" for="first-name">İçerik3<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="icerik3" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" ><?php echo $fm->validation($value['icerik3']); ?></textarea>
                      </div>
                    </div>
                    <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                    <button type="submit" name="guncelle1" class="btn btn-primary">Güncelle</button>
                  </div>
                </form>

              <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image1<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  
                    <?php 
                    if (strlen($value['image1'])>0) {?>

                    <img width="200"  src="<?php echo $value['image1']; ?>">

                    <?php } else {?>


                    <img width="200"  src="upload/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image1 Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="image1" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
                </div>
              </form>
              
              <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                 <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image2<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">

                    <?php 
                    if (strlen($value['image2'])>0) {?>

                    <img width="200"  src="<?php echo $value['image2']; ?>">

                    <?php } else {?>


                    <img width="200"  src="upload/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image2 Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="image2" class="form-control col-md-7 col-xs-12" multiple>
                    </div>

                </div>
               

                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle3" class="btn btn-primary">Güncelle</button>
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
