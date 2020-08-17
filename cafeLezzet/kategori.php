<?php
include "header.php";

$page     = new Pages();
$getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Kategori",$id=11);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) {

?>
<section>
<div class="parallaxUrun img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>');">
<?php
}
}
?>
</div>
<div class="clearfix"></div>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST))
    {
     switch (true) {
       case ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gonder']) && isset($_POST['islem'])) :
         $id = $_POST['islem'];
         break;
       case ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gonder1']) && isset($_POST['islemSearch'])) :
         $id = $_POST['islemSearch'];  
         break;
       
       default:
         echo "";
         break;
                    }
    }
    
 
?>  

 <div class="urunAilesi">
   	<div class="container-fluid">
   		<div class="row">
   			<div class="col-md-12">
   				<div class="ustParag"> 
            <div class="row urunSinir">
   						<?php 
                $product  = new Product();
                $getPd = $product->getMultiProduct(@$id);  
                if ($getPd){
                  $i = 0;
                  while ($result = $getPd->fetch_assoc()) { 
               ?> 
                    
                    <div class="col-lg-4 boyutImg1">
                      <div class="urunImg queryImg">
                       <p>
                         <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image'])); ?>" class="img-responsive" width="220" height="280">
                       </p>
                       <p>
                        <?php
                        if(strlen($fm->validation($result['imageYedek'])>0)){

                        ?>
                          <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['imageYedek'])); ?>"  class="img-responsive" width="220"  height="280">
                          <?php
                        }
                        else
                        {
                        ?>

                          <img src="upload/site/resimtedarik.jpg"  class="img-responsive" width="220"  height="280">
                        <?php
                        }
                        ?>
                       </p> 
                      </div>
                    </div>
                     <div class="clearfix"></div>
                    <div  class="col-lg-6 boyutParag1">
                      <div class="urunParag">
                       <h3 class="urunFirst"><span style="color: #4c8dd6 !important;"><?php echo $fm->validation($result['catName']); ?></span></h3>
                        <h2 class="urunSecond"><?php echo $fm->validation($result['productName']); ?></h2>
                        <div class="separator_flower"style="color: #4c8dd6 !important;">✻</div>
                        <?php
                          
                          $fm->cumleAdediBelirleParagrafta($fm->validation($result['body']),"topedit",3);
                          
                          ?>

                      </div>
                      </div>

                
                   
                     <?php 
                    }
                  } 
                 ?>         
                    <div class="col-lg-2  classRemove" style="right: 0;top: 200px; margin-top: 0;position: absolute;">
                        <div class="urun Category">
                          <h5>Kategoriler</h5>
                           <ul>
                          <?php                            
                               $getPd = $product->getDatabase("tbl_category");  
                              if ($getPd){
                                $i=0;

                                while ($value = $getPd->fetch_assoc()) { 
                                echo '<li><form action="kategori.php" method="POST">
                                <input type="hidden" name="islem" value="'; echo $fm->validation($value['catId']);
                                echo '"><button type="submit" name="gonder" class="urunlerCategoryReal">'.$fm->validation($value['catName']).'
                                </button>
                                </form></li>';
                                                                
                            }
                           } ?>   
                        </ul>
                                       
                                       </div>
                                      </div>    

                                    </div>
                                 </div>
                             </div>
                            </div>
                       </div>   
                    </div>
            







 
</section>
<div class="clearfix"></div>
  <?php

  include "footer.php";
  
  ?>
  