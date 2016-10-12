<?php
use
    OSC\PlanText\Collection
        as PlanTextCollection,
    OSC\PlanText\Object
        as PlanTextObject
;
class RestApiPlanText extends RestApi {

    public function get($params){
        $col = new PlanTextCollection();
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);
    }

    public function post($params){
        $obj = new PlanTextObject();
        $obj->setCreateBy($_SESSION['admin']['username']);
        $obj->setProperties($params['POST']);
        $obj->insert();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

    public function put($params){
        $obj = new PlanTextObject();
        $obj->setUpdateBy($_SESSION['admin']['username']);
        $obj->setId($this->getId());
        $obj->setProperties($params['PUT']);
        $obj->update();
        return array(
            'data' => array(
                'id' => $obj->getId()
            )
        );
    }

    public function delete($params){
        $obj = new PlanTextObject();
        $obj->setId($this->getId());
        $obj->delete();
    }

    public function patch($params){
        $cols = new PlanTextObject();
        $cols->filterById( $this->getId() );
        if( $cols->getTotalCount() > 0 ){
            $cols->populate();
            $col = $cols->getFirstElement();
            $col->setId($this->getId());
            $col->setStatus($params['PATCH']['status']);
            $col->updateStatus();
        }
        return array(
            'data' => array(
                'data' => 'update success'
            )
        );
    }
}