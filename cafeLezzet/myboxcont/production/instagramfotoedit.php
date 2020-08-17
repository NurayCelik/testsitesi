<?php 
include 'header.php';
include '../../classes/Pages.php'; 


 if (!isset($_GET['instagramFotoEdit'])  || $_GET['instagramFotoEdit'] == NULL || !isset($_GET['columnIdName'])  || $_GET['columnIdName'] == NULL ) {
     echo "<script>window.location = 'instagramfoto.php';  </script>";
  }else {
    $id = $_GET['instagramFotoEdit']; // get this id from productlist.php page and take this with one variable as $id 
    $columnIdName = $_GET['columnIdName'];
 
  }
 
   $page =  new Pages(); // Create object for Product Class 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle']) ) {
       $updatedInstagramFoto = $page->instagramFotoUpdate($_POST, $_FILES, $id); // This method is for update data 
    }
 
?> 


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yönetim Paneli</h3>
          <?php 
              if (isset($updatedInstagramFoto)) { 
                 echo $updatedInstagramFoto;
                
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
             <div align="left" class="col-md-6">
              <h2 >İnstagram Galeri Update <small>
              
          
        </small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                <a href="instagramfoto.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button></a>
              </div>
              <div class="clearfix"></div>
            </div>

              <div class="x_content">
                <?php
                $takenInstagramFoto = $page->getItemById("tbl_instagaleri",$columnIdName, $id);  // in our product class i create one method with id 
                 if ($takenInstagramFoto) {
                    while ($value = $takenInstagramFoto->fetch_assoc()) {
                        # code...

                ?>

                <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sira No : <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="sira" value="<?php echo $value['sira']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yüklü Resim<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <img width="200" height="100" src="<?php echo $value['image']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İmage Seç<br>Boyut:  300x200 px<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file" id="first-name"  name="image" title="Foto Boyutu 300x200 px olmalı!" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
                  </div>

                </form>

        <?php } }  ?>

             </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->



  <?php include 'footer.php'; ?>
