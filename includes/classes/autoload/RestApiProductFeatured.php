<?php

use
	OSC\Product\Collection
		as ProductCol
;

class RestApiProductFeatured extends RestApi {

	public function get($params)
	{
		$product_query = tep_db_query("
			select
				p.products_id,
				pd.products_name,
				p.products_image_thumbnail,
				p.products_price,
				p.products_date_added
			from
				" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
			where
				p.products_status = '1'
					and
				pd.products_id = p.products_id
					and
				pd.language_id = '" . $_SESSION['languages_id'] . "'
					order by
				p.products_promote desc, p.products_date_added desc
					limit 5
		");
		$array = array();
		while ($product_info = tep_db_fetch_array($product_query)){
			//var_dump($product_info);
			$array[] = $product_info;
		}
		return array( data => $array);

		$col = new ProductCol();
		$col->filterByStatus(1);
		$col->filterByLanguage($_SESSION['languages_id']);
		//$this->getId() ? $col->filterByCustomersId($this->getId()) : '';
		$col->sortByDate("DESC");
		// start limit page
		$showDataPerPage = 5;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);

	}

}
