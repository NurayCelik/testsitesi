<?php 
include 'header.php';
include '../../classes/Pages.php';  
include_once '../../helpers/Format.php';

$fm    = new Format(); 
$page  = new Pages();
    

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
    {
     
      switch(true){

        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle3']): 
        $updatedAboutEnd  = $page->aboutEndUpdate($_POST);
        break;
        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle0']): 
        $updatedAboutEnd  = $page->UpdateFoto($_FILES,"altImage1","tbl_hakkimizda","hakkimizdaId","hakkimizda");
        break;
        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle1']): 
        $updatedAboutEnd  = $page->UpdateFoto($_FILES,"altImage2","tbl_hakkimizda","hakkimizdaId","hakkimizda");
        break;
        case $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['guncelle2']): 
        $updatedAboutEnd  = $page->UpdateFoto($_FILES,"altImage3","tbl_hakkimizda","hakkimizdaId","hakkimizda");
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
        if(isset($updatedAboutEnd))
        {
         echo $updatedAboutEnd;
        
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
              <h2>Hakkımızda Sayfa Düzenleme <small>/ son bölüm
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

                 <?php 
                 $titleName = array('altBaslik1','altBaslik2','altBaslik3');
                 $textName = array('altIcerik1','altIcerik2','altIcerik3');
                 for($i=0;$i<3;$i++){
                  echo '<form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Başlık<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="'.$titleName[$i].'" value="'.$fm->validation($value[$titleName[$i]]).'" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İçerik<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <textarea name="'.$textName[$i].'" id="first-name" class="form-control col-md-7 col-xs-12" rows="5" id="first-name" required="required" >'.$fm->validation($value[$textName[$i]]).'</textarea>
                    </div>
                    </div>
                  ';
                }
                 echo '</div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle3" class="btn btn-primary">Güncelle</button>
                </div>

              </form>';

                 $imageName = array('altImage1','altImage2','altImage3');
                 for($i=0;$i<3;$i++){
                  echo '
                  <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
               
                  <div class="form-group">
                  <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image<span class="required">*</span>
                  </label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  ';
                    if (strlen($value[$imageName[$i]])>0) {
                    echo '
                    <img width="200"  src="'.$value[$imageName[$i]] .'">';

                    } else { 

                    echo '
                    <img width="200"  src="upload/hakkimizda/logo-yok.png">';


                    } 

                    echo '
                  </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Image Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                     <input type="file" id="first-name" required="required" name="'.$imageName[$i].'" class="form-control col-md-7 col-xs-12" multiple>
                    </div>
                </div>
                <div align="right" class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" name="guncelle'.$i.'" class="btn btn-primary">Güncelle</button>
                </div>

              </form>
                ';
              }
                ?>
               

                

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
