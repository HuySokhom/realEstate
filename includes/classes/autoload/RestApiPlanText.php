<?php
use
    OSC\PlanText\Collection
        as PlanTextCollection
;
class RestApiPlanText extends RestApi {

    public function get($params){
        $col = new PlanTextCollection();
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);
    }

}