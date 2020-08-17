<?php 
include 'header.php';
include '../../classes/Pages.php'; 

$page =  new Pages(); 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ekle']) ) {  
        $insertedHaber = $page->haberInsert($_POST, $_FILES);
        
    }
?> 
<head>  

<!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">

</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Yönetim Paneli</h3>
          <?php 
                  if(isset($insertedHaber)) {
                       echo $insertedHaber;
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
              <h2>Haber Ekle <small>
                </small> </h2>
                <ul class="nav navbar-right panel_toolbox">

                   <a href="haber.php"><button type="submit" name="back" class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Vazgeç</button></a>


                </ul>
                <div class="clearfix"></div>
              </div>

              <div class="x_content">

                <form action="" method="POST" id="demo-form2" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">İmage Seç<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="file" id="first-name" name="image" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Başlık<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" id="first-name" required="required" name="haberBaslik" placeholder="Haber Başlığı giriniz..." class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>


                    <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Detay <span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <textarea required="required" name="haberDetay" rows="15" class="form-control col-md-7 col-xs-12"></textarea>

                    </div>
                  </div>
                  
                    <div class="form-group">
                      <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Kaynak<span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" id="first-name"  name="haberKaynak" placeholder="Haber Kaynak giriniz..." class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>

                   

                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Sıra<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" id="first-name" required="required" name="haberSira" value="0" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>




                  <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Durum<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                     <select id="heard" class="form-control" name="haberDurum" required>
                      <option value="1">Aktif</option>
                      <option value="0">Pasif</option>

                    </select>
                  </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Haber Tarih<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="date" id="first-name" required="required" name="haberTarih" value="0" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                <div align="right" class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
                  <button type="submit" name="ekle" class="btn btn-primary">Kaydet</button>
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


<script src="../vendors/select2/dist/js/select2.full.min.js"></script>

<!-- Select2 -->
<script>
  $(document).ready(function() {
    $(".select2_single").select2({
      placeholder: "Select a state",
      allowClear: true
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
      maximumSelectionLength: 4,
      placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>
<!-- /Select2 -->

<?php include 'footer.php'; ?>
