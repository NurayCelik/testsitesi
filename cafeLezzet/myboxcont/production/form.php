<?php 

include 'header.php';
include '../../classes/Maillerform.php';
include_once '../../helpers/Format.php';
include '../../classes/Pagina.php';  
 

$pg   = new Pagina(10);
$fm   = new Format();
$form = new Maillerform();
?>

<?php
 if (isset($_GET['silinenMesaj'])) {
   $id = $_GET['silinenMesaj'];
   $deletedMessage = $form->delFormById($id);
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
              <input type="text" class="form-control" name="aranan" placeholder="Ad Soyad Konu Telefon Email Ara...">
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
              <h2 >Form İşlemleri <small>
                <?php
                 if (isset($deletedMessage)) {
                  echo  $deletedMessage;
                 }
                 $kayitliMesaj = $pg->satirSayiBul("tbl_form","formId");
                 $row = mysqli_fetch_array( $kayitliMesaj,MYSQLI_NUM);
                 $kayitSayisi = $row[0];
                 if ($kayitSayisi)
                  echo 'Toplam <span style="color:#d9534f;">'.$kayitSayisi." </span>Mesaj Kayitli";
               ?></small></h2><br>
              </div>
              <div align="right" class="col-md-6">
                
              </div>
              <div class="clearfix"></div>
            </div>


            <div class="x_content">
              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th class="column-title text-center">Sıra</th>
                      <th class="column-title text-center">Tarih</th>
                      <th class="column-title text-center">Ad Soyad</th>
                      <th class="column-title text-center">Telefon</th>
                      <th class="column-title text-center">Email</th>
                      <th class="column-title text-center">Mesaj</th>
                      <th width="80" class="column-title"></th>
                      


                    </tr>
                  </thead>

                  <tbody>

                    <?php
                    if(!isset($_POST['arama'])) {

                     $takenForm= $pg->pagination_one('tbl_form','formId'); 
                     if ($takenForm) {
                      $i = 0;
                    while ($result = $takenForm->fetch_assoc() ) {
                      $i++;
                   ?>
                      

                      <tr>
                        <td width="1%" class="text-center"><?php echo $i; ?></td>
                        <td width="5%" class="text-center"><?php echo $fm->validation($fm->formatDateTurk($result['tarih'])); ?></td>
                        <td width="10%" class="text-center"><?php echo $fm->validation($result['ad']); ?> <?php echo $fm->validation($result['soyad']); ?></td>
                        <td width="11%" class="text-center"><?php echo $fm->validation($result['telefon']); ?></td>
                        <td width="5%" class="text-center"><?php echo $fm->validation($result['email']); ?></td>
                        <td width="59%" class="text-center" ><?php echo $fm->validation($result['mesaj']); ?></td>
                        
                        <td width="5%" class="text-center"><a href="?silinenMesaj=<?php echo $result['formId']; ?>"><button style="width:80px;" class="btn btn-danger btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Sil</button></a></td>
                       </tr>
                  </tbody>

                  <?php

  
                   }
                  }
                  ?>
                 <tbody><tr><div class="col-md-12 text-center"><ul class="pagination ">
                <?php echo $pg->pagination_two(); ?>
                  
                </ul>
                 </div></tr></tbody>
                                            
                <?php                 

                }          
                else {
                      $aranan=$_POST['aranan'];

                      $bulunan=$form->formBySearch($aranan); 

                       if($bulunan)
                        {
                          $i=0;
                          while($sonuc=$bulunan->fetch_assoc()){
                            $i++;
                            ?>
                        <tr>
                        <td width="1%" class="text-center"><?php echo $i; ?></td>
                        <td width="5%" class="text-center"><?php echo $fm->validation($fm->formatDateTurk($sonuc['tarih'])); ?></td>
                        <td width="10%" class="text-center"><?php echo $fm->validation($sonuc['ad']); ?> <?php echo $fm->validation($sonuc['soyad']); ?></td>
                        <td width="11%" class="text-center"><?php echo $fm->validation($sonuc['telefon']); ?></td>
                        <td width="5%" class="text-center"><?php echo $fm->validation($sonuc['email']); ?></td>
                        <td width="59%" class="text-center" ><?php echo $fm->validation($sonuc['mesaj']); ?></td>
                        
                        <td width="5%" class="text-center"><a onclick="return confirm('Are you sure to delete')" href="?silinenMesaj=<?php echo $sonuc['formId']; ?>"><button style="width:80px;" class="btn btn-danger btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Sil</button></a></td>
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
                      <td width="" class="text-center"><a href="form.php"><button style="width:80px; height:35px;" class="btn btn-primary btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Geri Dön</button></a>
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
