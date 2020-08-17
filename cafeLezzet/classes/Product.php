
<?php 
 $filepath= realpath(dirname(__FILE__));
 //http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken //diğer bölümler erişemiyor.
 include_once($filepath.'/../lib/Database.php');
 include_once($filepath.'/../helpers/Format.php');
 ?>

<?php
class Product{
	private $db;
	private $fm;
 
       public	function __construct(){
       $this->db   = new Database();
       $this->fm   = new Format();
	}

public function productInsert($data, $file=[]){
    $files = unserialize($file);
    $count = count($files['image']['name']);
 
    $productName    =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['productName']))));
    $baseId         =  mysqli_real_escape_string($this->db->link, $data['baseId'] );
    $catId 	        =  mysqli_real_escape_string($this->db->link, $data['catId'] );
    $body           =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['body'])))); //format classın STRİP TAGS (HTML LERİ KALDIRIR.https://www.php.net/strip-tags) FONKSİYONU EKLE, SQL İNJECIONLARI DA ÖNLEMEK İÇİN FONK YAZIVER.
    $price         =  mysqli_real_escape_string($this->db->link, addslashes($data['price']) );
    $price1          = $this->fm->isaretDegistir(',', '.',$price);
    $type           =  mysqli_real_escape_string($this->db->link, $data['type'] );
 
 
     if ($productName == "" || $baseId == "" || $catId == "" || $body == "" || $price == "" || $type == "") {
     	$msg = "<span class='error'>Alanlar Boş Olmamalı.</span> ";
    			return $msg;
     }
    
     elseif(!$this->fm->RakamAra($price1))
     {
      $msg = "<span class='error'>Lütfen fiyatı yazarken rakam, nokta ve virgül kullanınınız!</span>";
      return $msg;
    }
     else{
      try{

      if ($count>0) {


      for($i=0; $i<$count;$i++){
      $file_name  =  $files['image']['name'][$i];
      $file_size  =  $files['image']['size'][$i];
      $file_temp  =  $files['image']['tmp_name'][$i];
      $file_type  =  $files['image']['type'][$i];
        
        $permited = array('jpg','png','jpeg','gif');
        $div= explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $inserted_image[$i] ="../../upload/urunler/".substr(md5(uniqid(rand(1,6))), 0, 8).'.'.$file_ext;
      
         if ($file_size > 1054589 ) {
          echo "<span class='error'>Image Boyutu 1MB den fazla olmamalı!</span>";
         }elseif (in_array($file_ext, $permited) === false) {
          echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz: ".implode(',', $permited)."</span>";
          } else{
             
             move_uploaded_file($file_temp, $inserted_image[$i]);
             
             
          }
           
  }

          $query = "INSERT INTO tbl_product(productName, baseId, catId, body, price, image, imageYedek,type) 
          VALUES ('$productName','$baseId','$catId','$body','$price1','$inserted_image[0]','$inserted_image[1]','$type')";
 
          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
          $msg = "<span class='success'>Ürün Ekleme Başarılı.</span> ";
          header("refresh:2; url=urun.php");
          return $msg; // return message 
        }else {
          $msg = "<span class='error'>Ürün Ekleme Başarısız!</span> ";
          return $msg; // return message 
        } 
     }
 
    }
    catch(Exception $e)    
    {
      die($e->getMessage());
       }
  }  

}
public function productUpdate($data, $file, $id){

    
    $productName    =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['productName']))));
    $baseId         =  mysqli_real_escape_string($this->db->link, $data['baseId'] );
    $catId          =  mysqli_real_escape_string($this->db->link, $data['catId'] );
    $body           =  mysqli_real_escape_string($this->db->link, $this->fm->validation(strip_tags(addslashes($data['body'])))); //format classın STRİP TAGS (HTML LERİ KALDIRIR.https://www.php.net/strip-tags) FONKSİYONU EKLE, SQL İNJECIONLARI DA ÖNLEMEK İÇİN FONK YAZIVER.
    
    $price          =  mysqli_real_escape_string($this->db->link, addslashes($data['price']) );
    $price1          =  $this->fm->isaretDegistir('/,/', '.', $price);
    $type           =  mysqli_real_escape_string($this->db->link, $data['type'] );

     
     $permited = array('jpg','png','jpeg','gif');
     $file_name = $file['image']['name'];
     $file_size = $file['image']['size'];
     $file_temp = $file['image']['tmp_name'];
     $file_type = $file['image']['type'];

      $permited = array('jpg','png','jpeg','gif');
     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image= "../../upload/urunler/".substr(md5(uniqid(rand(1,6))), 0, 8).'.'.$file_ext;
    
     if ($productName == "" || $baseId=="" || $catId == "" || $body == ""  || $price == "" || $type == "" ) {
      $msg = "<span class='error'>Alanlar Boş Geçilemez!</span> ";
          return $msg;

     }
     elseif(!$this->fm->RakamAra($price1))
     {
      $msg = "<span class='error'>Lütfen fiyatı yazarken rakam, nokta ve virgül kullanınınız!</span>";
      return $msg;
     
     }else {

      if (!empty($file_name)) {
     if ($file_size > 1054589) {
      echo "<span class='error'>Image Boyutu 1MB'den Büyük Olamaz!</span>";
     }elseif (in_array($file_ext, $permited) === false) {
      echo "<span class='error'> Sadece şu uzantılı dosyaları yükleyebilirsiniz : ".implode(',', $permited)."</span>";
      } else{
    
          $this->delImageId($id,"tbl_product","productId","image");
          move_uploaded_file($file_temp, $uploaded_image);
        
      
          $query = "UPDATE tbl_product
          SET 
          productName   = '$productName',
          baseId        = '$baseId',
          catId         = '$catId',
          body          = '$body',
          price         = '$price1',
          image         = '$uploaded_image',
          type          = '$type'
          WHERE productId = '$id' ";
      
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Ürün Güncelleme Başarılı.</span> ";
          header("refresh:2; url=urun.php");
          return $msg;
        }else {
          var_dump($updated_row);
          $msg = "<span class='error'>Ürün Güncellenmedi.</span> ";
          return $msg;
        } 
     }

}
 
       else{
           $query = "UPDATE tbl_product
          SET 
          productName   = '$productName',
          baseId        = '$baseId',
          catId         = '$catId',
          body          = '$body',
          price         = '$price1',
          type          = '$type'
          WHERE productId = '$id' ";
 
          $updated_row = $this->db->update($query);
          if ($updated_row) {
          $msg = "<span class='success'>Ürün Güncelleme Başarılı.</span> ";
          header("refresh:2; url=urun.php");
          return $msg; // return This Message 
        }else {
          var_dump($updated_row);
          $msg = "<span class='error'>Ürün Güncellenmedi.</span> ";
          return $msg; // return This Message 
        } 
 
        }
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
public function UpdateFoto($file, $column, $table, $tableId, $id,$klasor){
  
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
              
              $this->delImageId($id, $table, $tableId, $column);
              move_uploaded_file($file_temp, $uploaded_image);
              
          $query = "UPDATE $table
              SET 
              $column        = '$uploaded_image'
              
              WHERE  $tableId =  '$id' ";
          
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

public function getAllProduct(){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
               FROM tbl_product
               INNER JOIN tbl_base
               ON tbl_product.baseId = tbl_base.baseId
               INNER JOIN tbl_category
               ON tbl_product.catId = tbl_category.catId
               ORDER BY tbl_product.productId DESC ";
        $result =  $this->db->select($query);
        return $result; 
  }
    public function getAllProductAsc(){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
               FROM tbl_product
               INNER JOIN tbl_base
               ON tbl_product.baseId = tbl_base.baseId
               INNER JOIN tbl_category
               ON tbl_product.catId = tbl_category.catId
               ORDER BY tbl_product.catId ";
        $result =  $this->db->select($query);
        return $result; 
  }
  public function getDatabase($table){
         $query = "SELECT * FROM $table order by catId";
         $result = $this->db->select($query);
         return $result;
     }

     public function getAllProductCatName(){
      $query = "SELECT tbl_product.*, tbl_category.catName
               FROM tbl_product
               INNER JOIN tbl_category
             ON tbl_product.catId = tbl_category.catId";
              $result = $this->db->select($query);
         return $result;
 } 
   public function getProductCatName($column, $count){
      $query = "SELECT tbl_product.*, tbl_category.catName
               FROM tbl_product
               INNER JOIN tbl_category
               ON tbl_product.catId = tbl_category.catId WHERE catName ='$column' ORDER BY productId ASC LIMIT $count ";
         $result = $this->db->select($query);
         return $result;
   }
   public function getProductSpesiyaller($count){
      $query = "SELECT * FROM tbl_product WHERE catId ='9' ORDER BY productId ASC LIMIT $count ";
         $result = $this->db->select($query);
         return $result;
   }
   public function getAllCount($name){
        
         $query = "SELECT count(*) from tbl_product where catId=(select catId from tbl_category where catName='$name')";
         $result = $this->db->select($query);
       return $result ;
    
     }
     public function getColumnCount($name){
        
         $query = "SELECT count($name) from tbl_product";
         $result = $this->db->select($query);
       return $result ;
    
     }
 public function getColumnCountPratic($table, $name){
        
         $query = "SELECT count($name) from $table";
         $result = $this->db->select($query);
       return $result ;
    
     }
   

public function getProById($id){
      $query = "SELECT * FROM tbl_product WHERE productId ='$id' ";
             $result = $this->db->select($query);
             return $result;
  }

public function delPorByIdSerial($id,$file=[],$table,$tableId){

      $columnCount=unserialize($file);
      $count =count($columnCount);

       $query = "SELECT * FROM $table WHERE $tableId ='$id' ";
       $getData = $this->db->select($query);
        if ($getData) {

           while ($delImg = $getData->fetch_assoc()) {

            for($i=0; $i<$count; $i++){

           $dellink = $delImg[$columnCount[$i]];

            @unlink($dellink);

                          }
                }
          }
           $delquery = "DELETE FROM $table WHERE $tableId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Silme İşlemi Başarılı.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Silme İşlemi Başarısız!</span> ";
                 return $msg;
              } 
 }




