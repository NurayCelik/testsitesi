<?php 
$filepath= realpath(dirname(__FILE__));//http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken diğer bölümler erişemiyor.
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>
 
<?php
class Pages{
	private $db;  // I crate Property for Database Class
	private $fm; // I crate Property for Format Class  
 
    public function __construct(){
       $this->db   = new Database(); // I crate Object for Database Class
       $this->fm   = new Format(); // I crate Object for Format Class  
	}


public function getAllTable($table){ 
        $query = "SELECT * FROM $table";
         $result = $this->db->select($query);
         return $result; 
       }
        public function getDatabase($table,$tableId){
         $query = "SELECT * FROM $table order by $tableId";
         $result = $this->db->select($query);
         return $result;
     }
 public function getDatabaseLimit($table,$column,$sira){
         $query = "SELECT * FROM $table where $column='$sira'";
         $result = $this->db->select($query);
         return $result;
     }

      public function delImageId($id,$tableName,$tableId,$column){
      $query = "SELECT * FROM $tableName WHERE $tableId ='$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
            
           $dellink = $delImg[$column];
            @unlink($dellink);
          }
            }
     }


 public function aboutTopUpdate($data)
     { 
   
      $ustBaslik   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['ustBaslik'] )));
      $baslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['baslik'] ))));
      $icerik1     =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['icerik1'] )));
      $icerik2     =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['icerik2'] )));
      $icerik3     =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['icerik3'] )));
      
      if ($ustBaslik == "" || $baslik == "" || $icerik1 == "" || $icerik2 == "" || $icerik3 == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı.</span> ";
          return $msg;
     }else {
    
     try{
	    
        $query = "UPDATE tbl_hakkimizda
            SET
            ustBaslik  = '$ustBaslik',
            baslik     = '$baslik',
            icerik1    = '$icerik1',
            icerik2    = '$icerik2',
            icerik3    = '$icerik3'
          WHERE hakkimizdaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Hakkimizda Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Hakkimizda Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    
   catch(Exception $e)    
    {
      die($e->getMessage());
   		 }
	}  
}
	 public function aboutMiddleUpdate($data)
     { 
      $ustBaslik   =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['ortaBaslik1'] ))));
      $baslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['ortaBaslik2'] ))));
 	
 	   $permited = array('jpg','png','jpeg','gif');
	    
    
      if ($ustBaslik == "" || $baslik == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
    
     try{
	
        $query = "UPDATE tbl_hakkimizda
            SET
            ortaBaslik1  = '$ustBaslik',
            ortaBaslik2	 = '$baslik'
          WHERE hakkimizdaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Hakkimizda Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Hakkimizda Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
   

   catch(Exception $e)    
    {
      die($e->getMessage());
   		 }
	}  
}


