<?php

class RestApiExpirePlan extends RestApi {

    public function get($params){
        $queryExpiryday = tep_db_query("select count(*) as total from customers_plan where DAY(plan_expire) = DAY(NOW()) AND MONTH(plan_expire) = MONTH(NOW())");
        $countExpiryDay = tep_db_fetch_array($queryExpiryday);
    }


}