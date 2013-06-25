<?
if ($_GET["hub_challenge"] && $_GET["hub_challenge"] !== "") {
	echo $_GET["hub_challenge"];
} else {
 # test if a user is requesting a page.. or else we assume the API is talking to us 
 $json = @file_get_contents('php://input');
 $fh = fopen("debug.txt","a");
 fwrite($fh,$json);
 fwrite($fh,"\n");
 fclose($fh);
}
?>
