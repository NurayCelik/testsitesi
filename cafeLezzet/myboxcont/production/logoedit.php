<?php 
include 'header.php';
include '../../classes/Brand.php';  


 $brand =  new Brand();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
    {
     
      switch(true){

      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle1']): 
      $updatedLogo  = $brand->UpdateFoto($_FILES,"LogoMd","tbl_site","siteId","site");
      break;
      case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
      $updatedLogo  = $brand->UpdateFoto($_FILES,"LogoLg","tbl_site","siteId","site");
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
        if(isset($updatedLogo))
        {
          echo $updatedLogo;
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
              <h2>Site Logo Güncelle<small> 

                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">




                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">
               <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  <?php 
                      
                    $getSite = $brand->getSiteInfo();
                    if ($getSite) {
                     while ($value = $getSite->fetch_assoc()) { 
                     ?> 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Logo Small<br>300x300 px<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <img width="200"  src="<?php echo $value['LogoMd']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Logo Seç-small<span class="required">*</span>
                  </label><div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="LogoMd"  class="form-control col-md-7 col-xs-12" multiple >
                  </div>
                </div>
                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="guncelle1" class="btn btn-primary">Güncelle</button>
                </div>
                
              </form>

                  <form action="" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                  
                

                 <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Site Logo Large<br>500x500 px<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <img width="200"  src="<?php echo $value['LogoLg']; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Logo Seç-large<span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="first-name"  name="LogoLg"  class="form-control col-md-7 col-xs-12" multiple >
                  </div>
                </div>

                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <button type="submit" name="guncelle2" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
          <?php
                  }
                }
                
                ?>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /page content -->



<?php include 'footer.php'; ?>
