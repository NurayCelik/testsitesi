<?php

include "header.php";
?>
<?php
  if(isset($_GET['proid'])){
    $id = $_GET['proid']; 
 }
 ?>
<?php
$page = new Pages();
$getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Ürünler",$id=3);
  if ($getAbout) {
  	$i=0;
   while ($result = $getAbout->fetch_assoc()) { 

echo '<section>
<div class="parallaxUrun img-responsive" style="background-image: url(\''. $fm->validation($fm->fotoAdDegistir("../","",$result['image'])).'\')">';
}
}


 
echo '</div>
	
<div class="clearfix"></div>
<div class="container">
<div class="row">
			<div class="col col-12 urun_iceriK">
				<div class="firinci_blok">
					<div class="firinci_urun">	
	          <div class="medyaParag">
               <h2 class="urunlerFirst" >Ürünler</h2>
                <h5 class="headMedya">Lezzetler Kategorilerde Gizli</h5>
            </div>
	<ul class="urunler_menu urun_menu_0 urun_menu">';
	$cat      = new Category();
	$takenCat = $cat->getAllCat();
                      if($takenCat)
                      {
                      	$i=0;
                        while($result=$takenCat->fetch_assoc()){
                        	$i++;

	if($i==1){
          echo '<li><div class="col-lg-2 col-md-4 col-sm-4 col-xs-12 urunDiv"><a href="#content'.$i.'" class="active1 same-class">'.$fm->validation($result['catName']).'</a></div></li>';
		}
		else{
		 echo '<li><div class="col-lg-2 col-md-4 col-sm-4 urunDiv"><a href="#content'.$i.'" class="same-class">'.$fm->validation($result['catName']).'</a></div></li>';
		}
       }
       }
		
	echo '</ul>';


?>

<script type="text/javascript">
   $(document).ready(function(){//resimlerin div id sine göre ekrana getirir.
  //HIDE ALL CONTENTS
  //$(".content").hide();
  //EVENT CLICK
  $(".urun_menu a").click(function(event){
   //PREVENT RELOAD
    event.preventDefault();
    
    //HIDE ALL CONTENTS
    $(".content").hide();

    //GET ID FROM NEW CONTENT TO SHOW
    var id_content = $(this).attr("href");
    //SHOW NEW CONTENT
    $(id_content).show();
    
    return false;
  });
});
</script> 
<script type="text/javascript">
	jQuery('.same-class').click(function(){
  jQuery('.same-class').removeClass('active1');
  jQuery(this).addClass('active1');
});
</script>

 <?php

 echo '<ul class="firinci_firindan_menu">';
 $product  = new Product();
$takenName = $product->getDatabase("tbl_category");  // in our product class i create one method with id 
   if ($takenName) {
   	$i=1;
while ($sonuc = $takenName->fetch_assoc()) { 
if($i==1){
echo '<div id="content'.$i.'" class="content">
 <div class="row menu1">';
 $sayi = $product->getAllCount($sonuc['catName']);
   	 if($sayi){ $row = mysqli_fetch_array($sayi,MYSQLI_NUM);
   	 	$boyut= $row[0];
        
  

 $takenProd = $product->getProductCatName($sonuc['catName'],$boyut);  
   if ($takenProd) {

    while ($value = $takenProd->fetch_assoc()) { 

 	echo '
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom_firindan">
  <div class="menu1_icerik">
	<div class="menu1_image_0">
		<div class="menu1_image_0_dis">
			<div class="firinci_menu_dis"></div>
			<a href="urun.php?id='.$fm->validation($value['productId']).'"><img src="'.$fm->validation($fm->fotoAdDegistir("../","",$value['image'])).'" alt="" class="img-circle" width="100%" height="100%" /></a>
		</div>
	</div>
<div class="duzenContent">
<form action="urun.php" method="POST">
<input type="hidden" name="urunNo" value="'.$fm->validation($value['productId']).'">
<button type="submit" style="border:none; list-style-type:none;background-color:white;outline:none;" class="urunlerRengi" name="gonder"><h5>'.$fm->validation($value['productName']).'
</h5></button>
</form>
<p>'.$fm->validation($value['price']).' ₺</p>
</div>
			</div>
		</div>
';
}
}}
echo '</div>
</div>';
}
else
{
	echo '<div id="content'.$i.'"  style="display: none;" class="content">
 <div class="row menu1">';
 $sayi = $product->getAllCount($sonuc['catName']);
   	 if($sayi){ $row = mysqli_fetch_array($sayi,MYSQLI_NUM);
   	 	$boyut= $row[0];
        
  

 $takenProd = $product->getProductCatName($sonuc['catName'],$boyut);   
   if ($takenProd) {

    while ($value = $takenProd->fetch_assoc()) { 

 	echo '
 <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom_firindan">
  <div class="menu1_icerik">
	<div class="menu1_image_0">
		<div class="menu1_image_0_dis">
			<div class="firinci_menu_dis"></div>
			<a href="urun.php?id='.$fm->validation($value['productId']).'"><img src="'.$fm->validation($fm->fotoAdDegistir("../","",$value['image'])).'" alt="" class="img-circle" width="100%" height="100%" /></a>
		</div>
	</div>
<div class="duzenContent">
<form action="urun.php" method="POST">
<input type="hidden" name="urunNo" value="'; echo $fm->validation($value['productId']);
echo '">
<button style="border:none; list-style-type:none; background-color:white; outline:none;" type="submit" name="gonder" class="urunlerRengi"><h5>'.$fm->validation($value['productName']).'
</h5></button>
</form>
<p>'.$fm->validation($value['price']).' ₺</p>
</div>
			</div>
		</div>
';
}
}}
echo '</div>
</div>';
}
$i++;

}
}


?>

</div>
</div>

</div>

</div>
</div>
</div>
 <div class="clearfix"></div>	
</section>
 <div class="clearfix"></div>
 
  <?php

  include "footer.php";
  
  ?>
  