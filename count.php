

<?php
$db= new PDO ('sqlite:watansys.db');
$sql = "select * from `count`";
$result = $db->query($sql);
	foreach($result as $row){
	$count = $row['data'] ;
	$count = sprintf("%06d",$count);
	}
	$count = str_split($count);
foreach($count as $c){
	echo '<span style="background:#00bfa5;padding:3px 6px; margin-right:3px;">'.$c.'</span>';
}
	echo ' - Analysis';
?>