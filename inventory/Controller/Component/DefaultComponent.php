<?php
/**
 * Default Component
 *
 * PHP version 5
   This component consists the website default functions
 */
 
class DefaultComponent extends Component {

	protected $_controller = null;
  /**
 * Remove any special character in string and used only numeric and digit
 *
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
        }
        public function initialize(Controller $controller) {
		$this->_controller =& $controller;
	}
	public function Cleanstring($string=NULL){
	    $cleansedstring = ereg_replace("[^A-Za-z0-9]", "-", $string );
		return strtolower($cleansedstring);
	}
/**
 * This function is used to create a unique image name
 *
 * @return void
 */
	public function createImageName($file=NULL,$uploadpath=NULL,$imagename=NULL){
           
            
		 $extname=@end(explode(".", $file));
		 $targetFile =  str_replace('//','/',$uploadpath) . $imagename.'.'.$extname;
		 $filename=$imagename.'.'.$extname;
		 $i=1;
			 
		 while (file_exists($targetFile) ) {
			$basefilename=basename($targetFile);
			$ext=@end(explode(".", $basefilename));
			$name=current(explode(".", $basefilename));
			$filenamereplace=str_replace("_".($i-1),"",$name);
			$filename=$filenamereplace.'_'.$i.'.'.$ext;
			$targetFile =  str_replace('//','/',$uploadpath) . $filename;
			$i++;
		 }
		 return $filename;
  }
  function checkImageFileextension($ext){
    $validextensions=array("jpg","jpeg","gif","png");
	if(in_array($ext,$validextensions)) return true;
	
	return false;
  }
   public function _callthemeview($views,$names=array()) {
		if (is_string($views)) {
			$views = array($views);
		}



		if ($names['theme']) {
			$viewPaths = App::path('View');
                       
                      
                        
			foreach ($views as $view) {
				foreach ($viewPaths as $viewPath) {
					$viewPath = $viewPath . 'Themed' . DS . $names['theme'] . DS . $names['view_name'] . DS . $view . $names['ext'];
                                      
					if (file_exists($viewPath)) {
                                               return $this->_controller->render($viewPath);
					}
				}
			}
		}
	}
     public function createseolinks($link_alias=NULL){
         if($link_alias==NULL) return ;
         return $link_alias.'.html';
     }
     public function PropertyDetailsUrl($property_alias=NULL){ 
         if($property_alias==NULL ) return ;

         return 'property/'.$property_alias.'.html';
     }
	 
	 public function getVisitorIpaddress(){
		  $ip = FALSE;
		  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			  $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
			   for ($i = 0; $i < count($ips); $i++) {
					if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i])) {
						$ip = $ips[$i];
						break;
					}
				}
		  }
		  // Return with the found IP or the remote address
		   return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	 }
	 public function Iptolong($ipaddress){
	    if ($ipaddress == "") {
			return 0;
		} else {
			$ips = split ("\.", "$ipaddress");
			return ($ips[3] + $ips[2] * 256 + $ips[1] * 65536 + $ips[0] * 16777216);
		}
	 }
	 
	 public function fetchimagefromUrl($image_url,$uploaded_path,$name){
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "$image_url");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// grab URL and pass it to the browser
		$out = curl_exec($ch);
		
		$imagename=$this->createImageName(basename($image_url),$uploaded_path,$name);
		// close cURL resource, and free up system resources
		curl_close($ch);
		
		if(!empty($out)){
		 file_put_contents($uploaded_path.$imagename,$out);
		 return $imagename;
		}
		
		return;
		
	 }
}
