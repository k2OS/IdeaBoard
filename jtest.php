<?
$json = '[{"changed_aspect": "media", "subscription_id": 3354148, "object": "tag", "object_id": "nofilter", "time": 1370946078}]';

$jsondecoded = json_decode($json);
if (json_last_error() === JSON_ERROR_NONE) {
	echo "correct json";
	
} else {
	echo "not json";
}
?>
