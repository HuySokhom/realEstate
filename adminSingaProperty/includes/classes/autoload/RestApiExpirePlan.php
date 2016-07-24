<?php

class RestApiExpirePlan extends RestApi {

    public function get($params){
        $queryExpiryday = tep_db_query("
            SELECT
              cp.id,
              cp.plan,
              cp.plan_date,
              cp.plan_expire,
              c.user_name,
              c.user_type,
              c.customers_telephone,
              c.customers_email_address
            FROM
              customers_plan cp INNER JOIN customers c ON cp.customers_id = c.customers_id
            WHERE
              cp.status = 1
                AND
              DAY(cp.plan_expire) = DAY(NOW())
                AND
            MONTH(cp.plan_expire) = MONTH(NOW())
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