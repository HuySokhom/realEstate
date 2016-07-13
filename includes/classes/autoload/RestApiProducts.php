<?php

use
	OSC\Product\Collection
		as ProductCol
;

class RestApiProducts extends RestApi {

	public function get($params){
		$showDataPerPage = 9;
		$start = $params['GET']['start'] ? $params['GET']['start'] : 0;
		$userId = $this->getId();
		$news_query = tep_db_query("
			select
				p.products_id,
				p.products_price,
				p.products_image_thumbnail,
				p.bed_rooms,
				p.bath_rooms,
				p.number_of_floors,
				pd.products_name,
				pd.products_viewed,
				p.create_date
			from
				products p, products_description pd
			where
				p.products_status = 1
					and
				p.products_id = pd.products_id
					and
				pd.language_id = '" . $_SESSION['languages_id'] . "'
					and
				p.customers_id = '" . $userId . "'
					order by
				p.create_date desc
				limit $start, $showDataPerPage
		");
		$array = array();
		while ($news_info = tep_db_fetch_array($news_query)){
			$array[] = $news_info;
		}
		$news_count = tep_db_query("select count(products_id) as total from products where customers_id = '" . $userId . "'");
		$total = tep_db_fetch_array($news_count);

		return array(
			data => array(
				elements => $array,
				count => $total['total']
			)
		);
//		$col = new ProductCol();
//
//		$col->filterByStatus(1);
//		$col->filterByLanguage($_SESSION['languages_id']);
//		$this->getId() ? $col->filterByCustomersId($this->getId()) : '';
//		$col->sortByDate("DESC");
//		// start limit page
//		$showDataPerPage = 9;
//		$start = $params['GET']['start'];
//		$this->applyLimit($col,
//			array(
//				'limit' => array( $start, $showDataPerPage )
//			)
//		);
//
//		$this->applySortBy($col, $params);
//		return $this->getReturn($col, $params);

	}

}
