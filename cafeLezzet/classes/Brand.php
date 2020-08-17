<?php 
$filepath= realpath(dirname(__FILE__));//http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken diğer bölümler erişemiyor.
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
 
?>
 
<?php
class Brand{
	private $db;  // I crate Property for Database Class
	private $fm; // I crate Property for Format Class  
 
    public function __construct(){
       $this->db   = new Database(); // I crate Object for Database Class
       $this->fm   = new Format(); // I crate Object for Format Class  
	}


  public function menuInsert($data, $file){  
      $menuName          =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['menuName'] )));
      $menuDetay         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['menuDetay'] ))));
      $menuUrl           =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['menuUrl'] )));
      $menuSira          =  mysqli_real_escape_string($this->db->link, $data['menuSira'] );
      $menuDurum         =  mysqli_real_escape_string($this->db->link, $data['menuDurum']  );
       if ($menuName == "" || $menuDetay == "" || $menuUrl == "" || $menuSira == "" || $menuDurum == "") {
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
     $uploaded_image = "../../upload/menu/".$unique_image;
       if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "INSERT INTO tbl_menu(image, menuName, menuDetay, menuUrl, menuSira, menuDurum) VALUES('$uploaded_image', '$menuName', '$menuDetay','$menuUrl', '$menuSira', '$menuDurum')"; 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
          header("refresh:2; url=menu.php");
          $msg = "<span class='success'>Menu Başarılı Eklendi.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Menu Eklenmedi!</span> ";
          return $msg; // return message 
        } 
     }

    }
}
    public function menuBySearch($search){
    $query = "SELECT * FROM tbl_menu WHERE menuName LIKE '%$search%'";
     $result = $this->db->select($query);
     return $result;
  }
    public function getAllMenu(){ 
        $query = "SELECT * FROM tbl_menu ORDER BY menuId ASC";
         $result = $this->db->select($query);
         return $result; 
       }


    public function delMenuById($id){
          $query = "SELECT * FROM tbl_menu WHERE menuId ='$id' ";
          $menudeldata = $this->db->delete($query);
          if ($menudeldata) {
           while ($delImg = $menudeldata->fetch_assoc()) {
           $dellink = $delImg['image'];
                  unlink($dellink);
            }
          }
                 $delquery = "DELETE FROM tbl_menu WHERE menuId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Menu Başarılı Silindi.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Menu Silinmedi!</span> ";
                 return $msg;
              } 
    }
    
   
   