public function aboutEndUpdate($data){ 
    $altBaslik1      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altBaslik1'] ))));
      $altIcerik1      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altIcerik1'] ))));
      $altBaslik2      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altBaslik2'] ))));
      $altIcerik2      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altIcerik2'] ))));
      $altBaslik3      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altBaslik3'] ))));
      $altIcerik3      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altIcerik3'] ))));
 	
 	  $permited = array('jpg','png','jpeg','gif');
	    
    
      if ($altBaslik1 == "" || $altIcerik1 == "" || $altBaslik2 == "" || $altIcerik2 == "" || $altBaslik3 == "" || $altIcerik3 == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
    
     try{
        $query = "UPDATE tbl_hakkimizda
            SET
            altBaslik1   = '$altBaslik1',
            altIcerik1	 = '$altIcerik1',
            altBaslik2   = '$altBaslik2',
            altIcerik2	 = '$altIcerik2',
            altBaslik3   = '$altBaslik3',
            altIcerik3	 = '$altIcerik3'
          WHERE hakkimizdaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Hakkimizda Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Hakkimizda Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    

   catch(Exception $e)    
    {
      die($e->getMessage());
   		 }
	}  
}


  
  public function ekleTable($tableName, $columnName, $value){
    $query = "INSERT INTO $tableName($columnName)
               VALUES('$value')";
              $inserted_row= $this->db->insert($query);
            if ($inserted_row) {
            $msg = "<span class='success'>$tableName Ekleme Başarılı.</span> ";
            return $msg;
          }else {
            $msg = "<span class='error'>$tableName Eklenmedi!</span> ";
            return $msg;
          }
      }





  public function mainTopUpdate($data)
    { 
      $markaBaslik1   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['markaBaslik1'] )));
      $markaBaslik2   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['markaBaslik2'] )));
  
     if ($markaBaslik1 == "" || $markaBaslik2 == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
      try{
    
        $query = "UPDATE tbl_anasayfa
            SET
            markaBaslik1  = '$markaBaslik1',
            markaBaslik2  = '$markaBaslik2'
          WHERE anasayfaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = " <span class='success'>Anasayfa Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Anasayfa Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
}
    
 

   catch(Exception $e)    
    {
      die($e->getMessage());
       }
  }  
}
 public function UpdateFoto($file, $column, $table, $tableId, $klasor){
  
  $permited = array('jpg','png','jpeg','gif');
 
  try{
    
        $file_name  =  $file[$column]['name'];
        $file_size  =  $file[$column]['size'];
        $file_temp  =  $file[$column]['tmp_name'];
        $file_type  =  $file[$column]['type']; 
         
        $div= explode('.', $file_name);
        $file_ext = strtolower(end($div));

        $uploaded_image= '../../upload/'.$klasor.'/'.substr(md5(uniqid(rand(1,6))), 0, 8).'.'.$file_ext;
        
        if (!empty($file_name)) {

         if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
          exit();
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          exit();
          } else{
               $id=1;
              $this->delImageId($id, $table, $tableId, $column);
              move_uploaded_file($file_temp, $uploaded_image);
              
          $query = "UPDATE $table
              SET 
              $column        = '$uploaded_image'
              
              WHERE  $tableId =  '1' ";
          
            $updated_row = $this->db->update($query);
            if ($updated_row) {
            $msg = "<span class='success'> Güncelleme Başarılı.</span> ";
            return $msg;
          }else {
            $msg = "<span class='error'> Güncellenmedi!</span> ";
            return $msg;
          } 
     }    
   }
 }
   catch(Exception $e)    
    {
      die($e->getMessage());
    }
}

  public function getFotoName($table,$tableId, $column, $name,$id){
      $query = "SELECT * FROM $table WHERE $column ='$name' AND $tableId ='$id' ";
         $result = $this->db->select($query);
         return $result;
     }




