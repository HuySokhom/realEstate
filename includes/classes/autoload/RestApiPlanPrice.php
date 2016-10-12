<?php
use
    OSC\PlanPrice\Collection
        as PlanPriceCollection
;
class RestApiPlanPrice extends RestApi {

    public function get($params){
        $col = new PlanPriceCollection();
        return $this->getReturn($col, $params);
    }

}