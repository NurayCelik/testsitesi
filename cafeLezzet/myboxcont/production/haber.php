<?php 
include 'header.php';
include '../../classes/Pages.php'; 
include '../../classes/Pagina.php'; 

 $fm    = new Format(); 
 $page  =  new Pages(); 
 $pg    = new Pagina(4);

 if (isset($_GET['deletedhaber']) && isset($_GET['imagedeleted']) && isset($_GET['name'])) {
   $id = $_GET['deletedhaber'];
   $columnName = $_GET['imagedeleted'];
   $columnIdName = $_GET['name'];
   $delarsiv = $page->delItemById("tbl_haber", $columnIdName, $columnName, $id);
} 
if (isset($_GET['delvideo'])) {
   $id = $_GET['delvideo'];
   $delvideo = $page->delItemById("tbl_video", "videoId", "video", $id);
} 
?>






<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">


    </div>

    <div class="col-md-12">
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <form action="" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" name="aranan" placeholder="Haber Bilgileri Sorgula...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="arama">Ara!</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
             <div align="left" class="col-md-6">
              <h2>Haber İşlemleri <small>
                <?php
                 if (isset($deletedhaber)) {
                  echo  $deletedhaber;
                 }
                 $kayitliHaber = $pg->satirSayiBul("tbl_haber",'haberId');
                 $row = mysqli_fetch_array($kayitliHaber,MYSQLI_NUM);
                 $kayitSayisi = $row[0];
                 if ($kayitSayisi)
                  echo 'Toplam <span style="color:#d9534f;">'.$kayitSayisi." </span>Haber Kayitli";
              ?>
                
              </small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                <a href="haberekle.php"><button  class="btn btn-danger "><i class="fa fa-plus" aria-hidden="true"></i> Yeni Ekle</button></a>
              </div>
              <div class="clearfix"></div>
            </div>


            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">

                      <th class="column-title text-center">Haber Sıra</th>
                      <th class="column-title text-center">Haber Başlık</th>
                      <th width="200" class="column-title text-center">Haber İmage</th>
                      <th class="column-title text-center">Haber Durum</th>
                      <th class="column-title text-center">Haber Tarih</th>
                      <th width="80" class="column-title"></th>
                      <th width="80" class="column-title"></th>


                    </tr>
                  </thead>

                  <tbody>

                    
                    <?php 
                    
                    if(!isset($_POST['arama'])) {
                    
                    $takenHaber = $pg->pagination_one('tbl_haber','haberId');
                    while($result=$takenHaber->fetch_assoc())
                      {
                        if($result){
                   
                     ?>


                      <tr>

                        <td class="text-center"><?php echo $result['haberSira']; ?></td>
                        <td class="text-center"><?php echo $fm->validation($result['haberBaslik']); ?></td>
                        <td class="text-center"><img width="200" height="100" src="<?php echo $result['image']; ?>"></td>
                       <td class="text-center"><?php 

                         if ($result['haberDurum']=="1") {

                          echo "AKTİF";
                        } else {

                         echo "PASİF";
                    }

                        ?></td>
                        <td class="text-center"><?php echo $fm->validation($fm->formatDateOnly($result['haberTarih'])); ?></td>
                        
                        <td class="text-center"><a href="haberduzenle.php?haberduzenle=<?php echo $result['haberId']; ?>&columnIdName=haberId"><button style="width:80px;" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</button></a></td>
                        
                        <td class="text-center"><a onclick="return confirm('Are you sure to delete')" href="?deletedhaber=<?php echo $result['haberId']; ?>&imagedeleted=image&name=haberId"><button style="width:80px;" class="btn btn-danger btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Sil</button></a></td>

                      </tr></tbody>

                      <?php  }  } 
                     
                 ?>
                <tbody><tr><div class="col-md-12 text-center"><ul class="pagination ">
                <?php echo $pg->pagination_two(); ?>
                  
                </ul>
                 </div></tr></tbody>
                                            
                <?php                 

                }          
                else {
                       $aranan=$_POST['aranan'];

                      $bulunan=$pg->itemByMultiSearch('tbl_haber','haberBaslik','haberDetay','haberTarih',$aranan); 

                       if($bulunan)
                        {
                          $i=0;
                          while($sonuc=$bulunan->fetch_assoc()){
                            $i++;
                            ?>
                   <tbody> <tr>

                         <td class="text-center"><?php echo $sonuc['haberSira']; ?></td>
                         <td width="10%" class="text-center"><?php echo $fm->validation($sonuc['haberBaslik']); ?></td>
                         <td class="text-center"><img width="200" height="100" src="<?php echo $sonuc['image']; ?>"></td>
                         <td class="text-center"><?php 

                            if($sonuc['haberDurum']=="1") {

                             echo "AKTİF";
                           } else {

                            echo "PASİF";
                          }

                          ?></td>
                          <td class="text-center"><?php echo $fm->validation($fm->formatDateOnly($sonuc['haberTarih'])); ?></td>

                          <td class="text-center"><a href="haberduzenle.php?haberduzenle=<?php echo $sonuc['haberId']; ?>&columnIdName=haberId"><button style="width:80px;" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Düzenle</button></a></td>

                          <td class="text-center"><a onclick="return confirm('Are you sure to delete')" href="?deletedhaber=<?php echo $sonuc['haberId']; ?>&imagedeleted=image&name=haberId"><button style="width:80px;" class="btn btn-danger btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Sil</button></a></td>

                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                      ?>
                      <tr>
                      <td width="80" class="text-center"></td>
                      <td width="100%" class="text-center">Aradığınız <renk style="color:red; font-size: 20px"><?php echo $aranan; ?></renk> bulunamadı! </td>
                      <td width="" class="text-center"></td>
                      <td width="" class="text-center"></td>
                      <td width="" class="text-center"></td>
                      <td width="" class="text-center"><a href="haber.php"><button style="width:80px; height:35px;" class="btn btn-primary btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button></a>
                      </td>
                      </tr>
                    <?php
                    }
                  }
                  ?>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->



    <?php include 'footer.php'; ?>