public function delPorById($id){
       $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
       $getData = $this->db->select($query);
         if ($getData) {
           while ($delImg = $getData->fetch_assoc()) {
           $dellink = $delImg['image'];
                  unlink($dellink);
            }
          }
       
               $delquery = "DELETE FROM tbl_product WHERE productId = '$id' ";
                $deldata = $this->db->delete($delquery);
            if ($deldata) {
              $msg = "<span class='success'>Product Deleted Successfully.</span> ";
            return $msg;
            }else {
              $msg = "<span class='error'>Product Not Deleted .</span> ";
                 return $msg;
              } 
}
 
public function getFeaturedProduct() {
         $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 6 ";
         $result = $this->db->select($query);
         return $result;
      }

public function getNewProduct(){
         $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4 ";
         $result = $this->db->select($query);
         return $result;
         }

 


public function getSingleProduct($id){
  $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
         FROM tbl_product
         INNER JOIN tbl_base
         ON tbl_product.baseId = tbl_base.baseId
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
        
         AND  tbl_product.productId = '$id'
         ORDER BY tbl_product.productId DESC ";
    $result =  $this->db->select($query);
    return $result;  // i return this result 

  }
  public function getMultiProduct($id){
  $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
         FROM tbl_product
         INNER JOIN tbl_base
         ON tbl_product.baseId = tbl_base.baseId
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
        
         AND  tbl_category.catId = '$id'
         ORDER BY tbl_product.productId DESC ";
    $result =  $this->db->select($query);
    return $result;  // i return this result 


  }
      public function getSingleProductNew($id){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
         FROM tbl_product
         INNER JOIN tbl_category
         ON tbl_product.catId = tbl_category.catId
         INNER JOIN tbl_base
         ON tbl_product.baseId = tbl_base.baseId
         AND tbl_product.productId = '$id'
         ORDER BY tbl_product.productId
         ";
    $result =  $this->db->select($query);
    return $result;  // i return this result 
      }

