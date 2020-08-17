<div class="firinci_container">
    <div class="row video_sinir">
      <div class="col col-12  video__left_0px">
       <?php 
       echo '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">';
          
          $i=0;
         for($i=0; $i<=2; $i++)
          {
            if($i==0)
              echo '<li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="active"></li>';
            else 
              echo '
            <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
            }
          ?>
          </ol>
          <div class="carousel-inner">
          <?php 
         
          $brand = new Brand();
          $takenSlider = $brand->getAllSlider();
          if($takenSlider)
          {
          $i=0;
          while($result=$takenSlider->fetch_assoc())
          {
            if($i==0){
            echo '<div class="carousel-item active">
              <img class="d-block w-100" src="'.$fm->validation($fm->fotoAdDegistir("../","",$result['image'])).'" alt="First slide" width="1000" height="600">
            </div>';
          }
          else{
          echo '<div class="carousel-item">
              <img class="d-block w-100" src="'.$fm->validation($fm->fotoAdDegistir("../","",$result['image'])).'" alt="Second slide" width="1000" height=600">
            </div>';
          } 
           $i++;
         }
       }
          echo '
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>';
      ?>
          </div>
        </div>
      </div>
    </div>
    
