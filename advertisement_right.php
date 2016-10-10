<?php 
	$query = tep_db_query("select * from advertising_banner where location = 'right' and status = 1 order by sort_order asc");
	while ($adv= tep_db_fetch_array($query)) {
		echo '<a href="http://' . $adv['link'] . '" target="_blank">
			<img src="images/' . $adv['image'] . '" class="adv"/>
			</a>
		';
	}
?>