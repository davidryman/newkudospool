 <?php
 echo "are we there yet";
 $filename = 'data/newk/teams.xml';
// console_log($filename);
if (file_exists($filename))
	{
	echo 'File '.$filename.' found';
	$xml=simplexml_load_file($filename);
	}
	else {
		echo 'Error: Cannot find object file';
	}
//print_r($xml_file);
//echo ($xml);
//$filename = '/data/newk/teams.xml';
//$mode = 'r';
//$xml_file = fopen($filename, $mode, $use_include_path = null, $context = null);
echo $xml->row[0]->team_id . "<br>";
echo $xml->row[1]->city . "<br>";
echo $xml->row[2]->name . "<br>";
echo "hello world";

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}



?> 