public function mainMiddleUpdate($data)
      {
      $hakBaslik   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['hakBaslik'] )));
      $hakIcerik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['hakIcerik'] ))));
      $hakhref   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['hakhref'] )));
      $kaliteBaslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['kaliteBaslik'] ))));
      $kaliteIcerik   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['kaliteIcerik'] )));
      $hizliBaslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['hizliBaslik'] ))));
      $icerikHizli   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['icerikHizli'] )));
      $dogalBaslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['dogalBaslik'] ))));
      $icerikDogal   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['icerikDogal'] )));
      
  
    $permited = array('jpg','png','jpeg','gif');
      
    
      if($hakBaslik == "" || $hakIcerik == "" || $hakhref == "" || $kaliteBaslik == "" || $kaliteIcerik == "" || $hizliBaslik == "" || $icerikHizli == "" || $dogalBaslik == "" || $icerikDogal == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
   try{
        $query = "UPDATE tbl_anasayfa
            SET
            hakBaslik      = '$hakBaslik',
            hakIcerik      = '$hakIcerik',
            hakhref        = '$hakhref',
            kaliteBaslik   = '$kaliteBaslik',
            kaliteIcerik   = '$kaliteIcerik',
            hizliBaslik    = '$hizliBaslik',
            icerikHizli    = '$icerikHizli',
            dogalBaslik    = '$dogalBaslik',
            icerikDogal    = '$icerikDogal'
          WHERE anasayfaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Anasayfa Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Anasayfa Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    
  catch(Exception $e)    
    {
      die($e->getMessage());
       }
  }  
}
public function mainEndUpdate($data)
    {
      $servisBaslik   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['servisBaslik'] )));
      $servisIcerik1      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['servisIcerik1'] ))));
      $servisHref1   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['servisHref1'] )));
      $servisIcerik2   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['servisIcerik2'] )));
      $servisHref2   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['servisHref2'] )));
      
  
    $permited = array('jpg','png','jpeg','gif');
      
    
      if($servisBaslik == "" || $servisIcerik1 == "" || $servisHref1 == "" || $servisIcerik2 == "" || $servisHref2 == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
    
     try{

        $query = "UPDATE tbl_anasayfa
            SET
            servisBaslik   = '$servisBaslik',
            servisIcerik1  = '$servisIcerik1',
            servisHref1    = '$servisHref1',
            servisIcerik2  = '$servisIcerik2',
            servisHref2    = '$servisHref2'
          WHERE anasayfaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Anasayfa Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Anasayfa Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
   

   catch(Exception $e)    
    {
      die($e->getMessage());
       }
  } 
}
   

    

  public function delArsivById($id){
       $query = "SELECT * FROM tbl_fotoarsiv WHERE arsivId = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg['image'];
                  unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM tbl_fotoarsiv WHERE arsivId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Arsiv Başarılı Silindi.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Arsiv Silinmedi!</span> ";
                 return $msg;
              } 
    }
    public function cateringUpdate($data)
    {
      $baslik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['baslik'] ))));
      $altBaslik   =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['altBaslik'] ))));
      $icerik      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['icerik'] ))));
      if ($baslik == "" || $altBaslik == "" || $icerik == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı.</span> ";
          return $msg;
     }else {
    
     try{
     $query = "UPDATE tbl_catering
            SET
            baslik     = '$baslik',
            altBaslik  = '$altBaslik',
            icerik     = '$icerik'
           
          WHERE cateringId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Catering Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Catering Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        } 
     
 
    
    catch(Exception $e)    
    {
      die($e->getMessage());
       }
  }  

}

      public function galeriCateringInsert($data, $file){

     $sira    =  mysqli_real_escape_string($this->db->link, $data['sira']);
      
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
  
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $inserted_image = "../../upload/galericatering/".$unique_image;
 
     
     if ($sira == "") {
      $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
          return $msg;
     }else{ 

      if(!empty($file_name)) {
     
     if($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
          move_uploaded_file($file_temp, $inserted_image);
          $query = "INSERT INTO tbl_galericatering(sira, image) 
          VALUES ('$sira','$inserted_image')";  
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
             header("refresh:2; url=cateringfoto.php");
          $msg = "<span class='success'>Foto Başarılı Eklendi.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Foto Eklenmedi!</span> ";
          return $msg; // return message 
        } 
     }


    }
}
}
    public function getItemById($table,$columnIdName,$id){
      date_default_timezone_set('Europe/Istanbul');
      $query = "SELECT * FROM $table WHERE $columnIdName ='$id' ";
             $result = $this->db->select($query);
             return $result;
   }

     public function ItemBySearch($table, $column, $search){
      $query = "SELECT * FROM $table WHERE $column LIKE '%$search%'";
     $result = $this->db->select($query);
     return $result;
  }

    public function cateringFotoUpdate($data, $file, $id){
 
    $sira   =  mysqli_real_escape_string($this->db->link, $data['sira'] );
   
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/galericatering/".$unique_image;
     if ($sira == "") {
     $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
        return $msg;
     }else {

     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz!</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece ".implode(',', $permited)."uzantılı dosyaları yükleyebilirsiniz!</span>";
      } else{
               $columnName='image';
               $tName='tbl_galericatering';
               $columnId='galericateringId';
              $this->delImageId($id,$tName,$columnId,$columnName); 

          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_galericatering 
          SET 
          sira   = '$sira',
          image  = '$uploaded_image'
          
          WHERE galericateringId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=cateringfoto.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_galericatering 
          SET 
          sira   = '$sira'
          WHERE galericateringId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=cateringfoto.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }

    public function delItemById($table, $columnId, $column, $id){
       $query = "SELECT * FROM $table WHERE $columnId = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg[$column];
                  @unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM $table WHERE $columnId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>İsteğiniz Başarılı Silindi.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>İsteğiniz Silinmedi!</span> ";
                 return $msg;
              } 
    }
   
