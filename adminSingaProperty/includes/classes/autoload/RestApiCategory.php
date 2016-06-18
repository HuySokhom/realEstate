<?php

use
    OSC\Categories\Collection
        as CategoryCollection,
    OSC\Categories\Object
        as CategoryObject,
    OSC\CategoriesDescription\Object
        as CategoryDetailObject
;

class RestApiCategory extends RestApi {

    public function get($params){

        $col = new CategoryCollection();
        if($params['GET']['pagination']){
        // start limit page
            $showDataPerPage = 10;
            $start = $params['GET']['start'];
            $this->applyLimit($col,
                array(
                    'limit' => array($start, $showDataPerPage)
                )
            );
        }
//        $this->applyFilters($col, $params);
        $col->sortByOrder('ASC');
        return $this->getReturn($col, $params);

    }


    public function post($params){
        $obj = new CategoryObject();

        $obj->setProperties($params['POST']['category'][0]);
        $obj->insert();
        $id = $obj->getId();

        $objDetail = new CategoryDetailObject();
        $fields = $params['POST']['detail'];
        foreach ( $fields as $k => $v){
            $objDetail->setCategoriesId($id);
            $objDetail->setProperties($v);
            $objDetail->insert();
        }

        return array(
            'data' => array(
                'id' => $id
            )
        );
    }

    public function put($params){
        $obj = new CategoryObject();
        $obj->setId($this->getId());
        $obj->setProperties($params['PUT']['category'][0]);
        $obj->update();

        $objDetail = new CategoryDetailObject();
        $fields = $params['PUT']['detail'];
        foreach ( $fields as $k => $v){
            $objDetail->setId($this->getId());
            $objDetail->setProperties($v);
            $objDetail->update();
        }
        return array(
            'data' => array(
                'success' => 'true'
            )
        );

    }
    public function delete(){

        $obj = new CategoryObject();
        $obj->setId($this->getId());
        $obj->delete();
        return array(
            'data' => array(
                'data' => 'success'
            )
        );

    }

}



