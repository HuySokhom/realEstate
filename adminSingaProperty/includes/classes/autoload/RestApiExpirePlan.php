<?php

class RestApiExpirePlan extends RestApi {

    public function get($params){
        $queryExpiryday = tep_db_query("
            SELECT
              c.customers_id,
              c.user_name,
              cp.plan,
              c.user_type,
              c.customers_telephone,
              c.customers_email_address,
              cp.plan_date,
              cp.plan_expire
            FROM
              customers_plan cp INNER JOIN customers c ON cp.customers_id = c.customers_id
            WHERE
              cp.status = 1
                AND
              DATEDIFF(cp.plan_expire, NOW()) <= 7
        ");

        $array = array();
        while($exp = tep_db_fetch_array($queryExpiryday)){
            $array[] = $exp;
        }

        return array(
            data => array(
                elements => $array
            )
        );

    }


}