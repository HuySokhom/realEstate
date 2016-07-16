<?php

class RestApiIndex extends RestApi {

	public function get(){
		$products_query = tep_db_query("select count(products_id) as total from products where products_status = 1");
		$products = tep_db_fetch_array($products_query);

		$customer_query = tep_db_query("select count(customers_id) as total from customers where status = 1");
		$customer = tep_db_fetch_array($customer_query);

		$news_query = tep_db_query("select count(id) as total from news where status = 1");
		$news = tep_db_fetch_array($news_query);


		return array( data =>
			array(
				total_product => $products['total'],
				total_customer => $customer['total'],
				total_news => $news['total'],
			)
		);
	}
}
