<?php

use
    OSC\Categories\Collection
        as CategoryCollection,
    OSC\Categories\Object
        as CategoryObject
;

class RestApiCategory extends RestApi {

    public function get($params){

        $col = new CategoryCollection();
        // start limit page
        if($params['GET']['paginaton']) {
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
        $obj->setCreateBy($_SESSION['admin']['username']);
        $obj->setProperties( $params['POST'] );
        $obj->insert();
        $id = $obj->getId();
        return array(
            'data' => array(
                'id' => $id
            )
        );
    }

    public function put($params){
        $obj = new CategoryObject();
        $obj->setId($this->getId());
        $obj->setProperties($params['PUT']);
        $obj->setUpdateBy($_SESSION['admin']['username']);
        $obj->update();

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