public function getMenuById($id){
      $query = "SELECT * FROM tbl_menu WHERE menuId ='$id' ";
         $result = $this->db->select($query);
         return $result;
     }


     public function menuUpdate($data, $file, $id)
     {
      $menuName          =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['menuName'] )));
      $menuDetay         =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['menuDetay'] ))));
      $menuUrl           =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['menuUrl'] )));
      $menuSira          =  mysqli_real_escape_string($this->db->link, $data['menuSira'] );
      $menuDurum         =  mysqli_real_escape_string($this->db->link, $data['menuDurum']  );
      
      
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/menu/".$unique_image;
      if ($menuName == "" || $menuDetay == "" || $menuUrl == "" || $menuSira == "" || $menuDurum == "") {
     $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
        return $msg;
     }else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz!</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
         $columnName='image';
         $tName='tbl_menu';
         $columnId='menuId';
         $this->delImageId($id,$tName,$columnId,$columnName);
          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_menu
            SET
            image     = '$uploaded_image',
            menuName  = '$menuName',
            menuDetay = '$menuDetay',
            menuUrl   = '$menuUrl',
            menuSira  = '$menuSira',
            menuDurum = '$menuDurum'
            WHERE menuId = '$id' ";
             $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Menu Başarıyla Güncellendi.</span> ";
         //header("refresh:2; url=menu.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Menu Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
        $query = "UPDATE tbl_menu
            SET
            menuName  = '$menuName',
            menuDetay = '$menuDetay',
            menuUrl   = '$menuUrl',
            menuSira  = '$menuSira',
            menuDurum = '$menuDurum'
            WHERE menuId = '$id' ";

          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Menu Başarıyla Güncellendi.</span> ";
          header("refresh:3; url=menu.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Menu Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }
 
	
    public function getAllSlider(){

      $query = "SELECT * FROM tbl_slider";
             $result = $this->db->select($query);
             return $result;
    }


 public function sliderInsert($data, $file){

      $sliderName    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['sliderName'])));
      $sliderLink    =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['sliderLink'])));
      $sliderSira    =  mysqli_real_escape_string($this->db->link, $data['sliderSira']);
      $sliderDurum   =  mysqli_real_escape_string($this->db->link, $data['sliderDurum']);

     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $inserted_image = "../../upload/slider/".$unique_image;
 if ($sliderName == "" || $sliderLink == "" || $sliderSira == "" || $sliderDurum == "") {
      $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
          return $msg;
     }else{
    
       if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
          move_uploaded_file($file_temp, $inserted_image);
          $query = "INSERT INTO tbl_slider(sliderName, image, sliderLink, sliderSira, sliderDurum) 
          VALUES ('$sliderName','$inserted_image','$sliderLink','$sliderSira','$sliderDurum')";  
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
             header("refresh:2; url=slider.php");
          $msg = "<span class='success'>Slider Başarılı Eklendi.</span> ";
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Slider Eklenmedi!</span> ";
          return $msg; // return message 
        } 
     }


    }
}
    public function getSliderById($id){
      $query = "SELECT * FROM tbl_slider WHERE sliderId ='$id' ";
             $result = $this->db->select($query);
             return $result;
   }
     public function sliderBySearch($search){
      $query = "SELECT * FROM tbl_slider WHERE sliderName LIKE '%$search%'";
     $result = $this->db->select($query);
     return $result;
  }

    public function sliderUpdate($data, $file, $id){
 
    $sliderName   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['sliderName'])));
    $sliderLink   =  mysqli_real_escape_string($this->db->link, strip_tags(addslashes($data['sliderLink'])));
    $sliderSira   =  mysqli_real_escape_string($this->db->link, $data['sliderSira'] );
    $sliderDurum  =  mysqli_real_escape_string($this->db->link, $data['sliderDurum']);
 
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/slider/".$unique_image;
     if ($sliderName == "" || $sliderLink == "" || $sliderSira == "" || $sliderDurum == "") {
     $msg = "<span class='error'>Alanlar Boş Olamaz!</span> ";
        return $msg;
     }else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz..1</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
               $columnName='image';
               $tName='tbl_slider';
               $columnId='sliderId';
              $this->delImageId($id,$tName,$columnId,$columnName);

          move_uploaded_file($file_temp, $uploaded_image);
          $query = "UPDATE tbl_slider
          SET 
          sliderName   = '$sliderName',
          image        = '$uploaded_image',
          sliderLink   = '$sliderLink',
          sliderSira   = '$sliderSira',
          sliderDurum  = '$sliderDurum'
          WHERE sliderId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Slider Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=slider.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Slider Güncellenmedi!</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_slider
          SET 
          sliderName   = '$sliderName',
          sliderLink   = '$sliderLink',
          sliderSira   = '$sliderSira',
          sliderDurum  = '$sliderDurum'
          WHERE sliderId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
           $msg = "<span class='success'>Slider Başarıyla Güncellendi.</span> ";
          header("refresh:2; url=slider.php");
          return $msg;
        }else {
          $msg = "<span class='error'>Slider Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }
 
  }

    public function delSliderById($id){
       $query = "SELECT * FROM tbl_slider WHERE sliderId = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg['image'];
                  unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM tbl_slider WHERE sliderId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Slider Başarılı Silindi.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Slider Silinmedi!</span> ";
                 return $msg;
              } 
    }

     public function brandBySearch($search){

          $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
           FROM tbl_product
           INNER JOIN tbl_category
           ON tbl_product.catId = tbl_category.catId
           INNER JOIN tbl_brand
           ON tbl_product.brandId = tbl_brand.brandId and brandName like '%$search%' ";
      $result =  $this->db->select($query);
      

       return $result;
    }


    public function getAdminData(){
         $query = "SELECT * FROM tbl_admin";
         $result = $this->db->select($query);
         return $result;

    }
    public function adminUpdate($data, $file){
      $adminPass    =  $this->fm->validation($data['adminPass']);
      $adminUser    = $this->fm->validation($data['adminUser']);
      $adminPass    =  mysqli_real_escape_string($this->db->link, stripslashes($data['adminPass']));
      $adminUser    =  mysqli_real_escape_string($this->db->link, stripslashes($data['adminUser'] ));
      

      $adminPass1 = $this->fm->sifreKontrolEt($adminPass);
      $adminPass2 = $this->fm->sqlonleme($adminPass);
      $adminUser1 = $this->fm->adminNameKontrol($adminUser);
      $adminUser2 = $this->fm->sqlonleme($adminUser);
      $options = array('cost' => 11);
      $hashed_password =  password_hash($adminPass, PASSWORD_BCRYPT,$options);

      $adminName    = $this->fm->validation($data['adminName']);
      $adminEmail   = $this->fm->validation($data['adminEmail']);
      $level        = $this->fm->validation($data['level']);


      $adminName   =  mysqli_real_escape_string($this->db->link, $data['adminName'] );
      $adminName1   =  $this->fm->textKontrolEt($this->fm->sqlonleme($adminName));
      $adminEmail  =  mysqli_real_escape_string($this->db->link, $data['adminEmail'] );
      $adminEmail  =  $this->fm->emailKontrolEt($adminEmail);
      $level       =  mysqli_real_escape_string($this->db->link, $data['level'] );

     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];
 
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "../../upload/admin/".$unique_image;
    // $inserted_image = "upload/arsiv/".$unique_image;
     if ($adminName == "" || $adminEmail == "" || $level == ""){
      $msg = "<span class='error'>Field Must Not be empty .</span> ";
          return $msg;
     }
   elseif($adminPass1 == false)

        {
            $loginmsg ='Error! Lütfen şifrenizi ya sayı ya rakam  veya -, _, $ işaretlerinden seçerek belirleyiniz ';
            return $loginmsg;
            exit();
        }
       elseif($adminPass2 == false )
        {
            $loginmsg ='Error! Lütfen şu sözcükleri seçmeyiniz : <br>"content-type", "bcc:", "to:", "cc:", "href", "* from", "* FROM", "*from", "*FROM", "select", "SELECT", "SET", "set", "update", "UPDATE", "updateset", <br>"UPDATESET", "UPDATE SET", "DELETE", "delete", "*", "SELECT*FROM", "s3", "S3", "%7C", "%2B"';
            return $loginmsg;
            exit();
        }
      elseif($adminUser1 == false)
        {
            $loginmsg ='Error! Lütfen Kullanıcı adınızı ya rakam ya harf ya da - ve _ işaretlerinden seçerek oluşturunuz!';
            return $loginmsg;
            exit();
        }
        elseif ($adminUser2 == false){
           $loginmsg ='Error! Lütfen şu sözcükleri seçmeyiniz : <br>"content-type", "bcc:", "to:", "cc:", "href", "* from","* FROM", "*from", "*FROM", "select", "SELECT", "SET", "set", "update", "UPDATE", "updateset",<br> "UPDATESET", "UPDATE SET","DELETE", "delete", "*", "SELECT*FROM", "s3", "S3", "%7C", "%2B"';
            return $loginmsg;
            exit();
        }
     elseif(!$adminName1)
        {
            exit();
        }
  elseif(!$adminEmail)
       {
         $loginmsg = "Error!";
            return $loginmsg;
            exit();
       }
       else {
     if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Size should be less then 1MB .</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> You can Upload Only".implode(',', $permited)."</span>";
      } else{
        $id = 1;
         $column='image';
         $tName='tbl_admin';
         $tableId='adminId';
         $this->delImageId($id,$tName,$tableId,$column);
          move_uploaded_file($file_temp, $uploaded_image);
          /*$sonuc = copy($uploaded_image, $inserted_image);
              if($sonuc){
              $tbl_fotoarsiv='tbl_fotoarsiv';
              $image='image';
             $this->ekleTable($tbl_fotoarsiv, $image, $inserted_image);
           }
          */

        
          $query = "UPDATE tbl_admin
          SET 
          adminName       = '$adminName',
          adminUser       = '$adminUser',
          adminEmail      = '$adminEmail',
          level           = '$level',
          adminPass       = '$hashed_password',
          image           = '$uploaded_image'
          WHERE  adminId  =  '1' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
         // header("refresh:2; url=index.php");
          $msg = "<span class='success'>Admin Updated Successfully.</span> ";
          return $msg;
        }else {
          $msg = "<span class='error'>Admin Not Updated .</span> ";
          return $msg;
        } 
     }
 
      } else{
           $query = "UPDATE tbl_admin
          SET 
          adminName       = '$adminName',
          adminUser       = '$adminUser',
          adminEmail      = '$adminEmail',
          level           = '$level',
          adminPass       = '$hashed_password'
          WHERE adminId = '1' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Admin Updated Successfully.</span> ";
          //header("refresh:2; url=index.php");
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>Admin Not Updated .</span> ";
          return $msg; // return This Message 
        } 
 
        }
    }

 }

 public function siteUpdate($data){

      $siteUrl      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['siteUrl']))));
      $siteName     =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['siteName']));
      $siteDescr    =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['siteDescr']));
      $siteKeys     =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['siteKeys']));
      $siteauthor   =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['siteauthor']));
      $copyright    =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['copyright']));
      $tarih        =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['tarih']));

    try{
       if($siteUrl == "" || $siteName == "" || $siteDescr == "" || $siteKeys == "" || $siteauthor == "" || $copyright == "" || $siteKeys == "") {
        $msg = "<span class='error'>Alanlar Boş Bırakılamaz!</span> ";
            return $msg;
       }else 
           $query = "UPDATE tbl_site
          SET 
          siteUrl          = '$siteUrl',
          siteName         = '$siteName',
          siteDescr        = '$siteDescr',
          siteKeys         = '$siteKeys',
          siteauthor       = '$siteauthor',
          copyright        = '$copyright',
          tarih            = '$tarih'
          WHERE siteId    = '1' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Site Bilegileri Güncelleme Başarılı.</span> ";
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>Site Bilegileri Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
      }
        catch(Exception $e)    
    {
      die($e->getMessage());
    }
 
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
 public function UpdateFoto($file, $column, $table,$tableId,$klasor){
  
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
              $this->delImageId($id,$table,$tableId,$column);
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

  public function getSiteInfo(){
         $query = "SELECT * FROM tbl_site";
         $result = $this->db->select($query);
         return $result;

    }

    public function iletisimUpdate($data){
    
      $merkezTel      =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['merkezTel']))));
      $subeTel        =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['subeTel']));
      $gsmNo          =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['gsmNo']));
      $mailAdres      =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['mailAdres']));
      $merkezAdres    =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['merkezAdres']));
      $milce          =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['milce']));
      $mil            =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['mil']));
      $subeAdres      =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['subeAdres']));
      $subeilce       =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['subeilce']));
      $subeil         =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['subeil']));
      $mesaiSaat      =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['mesaiSaat']));
       

      $permited = array('jpg','png','jpeg','gif');
      
    

  if($merkezTel == "" || $subeTel == "" || $gsmNo == "" || $mailAdres == "" || $merkezAdres == "" || $milce == "" || $mil == "" || $subeAdres == "" || $subeilce == "" || $subeil == "" || $mesaiSaat == "") {
        $msg = "<span class='error'>Alanlar Boş Bırakılamaz!</span> ";
            return $msg;
       }else {

    try
    {

        $query = "UPDATE tbl_iletisim
          SET 
          merkezTel           = '$merkezTel',
          subeTel             = '$subeTel',
          gsmNo               = '$gsmNo',
          mailAdres           = '$mailAdres',
          merkezAdres         = '$merkezAdres',
          milce               = '$milce',
          mil                 = '$mil',
          subeAdres           = '$subeAdres',
          subeilce            = '$subeilce',
          subeil              = '$subeil',
          mesaiSaat           = '$mesaiSaat'
          WHERE iletisimId    = '1' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>İletişim Bilgileri Güncelleme Başarılı.</span> ";
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>İletişim Bilgileri Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
 
        }
    
  catch(Exception $e)    
    {
      die($e->getMessage());
    }
 }
}

