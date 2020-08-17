<?php 
$filepath= realpath(dirname(__FILE__));//http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken diğer bölümler erişemiyor.

include_once($filepath.'/../lib/Session.php'); 
Session::checkLogin();

include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');

?>

<?php
class Adminlogin {

	private $db;  // Database class property 
	private $fm;  // Format class property 
    
    public function __construct() { 
    	$this->db   = new Database(); // Object for Database Class
		$this->fm   = new Format();   // Object for Format Class
    }
    public function adminLogin($adminUser,$adminPass){
    	$adminUser = $this->fm->validation($adminUser); //here i with this format class object i access the method
		$adminPass = $this->fm->validation($adminPass);
		$adminUser =  mysqli_real_escape_string($this->db->link, stripslashes($adminUser)); // our login filed adminUser 
		$adminPass =  mysqli_real_escape_string($this->db->link, stripslashes($adminPass)); // our login filed adminPass 
       
        $adminPass1 = $this->fm->sifreKontrolEt($adminPass);
        $adminPass2 = $this->fm->sqlonleme($adminPass);
        $adminUser1 = $this->fm->adminNameKontrol($adminUser);
		$adminUser2 = $this->fm->sqlonleme($adminUser);
       
        if(empty($adminUser) || empty($adminPass)) {
    	 $loginmsg = "Error!"; // I take one variable as $loginmsg 
        return $loginmsg;
        
    	}
        elseif($adminPass1 != true)

        {
            header("Location:404.php");
            exit();
        }
       elseif(!$adminPass2)
        {
            $loginmsg= "<script>window.location = '404.php';  </script>";
            return $loginmsg;
            exit();
        }
      elseif($adminUser1 !=true)
        {
            header("Location:404.php");
            exit();
        }
        elseif (!$adminUser2){
            $loginmsg= "<script>window.location = '404.php';  </script>";
            return $loginmsg;
            exit();
        }
  
        else {
        $query = "SELECT * FROM tbl_admin WHERE adminUser=?";
    	$result = $this->db->selectLogin($query,$adminUser,$adminPass);
        if ($result!= false) {
    	$value = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();

 
      $realSifre = password_verify($adminPass, $value['adminPass']);

 
       if($realSifre != false && $adminUser == $value['adminUser']){

                Session::set("adminlogin", true);
                Session::set("logget", time());
                Session::set("adminId", $value['adminId']);
    			Session::set("yetki", $value['level']);
    			Session::set("adminUser", $value['adminUser']);
    			Session::set("adminName", $value['adminName']);
                Session::set("image", $value['image']);
    			header("Location:index.php");
            
        		
            }
            else{
               
               $loginmsg = "";
                return $loginmsg; // here we return this message we have to get this msg letter for display this text.
            }
        }
            else{
               
               $loginmsg = "";
    			return $loginmsg; // here we return this message we have to get this msg letter for display this text.
    		}
            

}
}

}


   

 ?>