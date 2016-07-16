<?php


class RestApiSearchLocation extends RestApi {

	public function get(){
		$query = tep_db_query("
			select
				name,
				location_id as id
			from
				search_location
			order by
				name asc
		");
		$array = array();
		while ($data = tep_db_fetch_array($query)){
			$array[] = $data;
		}
		return array(
			data => array(
				elements => $array,
			)
		);
	}
}
