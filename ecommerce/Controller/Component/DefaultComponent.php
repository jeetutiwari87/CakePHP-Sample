<?php
/**
 * Default Component
 *
 * PHP version 5
 *
 * @category Component
 * @package  tryyourselfs
 * @version  1.0
 * @author   jeetendra sharma
 * @license  
 * @link    
   This component consists the website default functions
 */
class DefaultComponent extends Component {

	
  /**
 * Remove any special character in string and used only numeric and digit
 *
 * @return void
 */
	
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
		 $extname=end(explode(".", $file));
		 $targetFile =  str_replace('//','/',$uploadpath) . $imagename.'.'.$extname;
		 $filename=$imagename.'.'.$extname;
		 $i=1;
			 
		 while (file_exists($targetFile) ) {
			$basefilename=basename($targetFile);
			$ext=end(explode(".", $basefilename));
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
}
