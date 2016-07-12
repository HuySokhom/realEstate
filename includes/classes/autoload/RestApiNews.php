<?php

use
	OSC\News\Collection as NewsCol
;

class RestApiNews extends RestApi {

	public function get($params){

		$news_query = tep_db_query("
			select
				n.id,
				n.create_by,
				n.image,
				n.image_thumbnail,
				nd.title,
				SUBSTRING_INDEX(nd.content, '', 20) as content,
				n.create_date
			from
				news n, news_description nd
			where
				n.status = 1
					and
				n.id = nd.news_id
					and
				nd.language_id = '" . $_SESSION['languages_id'] . "'
					order by
				n.create_date desc
		");

		$array = array();
		while ($news_info = tep_db_fetch_array($news_query)){
			//var_dump($news_info);
			$array[] = $news_info;
		}
		$news_count = tep_db_query("select count(id) as total from news where status = 1");
		$total = tep_db_fetch_array($news_count);

		return array(
			data => array(
				elements => $array,
				total => $total['total']
			)
		);

		$col = new NewsCol();
		$col->sortByDate('DESC');
		$col->filterByStatus(1);
		$this->getId() ? $col->filterById($this->getId()) : '';
		$params['GET']['news_type_id'] ? $col->filterByTypeId($params['GET']['news_type_id']) : '';
		// start limit page
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);

		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

}
