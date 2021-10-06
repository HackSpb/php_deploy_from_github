
<?php
/**
 * Simple PHP Git deploy script without installing Git in hosting
 * Only php functions
 *
 * Automatically deploy the code using PHP and Git WebHooks.
 *
 * @version 1.0
 * @link    https://github.com/hackspb
 */


ini_set('display_errors','On');
error_reporting('E_ALL');

if($_GET['secret']!='mysecret') exit();

$tmp_path = __DIR__."/github-tmp/";
$zip_file_path = $tmp_path ."temp.zip"; 
$git_url = "https://github.com/HackSpb/pinok/archive/master.zip";
$git_folder_name = "pinok-master/"; 
$deploy_foler_path = __DIR__.'/';
$need_branch= "refs/heads/master";

if($_REQUEST['payload']){
	$Payload = json_decode ( $_REQUEST['payload'], TRUE );
  
}
else{
  $Payload = json_decode(file_get_contents ("php://input"), TRUE);
}

if($Payload!=''){
	$head_commit = $Payload['head_commit'];
	$commits = $Payload['commits'];
}
else {
 	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo 'no payload'; 
 	exit(" exit 1 !");
	}



foreach( $commits as $commit){
    
    	$c=count($commit['added']);
		for ($i=0; $i < $c ; $i++) { 
			$new_files[]=$commit['added'][$i];
		}
		$c=count($commit['modified']);
		for ($i=0; $i < $c ; $i++) { 
			$new_files[]=$commit['modified'][$i];    
		}
		$c=count($commit['removed']);
		// доработать удаление файлов
		for ($i=0; $i < $c ; $i++) { 
			$removed_files[]=$commit['removed'][$i];    
		}

    }
    echo "new files: ";
print_r($new_files);
    echo '$removed_files : ';
print_r($removed_files);

if($Payload['ref']!=$need_branch) {
 	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	echo "No need master branch!"; 
	exit(" exit 2 !");
}


echo 'Start ';
$source_git = fopen($git_url ,'r');
file_put_contents ($zip_file_path,"");
file_put_contents ($tmp_path.'log_'.date("Y_m_d H:i").'.txt',print_r($_GET,TRUE).print_r($_POST,TRUE));
if(copy($git_url ,$zip_file_path))
echo ' download file ';



$zip = new ZipArchive;
mkdir($deploy_foler_path.'css/test-temp/');
$res = $zip->open($zip_file_path);


if ($res === TRUE) {
    $zip->extractTo($tmp_path);
    $zip->close();
    echo 'ok';

	$c=count($new_files);
	$old_dir="";
	for ($i=0; $i < $c ; $i++) { 

		//вот тут доработать создание каталогов
		$dir=substr( $new_files[$i] , 0 , strrpos ($new_files[$i],'/') );
		if( $dir!=$old_dir && !is_dir($deploy_foler_path.$dir) ){
			mkdir($deploy_foler_path.$dir , 0777,true);
			echo ' mkdir '.$dir.' <br />';
		}
		$old_dir=$dir;

		
		if(copy($tmp_path.$git_folder_name.$new_files[$i], $deploy_foler_path .$new_files[$i])){
			echo '
			copy '.$new_files[$i].' ok <br />';
			chmod( $deploy_foler_path .$new_files[$i] , 0764);
		}

		else echo '
		copy '.$new_files[$i].' ERROR <br />';
		
		}

} else {
    echo 'failed, code:' . $res;
}

foreach($removed_files as $file)
{
    if(unlink($deploy_foler_path.$file))
    {
        echo '
        успешно удалили '.$file;
    }
    else
    {
        echo '
        ошибка удаления '.$file;
    }
    
}

?>