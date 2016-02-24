<?php
class ThumbsController extends AppController {

	var $name = 'Thumbs';
	var $uses = null;
    var $layout = null;
    var $autoRender = false; 
 /**
  ***
  *** Resize image using phpthumb libraray
  ***
  **/
	function index(){
	        ob_start();
            if(empty($_GET['src'])){
                die("No source image");
            }
            
			
            //width
            $width = (!isset($_GET['w'])) ? 100 : $_GET['w'];
            //height
            $height = (!isset($_GET['h'])) ? 150 : $_GET['h'];
            //quality    
            $quality = (!isset($_GET['q'])) ? 75 : $_GET['q'];
			$imagetype = (!isset($_GET['f'])) ? 'jpg' : $_GET['f'];
           
            $sourceFilename = WWW_ROOT.$_GET['src'];

            if(is_readable($sourceFilename)){
			   App::import('Vendor','phpThumb', array('file' => 'phpThumb'.DS.'phpthumb.class.php'));
               // vendor("phpthumb".DS."phpthumb.class");
                $phpThumb = new phpThumb();

                $phpThumb->src = $sourceFilename;
                $phpThumb->w = $width;
                $phpThumb->h = $height;
                $phpThumb->q = $quality;
				$phpThumb->f = $imagetype;
				
                $phpThumb->config_imagemagick_path = '/usr/bin/convert';
                $phpThumb->config_prefer_imagemagick = true;
                $phpThumb->config_output_format = 'jpg';
                $phpThumb->config_error_die_on_error = true;
                $phpThumb->config_document_root = '';
                $phpThumb->config_temp_directory = APP . 'tmp';
                $phpThumb->config_cache_directory = CACHE;
                $phpThumb->config_cache_disable_warning = true;
                
                $cacheFilename = md5($_SERVER['REQUEST_URI']);
                
                $phpThumb->cache_filename = $phpThumb->config_cache_directory.$cacheFilename;
				
				
				
                //Thanks to Kim Biesbjerg for his fix about cached thumbnails being regeneratd
                if(!is_file($phpThumb->cache_filename)){ // Check if image is already cached.
							
                    if ($phpThumb->GenerateThumbnail()) {
                        $phpThumb->RenderToFile($phpThumb->cache_filename);
                    } else {
                        die('Failed: '.$phpThumb->error);
                    }
                }
            
			if(is_file($phpThumb->cache_filename)){ // If thumb was already generated we want to use cached version
			
			
                $cachedImage = getimagesize($phpThumb->cache_filename);
				
				
				header('Content-Type:'.$cachedImage['mime']);
				
                readfile($phpThumb->cache_filename) or die("File not found.");
                exit;
            }
         
            } else { // Can't read source
                die("Couldn't read source image ".$sourceFilename);
            }
        }
       
	  
	   
}