public function videoById($table, $tableId, $id,$column,$value){
     $newId  =  mysqli_real_escape_string($this->db->link, $id);
     $query = "SELECT * FROM $table WHERE $tableId='$newId' and $column= '$value'";
             $result = $this->db->select($query);
             return $result; 
 }
 public function videoOnlySira($table, $column, $no){
     $query = "SELECT * FROM $table WHERE $column ='$no'";
             $result = $this->db->select($query);
             return $result; 
 }
 public function videoInsert($data, $file){

      $videoName    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['videoName'])));
      $videoLink    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['videoLink'])));
      $videoSira    =  mysqli_real_escape_string($this->db->link, $data['videoSira']);
      $videoDurum   =  mysqli_real_escape_string($this->db->link, $data['videoDurum']);
      $permited = array('mp3','MP3','mp4','MP4','wma');

       $file_name = basename($file['video']['name']);
       $file_size = $file['video']['size'];
       $file_temp = $file['video']['tmp_name'];
       $file_type = $file['video']['type'];

       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_video = substr(md5(time()), 0, 10).'.'.$file_ext;
       $inserted_video= "../../upload/video/".$unique_video;
      
      if ($videoName == "" || $videoLink == "" || $videoSira == "" || $videoDurum == "") {
          $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
              return $msg;
         }else{
           
          if ($file_size > 134217728 ) {
            echo "<span class='error'>128 MB den büyük video yükleyemezsiniz!</span>".$file['video']['error'];
           }elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>".$file['video']['error'];
            } 
            
            else{
           
            move_uploaded_file($file_temp, $inserted_video);
            $query = "INSERT INTO tbl_video (videoName, video, videoLink, videoSira, videoDurum) 
            VALUES ('$videoName','$inserted_video','$videoLink','$videoSira','$videoDurum')";  
   
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
               header("refresh:2; url=video.php");
            $msg = "<span class='success'>Video Başarılı Eklendi.</span> ";
            return $msg; // return message 
          }else {
            $msg = "<span class='error'>Video Eklenmedi!</span> ";
             } 

     }


    }

}

    public function videoUpdate($data, $file, $id){
 
      $videoName    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['videoName'])));
      $videoLink    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['videoLink'])));
      $videoSira    =  mysqli_real_escape_string($this->db->link, $data['videoSira']);
      $videoDurum   =  mysqli_real_escape_string($this->db->link, $data['videoDurum']);
      
      $permited = array('mp3','MP3','mp4','MP4','wma');
      $file_name = basename($file['video']['name']);
      $file_size = $file['video']['size'];
      $file_temp = $file['video']['tmp_name'];
      $file_type = $file['video']['type'];
   
       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_video = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_video = "../../upload/video/".$unique_video;
      
        if ($videoName == "" || $videoLink == "" || $videoSira == "" || $videoDurum == "") {
            $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
                return $msg;
           }else{
 
    
     if (!empty($file_name)) {
     if ($file_size > 134217728) {
      echo "<span class='error'>128 MB den büyük video yükleyemezsiniz!</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
               $columnName='video';
               $tName='tbl_video';
               $columnId='videoId';
              $this->delImageId($id,$tName,$columnId,$columnName);

          move_uploaded_file($file_temp, $uploaded_video);
          $query = "UPDATE tbl_video
          SET 
          videoName   = '$videoName',
          video       = '$uploaded_video',
          videoLink   = '$videoLink',
          videoSira   = '$videoSira',
          videoDurum  = '$videoDurum'
          WHERE videoId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Video Başarıyla Güncellendi.</span> ";
          header("refresh:3; url=video.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Video Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
          $query = "UPDATE tbl_video
          SET 
          videoName   = '$videoName',
          videoLink   = '$videoLink',
          videoSira   = '$videoSira',
          videoDurum  = '$videoDurum'
          WHERE videoId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Video Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=video.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Video Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }
  public function medyaUpdate($data, $files)
     { 
   
      $medyaBaslik    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['medyaBaslik'] )));
      $baslik         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['baslik'] ))));
      $ortaBaslik     =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['ortaBaslik'] )));
      $ortaAltBaslik  =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['ortaAltBaslik'] ))));
      $altBaslik      =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['altBaslik'] )));
      $takipci        =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['takipci'] ))));
  
      $permited = array('jpg','png','jpeg','gif');
      
      $file_name  =  $files['resimler']['name'];
      $file_size  =  $files['resimler']['size'];
      $file_temp  =  $files['resimler']['tmp_name'];
      $file_type  =  $files['resimler']['type'];
   
       $div = explode('.', $file_name);
       $file_ext = strtolower(end($div));
       $unique_video = substr(md5(time()), 0, 10).'.'.$file_ext;
       $uploaded_image= "../../upload/medya/".substr(md5(uniqid(rand(1,6))), 0, 8).'.'.$file_ext;
    
      if($medyaBaslik == "" || $baslik == ""|| $ortaBaslik == "" || $ortaAltBaslik == ""|| $altBaslik == "" || $takipci == "") {
      $msg = "<span class='error'>Alanlar Boş Olmamalı!</span> ";
          return $msg;
     }else {
      try{
    
     if (!empty($file_name)) {
        
        if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
      
             $id=1;
             $columnName='image';
             $tName='tbl_medya';
             $columnId='medyaId';
            $this->delImageId($id,$tName,$columnId,$columnName);
             move_uploaded_file($file_temp, $uploaded_image);
           
           
  

    $query = "UPDATE tbl_medya
            SET
            medyaBaslik    = '$medyaBaslik',
            baslik         = '$baslik',
            ortaBaslik     = '$ortaBaslik',
            ortaAltBaslik  = '$ortaAltBaslik',
            image          = '$uploaded_image',
            altBaslik      = '$altBaslik',
            takipci        = '$takipci'
          WHERE medyaId = '1' ";
             $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Medya Güncelleme Başarılı.</span> ";
         
          return $msg;
        }else {
          $msg = "<span class='error'>Medya Güncellenme Başarısız!</span> ";
          return $msg;
        } 
   }
 }
       else{
        $query = "UPDATE tbl_medya
            SET
            medyaBaslik    = '$medyaBaslik',
            baslik         = '$baslik',
            ortaBaslik     = '$ortaBaslik',
            ortaAltBaslik  = '$ortaAltBaslik',
            altBaslik      = '$altBaslik',
            takipci        = '$takipci'
          WHERE medyaId = '1' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Medya Güncelleme Başarılı.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Medya Güncellenme Başarısız!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 

   catch(Exception $e)    
    {
      die($e->getMessage());
       }
  }  
}

 public function galeriInstagramInsert($data, $file){

     $sira    =  mysqli_real_escape_string($this->db->link, $data['sira']);
     
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $inserted_image = "../../upload/instagramgaleri/".$unique_image; 
     
     if ($sira == "") {
      $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
          return $msg;
     }else{ 
       if (!empty($file_name)) {
         if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
          move_uploaded_file($file_temp, $inserted_image);
          $query = "INSERT INTO tbl_instagaleri(sira, image) 
          VALUES ('$sira','$inserted_image')";  
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
             header("refresh:2; url=instagramfoto.php");
          $msg = "<span class='success'>Foto Başarılı Eklendi.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Foto Eklenmedi!</span> ";
          return $msg; // return message 
        } 
     }


    }
}
}
  public function instagramFotoUpdate($data, $file, $id){
 
    $sira   =  mysqli_real_escape_string($this->db->link, $data['sira'] );
   
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/instagramgaleri/".$unique_image;
     if ($sira == "") {
     $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
        return $msg;
     }else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz..1</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
               $columnName = 'image';
               $tName = 'tbl_instagaleri';
               $columnId = 'instagramId';
              $this->delImageId($id,$tName,$columnId,$columnName);

          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_instagaleri 
          SET 
          sira   = '$sira',
          image  = '$uploaded_image'
          
          WHERE instagramId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=instagramfoto.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_instagaleri 
          SET 
          sira   = '$sira'
          WHERE instagramId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=instagramfoto.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }

   public function haberInsert($data, $file){
    date_default_timezone_set('Europe/Istanbul');

     $haberBaslik        =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberBaslik'] ))));
     $haberDetay         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberDetay'] ))));
     $haberKaynak        =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberKaynak'] ))));
     $haberSira          =  mysqli_real_escape_string($this->db->link, $data['haberSira']);
     $haberDurum         =  mysqli_real_escape_string($this->db->link, $data['haberDurum']);
     $haberTarih         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberTarih'] ))));
    
     
     if ($haberBaslik == "" || $haberDetay=="" || $haberKaynak == "" || $haberSira == "" || $haberDurum=="" || $haberTarih == "") {
      $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
          return $msg;
     }else{ 
      $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $inserted_image = "../../upload/haberFoto/".$unique_image; 
     if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
          move_uploaded_file($file_temp, $inserted_image);
          $query = "INSERT INTO tbl_haber(haberBaslik, haberDetay, haberKaynak, haberSira, haberDurum, haberTarih, image) VALUES ('$haberBaslik', '$haberDetay', '$haberKaynak', '$haberSira', '$haberDurum','$haberTarih', '$inserted_image')";  
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
             header("refresh:2; url=haber.php");
          $msg = "<span class='success'>Haber Başarılı Eklendi.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Haber Eklenmedi!</span> ";
          return $msg; // return message 
        } 
     }


    }
}
  public function haberUpdate($data, $file, $id){
    date_default_timezone_set('Europe/Istanbul');
 
     $haberBaslik        =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberBaslik'] ))));
     $haberDetay         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberDetay'] ))));
     $haberKaynak        =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberKaynak'] ))));
     $haberSira          =  mysqli_real_escape_string($this->db->link, $data['haberSira']);
     $haberDurum         =  mysqli_real_escape_string($this->db->link, $data['haberDurum']);
     $haberTarih         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['haberTarih']))));
     

     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/haberFoto/".$unique_image;
 
     
     if ($haberBaslik == "" || $haberDetay=="" || $haberKaynak == "" || $haberSira == "" || $haberDurum=="" || $haberTarih == "") {
      $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
          return $msg;
     }else{
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz..1</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
               $columnName = 'image';
               $tName = 'tbl_haber';
               $tableId = 'haberId';
              $this->delImageId($id,$tName,$tableId, $columnName);

          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_haber
          SET 
          haberBaslik   = '$haberBaslik',
          haberDetay    = '$haberDetay',
          haberKaynak   = '$haberKaynak',
          haberSira     = '$haberSira',
          haberDurum    = '$haberDurum',
          haberTarih    = '$haberTarih',
          image         = '$uploaded_image'
          WHERE haberId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=haber.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
          $query = "UPDATE tbl_haber 
          SET 
          haberBaslik   = '$haberBaslik',
          haberDetay    = '$haberDetay',
          haberKaynak   = '$haberKaynak',
          haberSira     = '$haberSira',
          haberDurum    = '$haberDurum',
          haberTarih    = '$haberTarih'
          WHERE haberId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Kayıt Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=haber.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Kayıt Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }

}