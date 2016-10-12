<?php
use
    OSC\PlanPrice\Collection
        as PlanPriceCollection,
    OSC\PlanPrice\Object
        as PlanPriceObject
;
class RestApiPlanPrice extends RestApi {

    public function get($params){
        $col = new PlanPriceCollection();
        return $this->getReturn($col, $params);
    }

    public function put($params){
        $obj = new PlanPriceObject();
        $obj->setId($this->getId());
        $obj->setProperties($params['PUT']);
        $obj->update();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

}