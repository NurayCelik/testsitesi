<?php 
include 'header.php';
include '../../classes/Pages.php'; 


 $fm    = new Format(); 


 if (!isset($_GET['haberduzenle'])  || $_GET['haberduzenle'] == NULL || !isset($_GET['columnIdName'])  || $_GET['columnIdName'] == NULL ) {
     echo "<script>window.location = 'haber.php';  </script>";
  }else {
    $id = $_GET['haberduzenle']; // get this id from productlist.php page and take this with one variable as $id 
    $columnIdName = $_GET['columnIdName'];
 
  }
 
   $page =  new Pages(); // Create object for Product Class 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle']) ) {
       $updatedHaber = $page->haberUpdate($_POST, $_FILES, $id); // This method is for update data 
    }
 
?> 



<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yönetim Paneli</h3>
          <?php 
              if (isset($updatedHaber)) { 
                 echo $updatedHaber;
                
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
              <h2 >Haber Update <small>
              
          
        </small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                <a href="haber.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button></a>
              </div>
              <div class="clearfix"></div>
            </div>

              <div class="x_content">
                <?php
                $takenHaber= $page->getItemById("tbl_haber",$columnIdName, $id);  // in our product class i create one method with id 
                 if ($takenHaber) {
                    while ($value = $takenHaber->fetch_assoc()) {
                        # code...

                ?>

                <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                 
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Yüklü Resim<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <img width="200" height="100" src="<?php echo $value['image']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İmage Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" id="first-name"  name="image"  class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Başlık <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="haberBaslik" value="<?php echo $value['haberBaslik']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Detay <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <textarea required="required" name="haberDetay" rows="15" class="form-control col-md-7 col-xs-12"><?php echo $value['haberDetay']; ?></textarea>

                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Kaynak <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="haberKaynak" value="<?php echo $value['haberKaynak']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Sıra <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="haberSira" value="<?php echo $value['haberSira']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Durum<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     <select id="heard" class="form-control" name="haberDurum" required>
                       <option>Select Durum</option>
                          <?php
                        if ($value['haberDurum'] == 1) { ?>
                           <option selected = "selected" value="1">Aktif</option>
                            <option value="0">Pasif</option>
                       <?php } else {  ?>
 
                            <option value="1">Aktif</option>
                            <option selected = "selected" value="0">Pasif</option>
                        <?php }  ?>
                    </select>
                   </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Tarih <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="date" id="first-name" required="required" name="haberTarih" value="<?php 
                      echo $fm->formatDateOnly($value['haberTarih']); 
                      ?>" title= "<?php echo "Haber Tarihi : ".$fm->formatDateOnly($value['haberTarih'])."\nDeğiştirmek İstiyorsanız lütfen Yeni Tarih Belirleyniz!"; ?>"class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div align="right" class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
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
