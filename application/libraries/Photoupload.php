<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photoupload
{
		public function filephotoupload(){
				$type = explode('.', $_FILES["foto"]["name"]);
				$type = $type[count($type)-1];
				$url = "assets/img/".uniqid(rand()).'.'.$type;
				//$_POST["foto"]=$url;
				move_uploaded_file($_FILES["foto"]["tmp_name"], $url);
				if(is_uploaded_file($_FILES["foto"]["tmp_name"])){
						if(move_uploaded_file($_FILES["foto"]["tmp_name"], $url)){
							return $url;
						}
					}
		}
		
		
		public function camphotoupload(){
			    $encoded_data = $_POST['foto1'];
				$binary_data = base64_decode( $encoded_data );
				$url = "assets/img/".uniqid(rand()).'.jpg';
				//$_POST["foto"]=$url;
				//file_put_contents('http://www.ninadentalcare.com/'.$url, $binary_data);
				$result = file_put_contents( $url, $binary_data);
				if (!$result) die("Could not save image!  Check file permissions.");
				else return $url;
		}




}


?>