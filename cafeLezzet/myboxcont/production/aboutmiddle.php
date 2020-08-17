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
      $updatedAboutMiddle  = $page->aboutMiddleUpdate($_POST);
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
      $updatedAboutMiddle  = $page->UpdateFoto($_FILES, "imageOrta", "tbl_hakkimizda","hakkimizdaId","hakkimizda");
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
        if(isset($updatedAboutMiddle))
        {
          echo $updatedAboutMiddle;
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
              <h2>Hakkımızda Sayfa Düzenleme <small>/ orta bölüm
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
                      <input type="text" id="first-name" required="required" name="ortaBaslik1" value="<?php echo $fm->validation($value['ortaBaslik1']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="ortaBaslik2" value="<?php echo $fm->validation($value['ortaBaslik2']); ?>" class="form-control col-md-7 col-xs-12">
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
                  
                    <?php 
                    if (strlen($value['imageOrta'])>0) {?>

                    <img width="200"  src="<?php echo $value['imageOrta']; ?>">

                    <?php } else { ?>


                    <img width="200"  src="upload/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="imageOrta" class="form-control col-md-7 col-xs-12">
                    </div>

                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
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