public function latestFromAcer(){
      $query = "SELECT * FROM tbl_product WHERE brandId ='4' ORDER BY productId DESC LIMIT 1 ";
         $result = $this->db->select($query);
         return $result;
 }

public function latestFromZara(){
      $query = "SELECT * FROM tbl_product WHERE brandId ='6' ORDER BY productId DESC LIMIT 1 ";
         $result = $this->db->select($query);
         return $result;
 }
 
 public function latestFromPolo(){
      $query = "SELECT * FROM tbl_product WHERE brandId ='7' ORDER BY productId DESC LIMIT 1 ";
         $result = $this->db->select($query);
         return $result;
 }
 
 public function latestFromSamsung(){
      $query = "SELECT * FROM tbl_product WHERE brandId ='3' ORDER BY productId DESC LIMIT 1 ";
         $result = $this->db->select($query);
         return $result;
 }

 public function productByCat($id){
     $catId  =  mysqli_real_escape_string($this->db->link, $id);
     $query = "SELECT * FROM tbl_product WHERE catId ='$catId' ";
             $result = $this->db->select($query);
             return $result; 
 }
  
 public function productByOnlyCat($id){
    $query = "SELECT * FROM tbl_category WHERE catId ='$id' ";
           $result = $this->db->select($query);
           return $result;
   }
