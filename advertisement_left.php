<?php 
	$query = tep_db_query("select * from advertising_banner where status = 1 order by sort_order asc");
	$array = [];
	while ($adv= tep_db_fetch_array($query)) {
		$array[] = $adv;
	}
	var_dump($array)
?>