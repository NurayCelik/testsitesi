<?php
include "header.php";

?>
<section>
  <?php
  $page = new Pages();
    $getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Hakkımızda",$id=2);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) { 
 ?>
  
<div class="parallaxAbout img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>')">
  <?php
}
}

$getAbout = $page->getAllTable("tbl_hakkimizda");
  if ($getAbout) {
   while ($value = $getAbout->fetch_assoc()) { 
?> 

</div>
   <div class="clearfix"></div>
   <div class="lezzet_ailesi">
   	<div class="container-fluid">
   		<div class="row">
   			<div class="col-md-12">
   				<div class="ust_paragraf">
   						
                    <div class="row aboutSinir">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                      <div class="aboutImg">
                       <p>
                         <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['image1'])); ?>"  class="img-responsive" width="420" height="280">
                       </p>
                       <p>
                          <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['image2'])); ?>"  class="img-responsive" width="420" height="280">
                       </p> 
                      </div>
                    </div>
                    <div  class="col-lg-6 col-md-12 col-sm-12">
                      <div class="aboutParag">
                       <h3 class="headFirst"><?php echo $fm->validation($value['ustBaslik']); ?></h3>
                        <h2 class="headSecond"><?php echo $fm->validation($value['baslik']); ?></h2>
                        <div class="separator_flower">✻</div>
                        <?php

                        for($i=1;$i<4; $i++){

                          echo '<p>
                            '.$fm->validation($value['icerik'.$i.'']).'
                          </p>';
                        }
                          ?>
                         
                      </div>
                  </div>
                </div>
					</div>
   				</div>
     </div>   
	</div>
</div>

    <div class="clearfix"></div> 
<!--✻ #9a9998 separator ve yazı rengi beyaz üzerine-->
		<div class="container-fluid lezzetContainer">
      <div class="row">
  			<div class="col-md-12">
				
        <header class="aboutAri">
          <div class="aboutFirst">
            <img class="aboutFirstImg" width="1500" height="500" src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['imageOrta'])); ?>" />
          </div>
          <div class="aboutFirstWrapper">
          <hgroup class="headerGroup">
              <h3 class="headFirst"><?php echo $fm->validation($value['ortaBaslik1']); ?></h3>
              <h2 class="headSecond"><?php echo $fm->validation($value['ortaBaslik2']); ?></h2>
          </hgroup>
        </div>
        </header>

</div>
</div>
</div>

<div class="clearfix"></div>
  <div class="son_ekip"> 
   <div class="container">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="row grid_row">
    		<div class="col col-12 grid_col">
          <div class="ustBlok">
            <?php
            for($i=1;$i<4;$i++){
              echo '<h3>'.$fm->validation($value['altBaslik'.$i.'']).' </h3>
              <div class="separator_flower">✻</div>
              <p><span>'.$fm->validation($value['altIcerik'.$i.'']).'</span></p>
              ';
          }

          ?>
            
          </div>
          <div class="ustBlok1">
            <div class="gridBlok">
              <?php
            for($i=1;$i<4;$i++){
              echo '<p>
                <img src="'.$fm->validation($fm->fotoAdDegistir("../","",$value['altImage'.$i.''])).'" class="img-responsive" width="320" height="260">
              </p>
              ';
          }

          ?>
           
              
            </div>
          </div>
      	</div>
      </div>
    </div>
  </div>
</div>
</section>
<?php
    }
  }
?>
<div class="clearfix"></div>
  <?php

  include "footer.php";
  
  ?>
  