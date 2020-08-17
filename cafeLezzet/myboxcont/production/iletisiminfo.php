<?php 
include 'header.php';
include '../../classes/Brand.php';  
include_once '../../helpers/Format.php';

$fm    = new Format(); 
$brand =  new Brand();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
    {
     
      switch(true){

      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle1']): 
      $updatedIletisim  = $brand->UpdateFoto($_FILES,"mimage","tbl_iletisim","iletisimId","site"); 
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
      $updatedIletisim  = $brand->UpdateFoto($_FILES,"simage","tbl_iletisim","iletisimId","site");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle3']): 
      $updatedIletisim  = $brand->iletisimUpdate($_POST);
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
        <h3>Yönetim Paneli</h3>
        <?php 
        if(isset($updatedIletisim))
        {
          echo $updatedIletisim;
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
              <h2>İletişim Bilgileri Güncelle <small> 
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
                <?php 
                      
                    $getIletisim = $brand->getIletisimInfo();
                    if ($getIletisim) {
                     while ($value = $getIletisim->fetch_assoc()) { 
                     ?> 

                <form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal 
                form-label-left" enctype="multipart/form-data">
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez Foto<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  
                    <?php 
                    if (strlen($value['mimage'])>0) {?>

                    <img width="200"  src="<?php echo $value['mimage']; ?>">

                    <?php } else {?>


                    <img width="200"  src="upload/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez Foto Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                     <input type="file" id="first-name" required="required" name="mimage" class="form-control col-md-7 col-xs-12">
                    </div>

                </div>
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="guncelle1" class="btn btn-primary">Güncelle</button>
                  </div>

                </form>

                <form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal 
                form-label-left" enctype="multipart/form-data">
                
                  <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube Foto<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  
                    <?php 
                    if (strlen($value['simage'])>0) {?>

                    <img width="200"  src="<?php echo $value['simage']; ?>">

                    <?php } else {?>


                    <img width="200"  src="upload/logo-yok.png">


                    <?php } ?>

                    
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube Foto Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                     <input type="file" id="first-name" required="required" name="simage" class="form-control col-md-6 col-xs-12" multiple>
                    </div>

                </div>
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
                  </div>

                </form>

                <form action="" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal 
                form-label-left" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez Telefon<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="merkezTel" value="<?php echo $fm->validation($value['merkezTel']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube Telefon <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="subeTel" value="<?php echo $fm->validation($value['subeTel']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">GSM Numaranız <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="gsmNo" value="<?php echo $fm->validation($value['gsmNo']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail Adresiniz <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="mailAdres" value="<?php echo $fm->validation($value['mailAdres']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez Adres <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="merkezAdres" value="<?php echo $fm->validation($value['merkezAdres']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez İlçe <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="milce" value="<?php echo $fm->validation($value['milce']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Merkez İl <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="mil" value="<?php echo $fm->validation($value['mil']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube Adres <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="subeAdres" value="<?php echo $fm->validation($value['subeAdres']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube İlçe <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="subeilce" value="<?php echo $fm->validation($value['subeilce']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şube İl <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="subeil" value="<?php echo $fm->validation($value['subeil']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mesai Saatleri <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="mesaiSaat" value="<?php echo $fm->validation($value['mesaiSaat']); ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="guncelle3" class="btn btn-primary">Güncelle</button>
                  </div>

                </form>

                <?php } } ?>


              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->



  <?php include 'footer.php'; ?>