public function insertCompareDate($productId, $cmrId){
      $cmrId       =  mysqli_real_escape_string($this->db->link, $cmrId);
      $productId   =  mysqli_real_escape_string($this->db->link, $productId);
     
     $cquery = "SELECT * FROM tbl_compare WHERE cmrId ='$cmrId' AND productId ='$productId' ";
     $check = $this->db->select($cquery);
     if ($check) {
      $msg = "<span class='error'>Product Already Added.</span> ";
        return $msg;
     }
      $query = "SELECT * FROM tbl_product WHERE productId ='$productId' ";
      $result = $this->db->select($query)->fetch_assoc();
       if ($result) {
       
         $productId     = $result['productId'];
         $productName   = $result['productName'];
         $price         = $result['price'];
         $image         = $result['image'];
     
          $query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) 
              VALUES ('$cmrId','$productId','$productName','$price','$image')";  
     
              $inserted_row = $this->db->insert($query); 
              if ($inserted_row) {
            $msg = "<span class='success'>Added To Compare.</span> ";
          return $msg;
          }else {
            $msg = "<span class='error'>Not Added.</span> ";
               return $msg;
            } 
         }
       
 }
public function getCompareProduct($cmrId){
    $query = "SELECT * FROM tbl_compare WHERE cmrId= '$cmrId'";
    $result = $this->db->select($query);
    return $result;

}

public function delCompareData($cmrId){

$delquery = "DELETE FROM tbl_compare WHERE cmrId= '$cmrId'";
$deldata = $this->db->delete($delquery);

}


public function saveWishListdata($id, $cmrId){

  $cquery = "SELECT * FROM tbl_wlist WHERE cmrId ='$cmrId' AND productId ='$id' ";
     $check = $this->db->select($cquery);
     if ($check) {
      $msg = "<span class='error'>Product Already Added.</span> ";
        return $msg;
     }

    $pquery = "SELECT * FROM tbl_product WHERE productId ='$id' ";
      $result = $this->db->select($pquery)->fetch_assoc();
       if ($result) {
       
         $productId     = $result['productId'];
         $productName   = $result['productName'];
         $price         = $result['price'];
         $image         = $result['image'];
     
          $query = "INSERT INTO tbl_wlist(cmrId, productId, productName, price, image) 
              VALUES ('$cmrId','$productId','$productName','$price','$image')";  
     
              $inserted_row = $this->db->insert($query); 
              if ($inserted_row) {
            $msg = "<span class='success'>Added To WishList Page.</span> ";
          return $msg;
          }else {
            $msg = "<span class='error'>Not Added.</span> ";
               return $msg;
            } 
         }
}

  public function checkWlistData($cmrId){
   $query = "SELECT * FROM tbl_wlist WHERE cmrId= '$cmrId' ORDER BY id DESC";
      $result = $this->db->select($query);
      return $result;
  }
  public function delWlistData($cmrId,$productId){
  $delquery = "DELETE FROM tbl_wlist WHERE cmrId= '$cmrId' AND productId = '$productId'";
  $deldata = $this->db->delete($delquery);
  }

  public function productBySearch($search){
    $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%' ";
     $result = $this->db->select($query);
     return $result;
  }
   public function productInnerSearch($search){
    $query = "SELECT tbl_product.*, tbl_category.catName, tbl_base.baseName
               FROM tbl_product
               INNER JOIN tbl_base
               ON tbl_product.baseId = tbl_base.baseId
               INNER JOIN tbl_category
               ON tbl_product.catId = tbl_category.catId WHERE productName LIKE '%$search%' OR body LIKE '%$search%' OR baseName LIKE '%$search%' OR catName LIKE '%$search%' ORDER BY tbl_product.productId DESC ";
     $result = $this->db->select($query);
     return $result;
  }

}
  ?>