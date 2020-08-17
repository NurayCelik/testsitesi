<?php 
include 'header.php';
include '../../classes/Pages.php';

$page = new Pages();
 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {  
  $insertedVideo = $page->videoInsert($_POST, $_FILES);
        
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
              <h2>Video Ekle<small>
                <?php 
            if (isset($insertedVideo)) {
                 echo $insertedVideo;
              }
             ?></small> </h2>
                <ul class="nav navbar-right panel_toolbox">

                  <a href="video.php"><button type="submit" name="back" class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Vazgeç</button></a>


                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">

                <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"><?php
                    echo "<script type=text/javascript>";
                    echo "alert('128 MB den büyük video yükleyemezsiniz! Video yükleme işlemi biraz zaman alabilir!')";
                      echo "</script>"; ?>
                      <input type="file" id="first-name" required="required" name="video"  class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Ad<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="videoName" placeholder="Video adını giriniz..." class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Link<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" name="videoLink" placeholder="Video link giriniz..." class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                   <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Sıra<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="first-name" required="required" name="videoSira" value="0" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Video Durum<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                     <select id="heard" class="form-control" name="videoDurum" required>
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                         
                          </select>
                    </div>
                  </div>

                  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary">Kaydet</button>
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
