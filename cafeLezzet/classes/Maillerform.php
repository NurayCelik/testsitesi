
<?php 
$filepath= realpath(dirname(__FILE__));//http://localhost/shop olan url kısım. daha kolay ulaşılsın diye yazıldı. Yoksa admin kısım rahat classlara ulaşırken diğer bölümler erişemiyor.
include_once($filepath.'/../lib/Database.php');
include_once($filepath.'/../helpers/Format.php');
require_once("class.phpmailer.php");
?>
 
<?php
 
class Maillerform{
	private $db;
	private $fm;
 
       public	function __construct(){
       $this->db   = new Database();
       $this->fm   = new Format();
	}

public function formGonder($data){
	  $ad   	=  $this->fm->sqlonleme($this->fm->validation($data['ad']));
      $soyad  	=  $this->fm->sqlonleme($this->fm->validation($data['soyad']));
      $telefon  =  $this->fm->sqlonleme($this->fm->validation($data['telefon']));
      $email    =  $this->fm->sqlonleme($this->fm->validation($data['email']));
      $mesaj 	=  $this->fm->sqlonleme($this->fm->validation($data['mesaj']));

      $ad 	    =  mysqli_real_escape_string($this->db->link, stripslashes($ad));
      $soyad    =  mysqli_real_escape_string($this->db->link, stripslashes($soyad));
      $telefon  =  mysqli_real_escape_string($this->db->link, stripslashes($telefon));
      $email    =  mysqli_real_escape_string($this->db->link, stripslashes($email));
      $mesaj    =  mysqli_real_escape_string($this->db->link, stripslashes($mesaj));
      $mesaj    =  $this->fm->textKontrolCatering($mesaj);
      $msg ="";
      
      if($ad =="" || $soyad =="" || $telefon == "" || $email =="" || $mesaj =="") {
		$msg = "<span class='error' style='color:white; font-size:16px;'>Lütfen Alanları Doldurunuz!</span>";
		return $msg;
		
	  }
	  elseif(!$this->fm->sqlonlemeforCatering($ad) || !$this->fm->sqlonlemeforCatering($soyad) || !$this->fm->sqlonlemeforCatering($telefon) || !$this->fm->sqlonlemeforCatering($email) || !$this->fm->sqlonlemeforCatering($mesaj)){
	  
	  }
	elseif(!$this->fm->MailKontrolEt($email)) {
        header("Location:404.php");
      }
     elseif($this->fm->telefonKontrolEt($telefon)!=true)
    	{
     	header("Location:404.php");
      } 

      elseif($this->fm->textKontrolEtOzel($ad)!=true || $this->fm->textKontrolEtOzel($soyad)!=true) {
       header("Location:404.php");
      }
       
       elseif($this->fm->textKontrolEt($ad)!=true || $this->fm->textKontrolEt($soyad)!=true) {
     	header("Location:404.php");
     	
      }
   
    elseif(!$mesaj) {
     header("Location:404.php");
      }
   
      
      else{



		//Form bilgilerini Dosyaya Yazdırmak İçin

      	 $form=$ad."<br>".$soyad."<br>".$telefon."<br>".$email."<br>".$mesaj;
			$dt="form.php";
			$dosya = fopen($dt,"a");
			
			if($dosya)
			{
				echo "<br>";
				//echo "Dosya var!";
				//echo "<br>";
				
				//$formyeni=str_replace("<br>","\n",$form);
				//echo "\n";
				$giris="*Form Bilgisi\n";
				fwrite($dosya,$giris);
				$sonuclar=explode("<br>",$form);
				foreach($sonuclar as $indis=>$formyeni)
				{
					$yazilacak=$indis.". ".$formyeni."\n";	
					echo "\n";
					
					fwrite($dosya,$yazilacak);
					
					
				}
					fwrite($dosya,"\n-----------------------\n");
					
					fclose($dosya);
					
					
			} 

	      //İnsert Database
	
			$query = "INSERT INTO tbl_form(ad, soyad, telefon, email, mesaj,tarih) 
	          VALUES ('$ad','$soyad','$telefon','$email','$mesaj',now())";  
	 
	          $inserted_row = $this->db->insert($query);
	          if ($inserted_row) {
	           $msg = "<span class='success' style='color:forestgreen; font-size:16px;'>Sayın <ad style='color:white; text-transform: capitalize;'>".$ad." ".$soyad.",</ad><br> Mesaj Gönderdiğiniz İçin Teşekkür Ederiz...</span> ";
	          return $msg; // return message 
	        }else {
	          $msg = "<span class='error' style='color:red; font-size:16px;'>Mesajınız Gonderilmedi!</span> ";
	          return $msg; // return message 
	        }


	      
     }

}
public function MaileGonder($data){
	  $ad   	=  $this->fm->sqlonleme($this->fm->validation($data['ad']));
      $soyad  	=  $this->fm->sqlonleme($this->fm->validation($data['soyad']));
      $telefon  =  $this->fm->sqlonleme($this->fm->validation($data['telefon']));
      $email    =  $this->fm->sqlonleme($this->fm->validation($data['email']));
      $mesaj 	=  $this->fm->sqlonleme($this->fm->validation($data['mesaj']));

      $ad 	    =  mysqli_real_escape_string($this->db->link, stripslashes($ad));
      $soyad    =  mysqli_real_escape_string($this->db->link, stripslashes($soyad));
      $telefon  =  mysqli_real_escape_string($this->db->link, stripslashes($telefon));
      $email    =  mysqli_real_escape_string($this->db->link, stripslashes($email));
      $mesaj    =  mysqli_real_escape_string($this->db->link, stripslashes($mesaj));
      $mesaj    =  $this->fm->textKontrolCatering($mesaj);
      $msg ="";


        if($ad =="" || $soyad =="" || $telefon == "" || $email =="" || $mesaj =="") {
		$msg = "<span class='error' style='color:white; font-size:16px;'>Lütfen Alanları Doldurunuz!</span>";
		return $msg;
		
	  }
	  elseif(!$this->fm->sqlonlemeforCatering($ad) || !$this->fm->sqlonlemeforCatering($soyad) || !$this->fm->sqlonlemeforCatering($telefon) || !$this->fm->sqlonlemeforCatering($email) || !$this->fm->sqlonlemeforCatering($mesaj)){
	  
	  }
	elseif(!$this->fm->MailKontrolEt($email)) {
        header("Location:404.php");
      }
     elseif($this->fm->telefonKontrolEt($telefon)!=true)
    	{
     	header("Location:404.php");
      } 

      elseif($this->fm->textKontrolEtOzel($ad)!=true || $this->fm->textKontrolEtOzel($soyad)!=true) {
       header("Location:404.php");
      }
       
       elseif($this->fm->textKontrolEt($ad)!=true || $this->fm->textKontrolEt($soyad)!=true) {
     	header("Location:404.php");
     	
      }
   
    elseif(!$mesaj) {
     header("Location:404.php");
      }
   
   
      
      else{



		
		

	    //Send Email
/*
      	 ini_set('SMTP', 'smtp.yourisp.com');
 	  	 ini_set("smtp_port","25");
 	  	 ini_set('sendmail_from', 'example@YourDomain.com');
         ini_set( 'display_errors', 1 );
         error_reporting( E_ALL );
         $konu="";

        

	      $mail = new PHPMailer();
	    
	      $mail->IsSMTP();                                   // send via SMTP
	      $mail->Host     = "mail.a.com"; // SMTP servers
	      $mail->SMTPAuth = true;     // turn on SMTP authentication
	      $mail->Username = "info@a.com";  // SMTP username
	      $mail->Password = ""; // SMTP password
	      $mail->Port     = 587; 
	      $mail->From     = $email; // smtp kullanýcý adýnýz ile ayný olmalý
	      $mail->Fromname = $ad;
	      $mail->AddAddress("a@hotmail.com","Ad Soyad");
	      $mail->Subject  =  $konu;
	      $mail->Body     =  implode("    ",$_POST);
	      
	      
	      if(!$mail->Send())
	      {
	      	//Sunucuya yüklenince yorum satırları açılacak!!!!!
	      	
	        // $msg = "Mesaj Gönderilemedi <p>";
	       //  $msg .= "Mailer Error: " . $mail->ErrorInfo;
	        // return $msg;
	       //  exit();
	      }
	      else{
	      //$msg= '<renk style="color:#49b981; font-size:28px;">'. $ad.'</renk> Bizimle iletişime geçtiğiniz için teşekkürler. Çok yakında size geri döneceğiz.<br><br><br>';
	     // return $msg;
	      }*/
	      
}

}
 public function delFormById($id){
    $query = "DELETE FROM tbl_form WHERE formId = '$id' ";
    $deldata = $this->db->delete($query);
    if ($deldata) {
      $msg = "<span class='success'>Form Bilgisi Silindi.</span> ";
	    return $msg;
	    }else {
	      $msg = "<span class='error'>Form Bilgisi Silinmedi!</span> ";
         return $msg;
      } 
    }
  public function getAllForm(){ 
    $query = "SELECT * FROM tbl_form ORDER BY formId DESC";
     $result = $this->db->select($query);
     return $result; 
       }
 public function formBySearch($search){
    $query = "SELECT * FROM tbl_form WHERE ad LIKE '%$search%' or  soyad LIKE '%$search%' or tarih LIKE '%$search%'  or email LIKE '%$search%' or telefon LIKE '%$search%' or mesaj LIKE '%$search%'";
     $result = $this->db->select($query);
     return $result;
  }

}




