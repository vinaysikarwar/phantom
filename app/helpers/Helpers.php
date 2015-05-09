<?php
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\User\Component;
use Phalcon\Image\Adapter as Image;
use Translation as tr;
use Phalcon\Tag as Tag;
use Phalcon\Flash\Session as Session;
class Helpers 
{
    public function getCountryOptions($country)
    {
		$countryList = Translation::$regionTranslation;
		$options = '';
		foreach($countryList as $Name => $Code){
			if($country){
				if($country == $Code){
					$selected = "selected";
				}
				else{
					$selected = '';
				}
			}
			else{
				if($Code == "IN")
				{
					$selected = "selected";
				}
				else{
					$selected = '';
				}
			}
			$options .= "<option value='".$Code."' $selected>".$Name."</option>";
		}
		return $options;
    }
	
	public function getPageUrl($path){
		$url = new Phalcon\Mvc\Url();
		return $url->getBaseUri().$path;
	}
	
	public function isHideHeaderFooter($url){
		$strictUrls = array('/user/login','/user/login/','/user/','/user','/user/forgotpassword','/user/forgotpassword/','/user/register','/user/register/');
		if(in_array($url,$strictUrls)) return true;		
	}
	
	public function getUserAddress($address){
		$street = "";
		if($address){
			$address = unserialize($address);
			foreach($address as $row){
				$street .= "<p>";
				$street .= $row;
				$street .= "</p>";
			}
		}
		return $street;
	}
	
	public function getAdminLoggedInClass($user){
		if($user){
			return "skin-blue";
		}
		else{
			return "skin-default";
		}
	}
	
	public function getCompressImage($source, $width=-1,$height=-1,$name,$quality){
		$destination = getcwd().'/media/repository/users/'.$name.'.jpg';
		$info = getimagesize($source);
		if ($info['mime'] == 'image/jpeg') 
			$imageSrc = imagecreatefromjpeg($source);
		elseif ($info['mime'] == 'image/gif') 
			$imageSrc = imagecreatefromgif($source);
		elseif ($info['mime'] == 'image/png') 
			$imageSrc = imagecreatefrompng($source);
		imagejpeg($imageSrc, $destination, $quality);
		// Now resize the Image
		$imageData = new Phalcon\Image\Adapter\GD($destination);
		$imageData->resize($width,$height);
		try{
			$imageData->save();
		}
		catch(exception $ex){
			
		}
		return $destination; 
	}
	
	public function getCategoryUrl($image){
		if($image){
			$imagePath = "media/category/$image";
			if(file_exists($imagePath)){
				return $this->getPageUrl($imagePath);
			}
			else
			{
				return "#";
			}
		}
	}
	
	public function getCategoryImage($image,$alt=-1,$width = -1){
		if($image){
			$imagePath = "media/category/$image";
			if(file_exists($imagePath)){
				$tag = new Tag;
				return $tag->image(array($imagePath,"alt" => $alt,"width" => $width));
			}
		}
	}
	
	public function uploadImage($uploads,$object = -1){
		$isUploaded = false;
		$session = new Session;
		#do a loop to handle each file individually
		foreach($uploads as $file){
			$object->basename = $file->getname();
			$path = 'media/category/'.strtolower($file->getname());
			if ($this->imageCheck($file->getType())) {
				($file->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
			}
		}
		return $isUploaded;
	}
	
	private function imageCheck($extension)
    {
        $allowedTypes = [
            'image/gif',
            'image/jpg',
            'image/png',
            'image/bmp',
            'image/jpeg'
        ];

        return in_array($extension, $allowedTypes);
    }
}
