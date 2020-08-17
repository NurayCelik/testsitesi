<?php
include "header.php";

$page = new Pages();
$fm    = new Format(); 

$getAbout = $page->getFotoName("tbl_menu","menuId","menuName","Medya",$id=5);
  if ($getAbout) {
   while ($result = $getAbout->fetch_assoc()) { 

?>
<section>
  <div class="parallaxMedya img-responsive" style="background-image: url('<?php echo $fm->validation($fm->fotoAdDegistir("../","",$result['image']));?>')">
<?php
}
}
?>
</div>
<div class="clearfix"></div>

<div class="medya">
  <div class="container medyaContainer">
    <div class="row">
      <div class="col-lg-12 padding0">
       <div class="medyaParag">
         <h2 class="medyaFirst"><span>M</span>edya</h2>
          <h5 class="headMedya">Etkinliklerimizden Kareler</h5>
        </div>
      </div>
    </div>
</div>
	<div class="container">
		<div class="row videoSayfa">
			<div class="col-lg-3 col-xs-12 videoDuzen">
				<div class="videoList">
          <h4>Videolar</h4>
          
					<ul class="mdya">

            <?php

            
                    $takenVideo1 = $page->getDatabase("tbl_video","videoId");

                    if($takenVideo1)
                    {
                      $i = 1;
                      while($result=$takenVideo1->fetch_assoc())
                      {
                        if($result['videoDurum']==1)
                        {
                        echo '<li><a href="#video'.$i.'" class="renk">'.$fm->validation($result['videoName']).'</a></li>';
                        
                      }$i++;
                      }
                    }
                      ?>


			        </ul>	
        <script type="text/javascript">
           $(document).ready(function(){//resimlerin div id sine göre ekrana getirir.
          //HIDE ALL CONTENTS
          //$(".content").hide();
          //EVENT CLICK
          $(".mdya a").click(function(event){
           //PREVENT RELOAD
            event.preventDefault();
            
            //HIDE ALL CONTENTS
            $(".videolarim").hide();

            //GET ID FROM NEW CONTENT TO SHOW
            var id_content = $(this).attr("href");
            //SHOW NEW CONTENT
            $(id_content).show();
            
            return false;
           });
         });
        </script>
				</div>
			</div>

			<div class="col-lg-9 col-xs-12 metin">

    
   <?php
  
 

 $takenVideo3 = $page->getDatabase("tbl_video","videoId");

            
            if ($takenVideo3){
            $i=1;
             while($row =$takenVideo3->fetch_assoc()){


                if($i==1){
                echo '<div class="video-header wrap videolarim" id="video'.$i.'">
                      <div class="fullscreen-video-wrap">
                        <video src="'.$fm->validation($fm->fotoAdDegistir("../","",$row['video'])).'"   width="700" height="1000" type="video/mp4" autoplay preload="yes" loop /> 
                        </video>
                      </div>   </div>';

                     
                    }
                    else
                    {
                      echo '<div class="video-header wrap videolarim" style="display:none;" id="video'.$i.'">
                      <div class="fullscreen-video-wrap">
                        <video src="'.$fm->validation($fm->fotoAdDegistir("../","",$row['video'])).'"   width="700" height="1000" type="video/mp4" autoplay preload="yes" loop /> 
                        </video>
                      </div>   </div>';

                      
                    }$i++;
                  }
                    

   }

 

        ?>
      </div>
   </div>
  </div>
</div>
    <div class="clearfix"></div> 

    <?php
 
       $takenMedya = $page->getAllTable("tbl_medya");
        if ($takenMedya) {
        while ($value = $takenMedya->fetch_assoc()) { 
    ?>

<div class="container-fluid wrapperContainer">
  <div class="row">
    <div class="col-md-12 mediaEdit">
      <header class="medyaGecis">
        <div class="medyaFirst0" >
          <img class="medyaFirst0Img responsive" width="1500" height="500" src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$value['image'])); ?>" />
        </div>
        <div class="medyaFirstWrapper">
          <hgroup class="medyaGroup0">
            <h3 class="medyahead0"><?php echo $fm->validation($value['ortaBaslik']); ?></h3>
            <h2 class="medyaSecond0"><?php echo $fm->validation($value['ortaAltBaslik']); ?></h2>
          </hgroup>
        </div>
      </header>
    </div>
  </div>
</div>
<?php
        }
  }
