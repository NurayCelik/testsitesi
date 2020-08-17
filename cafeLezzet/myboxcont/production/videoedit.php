<?php 
include 'header.php';
include '../../classes/Pages.php'; 


 if (!isset($_GET['videoedit'])  || $_GET['videoedit'] == NULL ) {
     echo "<script>window.location = 'videoedit.php';  </script>";
  }else {
    $id = $_GET['videoedit']; // get this id from productlist.php page and take this with one variable as $id 
 
  }
 
   $page =  new Pages(); // Create object for Product Class 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle']) ) {
       $updatedVideo = $page->videoUpdate($_POST, $_FILES, $id); // This method is for update data 
    }
 
?> 


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yönetim Paneli</h3>
         
      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
             <div class="x_title">
             <div align="left" class="col-md-6">
              <h2 >Video Update <small>
               <?php 
              if (isset($updatedVideo)) { 
                 echo $updatedVideo;
                
              }
              ?>
                
              </small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                <a href="video.php"><button  class="btn btn-warning "><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button></a>
              </div>
              <div class="clearfix"></div>
            </div>

              <div class="x_content">
                <?php
                $takenVideo = $page->getItemById("tbl_video","videoId",$id);  // in our product class i create one method with id 
                 if ($takenVideo) {
                    while ($value = $takenVideo->fetch_assoc()) {
                        # code...

                ?>

                <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mevcut Video<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <video controls width="200" height="200" src="<?php echo $value['video']; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"><?php
                    echo "<script type=text/javascript>";
                    echo "alert('128 MB den büyük video yükleyemezsiniz! Video yükleme işlemi biraz zaman alabilir!')";
                      echo "</script>"; ?>
                      <input type="file" id="first-name"  name="video"  class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Ad<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="videoName" value="<?php echo $value['videoName']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Link<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" name="videoLink" value="<?php echo $value['videoLink']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Sıra<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="videoSira" value="<?php echo $value['videoSira']; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Durum<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <select id="heard" class="form-control" name="videoDurum" required>

                      <?php 
                      if ($value['videoDurum']==1) {?>

                      <option value="1">Aktif</option>
                      <option value="0">Pasif</option>

                      <?php } else { ?>

                      <option value="0">Pasif</option>
                      <option value="1">Aktif</option>

                      <?php } } } ?>

                      </select>
                    </div>
                  </div>

                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="guncelle" class="btn btn-primary">Güncelle</button>
                  </div>

                </form>



              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->



  <?php include 'footer.php'; ?>