public function getIletisimInfo(){
         $query = "SELECT * FROM tbl_iletisim";
         $result = $this->db->select($query);
         return $result;

    }
     public function ApiUpdate($data){
      $recapctha      =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['recapctha']));
      $mermapApi      =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['mermapApi']));
      $subemapApi     =  mysqli_real_escape_string($this->db->link, $this->fm->validation($data['subemapApi']));
      $goanalystic    =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['goanalystic']))));

    try{
       if($recapctha == "" || $mermapApi == "" || $subemapApi == "" || $goanalystic == "") {
        $msg = "<span class='error'>Alanlar Boş Bırakılamaz!</span> ";
            return $msg;
       }else 
           $query = "UPDATE tbl_apisocial
          SET 
          recapctha           = '$recapctha',
          mermapApi           = '$mermapApi',
          subemapApi          = '$subemapApi',
          goanalystic         = '$goanalystic'
          WHERE socialapiId   = '1' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Api Güncelleme Başarılı.</span> ";
          return $msg; // return This Message 
        }else {
          $msg = "<span class='error'>Api Güncellenmedi!</span> ";
          return $msg; // return This Message 
        } 
      }
        catch(Exception $e)    
          {
            die($e->getMessage());
          }
 
  }
public function getApiSocial(){
         $query = "SELECT * FROM tbl_apisocial";
         $result = $this->db->select($query);
         return $result;

    }


    public function socialUpdate($fb, $tw, $ln, $go, $ins){

      $fb  =  $this->fm->validation(strip_tags(addslashes($fb)));
      $tw  =  $this->fm->validation(strip_tags(addslashes($tw)));
      $ln  =  $this->fm->validation(strip_tags(addslashes($ln)));
      $go  =  $this->fm->validation(strip_tags(addslashes($go)));
      $ins =  $this->fm->validation(strip_tags(addslashes($ins)));

     // $fb  =  mysqli_real_escape_string($this->db->link, $fb );
      $tw  =  mysqli_real_escape_string($this->db->link, $tw );
      $ln  =  mysqli_real_escape_string($this->db->link, $ln );
      $go  =  mysqli_real_escape_string($this->db->link, $go );
      $ins =  mysqli_real_escape_string($this->db->link, $ins);

       if (empty($fb)) {   
         $msg = "<span class='error'>Sosyal Medya Alanları Boş Olamz!</span> ";
         return $msg;
   
     }else {
      $query = "UPDATE tbl_apisocial
            SET
            facebook           = '$fb',
            twitter            = '$tw',
            linkedin           = '$ln',
            google             = '$go',
            instagram          = '$ins'
            WHERE socialapiId  = '1' ";
            $update_row  = $this->db->update($query);
            if ($update_row) {
              $msg = "<span class='success'>Sosyal Medya Güncelleme Başarılı.</span> ";
              return $msg; // return message 
            }else {
              $msg = "<span class='error'>Sosyal Medya Güncellenmedi.</span> ";
          return $msg; // return message 
            }
 
     }
}

}
?>