?>
<div class="clearfix"></div>
<div class="container">
  <div class="medyaHaber">
    <div class="medyaAltBlok">
      <div class="row">
        
          <?php

          $takenHaber = $page->getDatabase("tbl_haber","haberId");
          if($takenHaber){
            $i=1;
             while($row =$takenHaber->fetch_assoc()){
            if($row['haberDurum']==1){
            
              if($i==1){
                 echo '<div class="col-lg-8 medyaSol haberci" id="haberci'.$i.'">';
              
                echo '
                <h3>'.$row['haberBaslik'].'</h3>
                <h6><time>'.$fm->formatDateOnly($row['haberTarih']).' / </time><span>'.$fm->validation($row['haberKaynak']).'</span></h6>
                 
                 <div class="bilgi" id="bilgi">';
                  $foto = $fm->validation($fm->fotoAdDegistir("../","",$row['image']));
                  $text = $fm->validation(stripslashes($row['haberDetay']));
                  $text = $fm->format_punc($text);
                  $fm->cumleAdediBelirleFotoyaGore($text,"haberFoto",$foto, 2);
              
           echo '</div>
          </div>';
     
      }
      else
      {
           echo '<div class="col-lg-8 medyaSol haberci" style="display:none;" id="haberci'.$i.'">
            <h3>'.$row['haberBaslik'].'</h3>
            <h6><time>'.$fm->formatDateOnly($row['haberTarih']).' / </time><span>'.$fm->validation($row['haberKaynak']).'</span></h6>
             
             <div class="bilgi" id="bilgi">';
              
                  $foto = $fm->validation($fm->fotoAdDegistir("../","",$row['image']));
                  $text = $fm->validation(stripslashes($row['haberDetay']));
                  $text = $fm->format_punc($text);
                  $fm->cumleAdediBelirleFotoyaGore($text,"haberFoto",$foto, 2);
              
           echo '</div>
          </div>';
      }
      $i++;
    }
  }
      
      }  
     
      
     ?>
        <div class="col-lg-4 col-sm-12 col-xs-12 haberler">
          <div class="medyaSag">
            <h5>Basında Lezzet Cafe</h5>
            
              <div class="haber">
              <ul class="hbrMedya">
                <div class="wrapper">
                  <div class="sliding-background" >
                   <?php

            
                    $takenHaber = $page->getDatabase("tbl_haber","haberId");

                    if($takenHaber)
                    {
                      $i = 1;
                      while($result=$takenHaber->fetch_assoc())
                      {
                        if($result['haberDurum']==1)
                        {
                   echo '<li><a href="#haberci'.$i.'">'.$fm->validation($result['haberBaslik']).'</a></li>';
                    
                  }
                  $i++;
                }
              }
                ?>
                    
                  </div>  
                </div>
              </ul>
            </div>
           </div>
          </div>
          
        </div>
       </div> 
       <script type="text/javascript">
           $(document).ready(function(){//resimlerin div id sine göre ekrana getirir.
          //HIDE ALL CONTENTS
          //$(".content").hide();
          //EVENT CLICK
          $(".hbrMedya a").click(function(event){
           //PREVENT RELOAD
            event.preventDefault();
            
            //HIDE ALL CONTENTS
            $(".haberci").hide();

            //GET ID FROM NEW CONTENT TO SHOW
            var id_content = $(this).attr("href"); //a href  id yi çalıştır haberci.$i 
            //SHOW NEW CONTENT
            $(id_content).show();
            
            return false;
           });
         });
        </script>
      
    </div>
   </div>
</div>
  
<div class="clearfix">
<div id="gallery">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 padding0">
       <div class="medyaParag1">
        <?php
 
       $takenMedya = $page->getAllTable("tbl_medya");
        if ($takenMedya) {
        while ($value = $takenMedya->fetch_assoc()) { 
  
         echo '<h3 class="medyaFirst1">'.$fm->validation(stripslashes($value['altBaslik'])).'</h3>
         <h5 class="medyaSecond"><i class="fa fa-instagram iconInstagram" aria-hidden="true"></i>'.$fm->validation(stripslashes($value['takipci'])).'</h5>';

      }
      }
      ?>
        </div>
      </div>
    </div>
    <div class="row">
<?php
 
       $takenMedya = $page->getDatabase("tbl_instagaleri","instagramId ");
        if ($takenMedya) {
          $i=1;
        while ($row = $takenMedya->fetch_assoc()) { 
          if($i%5==0)
          {
            echo '<div class="w-100"></div>';
          }


   
?>         <div class="col-sm-3 col-md-3 col-lg-3">
              <div class="gallery-item"> <img src="<?php echo $fm->validation($fm->fotoAdDegistir("../","",$row['image'])); ?>" class="img-responsive" alt=""></div>
            </div>
<?php
}
}
?>
            
    </div>
  </div>
</div>
<div class="clearfix"></div>

</section>
<div class="clearfix"></div>

  <?php

  include "footer.php";
  
  ?>
  